$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function loadMore() {
    const page = $("#page").val();
    $.ajax({
        type: "POST",
        dataType: "JSON",
        data: { page },
        url: "/services/load-product",
        success: function (result) {
            if (result.html !== "") {
                $("#loadProduct").append(result.html);
                $("#page").val(parseInt(page) + 1);
            } else {
                $("#btn-loadMore").css("display", "none");
            }
        },
    });
}
