$(function () {
    $(".delete-btn").on("click", function () {
        const deleteUrl = $(this).data("delete-url");
        const originUrl = $(this).data("origin-url");
        deleteModal(deleteUrl, {
            type: "Produk",
            confirmButtonText: "Ya, Hapus saja",
            cancelButtonText: `Tidak`,
            success: (res) => {
                Swal.fire({
                    icon: "success",
                    title: res.success || "Sukses!",
                    text: res.success_message || null,
                }).then(() => {
                    location.href = originUrl;
                });
            },
            failed: () => {
                Swal.fire({ icon: "error", title: "Gagal :(" });
            },
        });
    });
});
