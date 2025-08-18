$(document).ready(function () {
 // Status Update Toggle Button

    $(document).on("change", ".statusIdData", function () {
        let id = $(this).data("id");
if (!id) {
    Swal.fire({
        icon: "error",
        title: "Invalid ID!"
    });
    return;
}

        console.log(id);
        let checked = $(this);
        checked.prop("disabled", true);
        Swal.fire({
            icon: "warning",
            title: "Are you sure ?",
            showCancelButton: true,
            confirmButtonColor: "#3085d3",
            confirmButtonText: "Yes, Change it!",
            cancelButtonColor: "#d33"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "/admin/section-content/status/" + id,
                   success: function (response) {
    if (response.success === true) {
        sectionContentTable.draw();  // Make sure this refers to your DataTable
        checked.prop("disabled", false);
    } else {
        Swal.fire({
            icon: "warning",
            title: response.message || "Something went wrong!"
        });
        checked.prop("disabled", false);
    }
},
error: function (xhr) {
    Swal.fire({
        icon: "error",
        title: xhr.responseJSON?.message || "AJAX error!"
    });
    checked.prop("disabled", false);
}

                })
            } else {
                checked.prop("disabled", false);
                checked.prop("checked", !checked.prop("checked"));
            }
        })

    })
});
