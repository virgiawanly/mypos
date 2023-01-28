$(function () {
    // ** Initialize Regular Select2
    const regularSelect2 = $("select.select2:not(.ajax-select2)");
    regularSelect2.select2();

    // ** Initialize Ajax Select2
    const ajaxSelect2 = $("select.select2.ajax-select2");
    ajaxSelect2.each(function () {
        const resourceUrl = $(this).data("resource-url");

        if (!resourceUrl) {
            const el = $(this).prop("outerHTML");
            throw new Error(
                `Resource URL was not provided to initalize the ajax select2 on ${el}`
            );
        }

        $(this).select2({
            placeholder: "-",
            ajax: {
                url: resourceUrl,
                delay: 300,
                minimumInputlength: 1,
                allowClear: true,
                data: (params) => ({ search: params.term }),
            },
        });
    });
});
