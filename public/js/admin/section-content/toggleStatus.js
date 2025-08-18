$(document).ready(function () {
 // Status Update Toggle Button
    $(document).on("change", ".statusIdData", function () {
        let id = $(this).data("id");
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
                        if (response.success == true) {
                            table.draw();
                            checked.prop("disabled", false);
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Something went wrong!"
                            });
                            checked.prop("disabled", false);
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr.responseJSON.message);
                    }
                })
            } else {
                checked.prop("disabled", false);
                checked.prop("checked", !checked.prop("checked"));
            }
        })

    })
});
