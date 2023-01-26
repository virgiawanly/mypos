const deleteModal = (url, config = {}) => {
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    if (!csrfToken) throw new Error("CSRF token is not provided!");

    const icon = config.icon || "warning";
    const type = config.type?.toLowerCase() || "data";
    const name = config.name?.toLowerCase() || "ini";
    const title = config.title || `Hapus ${type}?`;
    const text = config.text || `Anda yakin ingin menghapus ${type} ${name}?`;
    const confirmButtonText = config.confirmButtonText || "Ya, Hapus saja";
    const cancelButtonText = config.cancelButtonText || "Tidak";
    const onSuccess = config.success ? config.success : () => {};
    const onFailed = config.failed ? config.failed : () => {};

    Swal.fire({
        icon: icon,
        title: title,
        text: text,
        showCancelButton: true,
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText,
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: url,
                type: "DELETE",
                headers: { "X-CSRF-TOKEN": csrfToken },
            })
                .then(onSuccess)
                .catch(onFailed);
        },
    });
};
