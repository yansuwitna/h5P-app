<?php

namespace App\Services;

use ZipArchive;
use SimpleXMLElement;
use Exception;

class ExcelReader
{
    /**
     * Membaca berkas Excel (.xlsx) atau CSV (.csv) menjadi array baris data.
     *
     * @param string $filePath
     * @param string $extension
     * @return array
     */
    public static function readRows(string $filePath, string $extension = 'xlsx'): array
    {
        $extension = strtolower($extension);

        if ($extension === 'csv') {
            return self::readCsv($filePath);
        }

        return self::readXlsx($filePath);
    }

    /**
     * Membaca berkas format CSV.
     */
    protected static function readCsv(string $filePath): array
    {
        $rows = [];
        if (($handle = fopen($filePath, 'r')) !== false) {
            // Deteksi pembatas (koma atau titik koma)
            $firstLine = fgets($handle);
            rewind($handle);
            $delimiter = (substr_count($firstLine, ';') > substr_count($firstLine, ',')) ? ';' : ',';

            while (($data = fgetcsv($handle, 10000, $delimiter)) !== false) {
                // Filter baris kosong
                if (count(array_filter($data, fn($v) => trim($v) !== '')) > 0) {
                    $rows[] = array_map('trim', $data);
                }
            }
            fclose($handle);
        }
        return $rows;
    }

    /**
     * Membaca berkas format XLSX (OpenXML Spreadsheet) menggunakan native ZipArchive & SimpleXML.
     */
    protected static function readXlsx(string $filePath): array
    {
        $zip = new ZipArchive();
        if ($zip->open($filePath) !== true) {
            throw new Exception("Berkas Excel tidak valid atau tidak dapat diekstrak.");
        }

        // 1. Baca shared strings (teks string berulang di Excel)
        $sharedStrings = [];
        $sharedStringsXml = $zip->getFromName('xl/sharedStrings.xml');
        if ($sharedStringsXml !== false) {
            $xml = new SimpleXMLElement($sharedStringsXml);
            foreach ($xml->si as $si) {
                if (isset($si->t)) {
                    $sharedStrings[] = (string)$si->t;
                } elseif (isset($si->r)) {
                    $t = '';
                    foreach ($si->r as $r) {
                        $t .= (string)$r->t;
                    }
                    $sharedStrings[] = $t;
                } else {
                    $sharedStrings[] = '';
                }
            }
        }

        // 2. Baca worksheet pertama (xl/worksheets/sheet1.xml)
        $sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
        if ($sheetXml === false) {
            $zip->close();
            throw new Exception("Lembar kerja pertama (Sheet 1) tidak ditemukan pada berkas Excel.");
        }

        $xml = new SimpleXMLElement($sheetXml);
        $rows = [];

        if (isset($xml->sheetData) && isset($xml->sheetData->row)) {
            foreach ($xml->sheetData->row as $row) {
                $currentRow = [];
                $highestCol = 0;

                foreach ($row->c as $c) {
                    $cellRef = (string)$c['r']; // Contoh: A1, B1, C2
                    preg_match('/([A-Z]+)(\d+)/', $cellRef, $matches);
                    $colLetters = $matches[1] ?? 'A';
                    $colIndex = self::colLetterToIndex($colLetters);

                    // Isi kolom kosong jika ada sel yang di-skip oleh Excel
                    while (count($currentRow) < $colIndex) {
                        $currentRow[] = '';
                    }

                    $val = '';
                    $type = (string)$c['t'];

                    if (isset($c->v)) {
                        $rawVal = (string)$c->v;
                        if ($type === 's') { // shared string
                            $val = $sharedStrings[(int)$rawVal] ?? '';
                        } elseif ($type === 'b') { // boolean
                            $val = $rawVal === '1' ? 'TRUE' : 'FALSE';
                        } else {
                            $val = $rawVal;
                        }
                    } elseif (isset($c->is->t)) { // inline string
                        $val = (string)$c->is->t;
                    }

                    $currentRow[$colIndex] = trim($val);
                }

                // Masukkan jika baris tidak sepenuhnya kosong
                if (count(array_filter($currentRow, fn($v) => trim($v) !== '')) > 0) {
                    $rows[] = $currentRow;
                }
            }
        }

        $zip->close();
        return $rows;
    }

    /**
     * Mengubah huruf kolom Excel (A, B, C... Z, AA) menjadi indeks 0-based.
     */
    protected static function colLetterToIndex(string $letters): int
    {
        $letters = strtoupper($letters);
        $length = strlen($letters);
        $index = 0;

        for ($i = 0; $i < $length; $i++) {
            $index *= 26;
            $index += ord($letters[$i]) - ord('A') + 1;
        }

        return $index - 1;
    }
}
