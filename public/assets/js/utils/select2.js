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

        const config = {
            ajax: {
                url: resourceUrl,
                delay: 300,
                minimumInputlength: 1,
                data: (params) => ({ search: params.term }),
            },
        };

        if ($(this).data("empty-option")) {
            const text = $(this).data("empty-option");
            config.ajax.processResults = function (data) {
                const results = [{ id: 0, text: text }, ...data.results];
                return { results };
            };
        }

        if ($(this).attr("placeholder")) {
            config.placeholder = $(this).attr("placeholder");
        }

        $(this).select2(config);
        $(this).append("<option value=''>-</option>");
    });
});
