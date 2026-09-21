import Swal from 'sweetalert2';

/**
 * Global SweetAlert2 notification helper customized for LMS H5P
 */
export const notify = {
    /**
     * Alert Sukses
     */
    success(title, text = '') {
        return Swal.fire({
            icon: 'success',
            title: title,
            text: text,
            confirmButtonText: 'Tutup',
            confirmButtonColor: '#4f46e5',
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'px-5 py-2.5 rounded-xl font-semibold text-xs',
            }
        });
    },

    /**
     * Toast Sukses Ringkas di Pojok Kanan Atas
     */
    toastSuccess(title) {
        return Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: title,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    },

    /**
     * Alert Error / Gagal
     */
    error(title, text = '') {
        return Swal.fire({
            icon: 'error',
            title: title,
            text: text,
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#e11d48',
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'px-5 py-2.5 rounded-xl font-semibold text-xs',
            }
        });
    },

    /**
     * Toast Error Ringkas
     */
    toastError(title) {
        return Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: title,
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
        });
    },

    /**
     * Alert Informasi
     */
    info(title, text = '') {
        return Swal.fire({
            icon: 'info',
            title: title,
            text: text,
            confirmButtonText: 'Oke',
            confirmButtonColor: '#4f46e5',
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'px-5 py-2.5 rounded-xl font-semibold text-xs',
            }
        });
    },

    /**
     * Dialog Konfirmasi Aksi (Hapus, Logout, Simpan)
     */
    confirm(title, text = '', confirmText = 'Ya, Lanjutkan', icon = 'warning') {
        return Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: '#4f46e5',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: confirmText,
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'px-5 py-2.5 rounded-xl font-semibold text-xs',
                cancelButton: 'px-5 py-2.5 rounded-xl font-semibold text-xs',
            }
        });
    }
};

export default notify;
