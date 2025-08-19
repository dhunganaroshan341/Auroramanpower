$(document).ready(function () {
    $(".summernote").summernote({
        height: 300
    });

    // Data Table for Job Categories
    var table = $("#show-job-category-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/job-categories",
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [1, 'asc'],
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "image", name: "image", orderable: false, searchable: false },
            { data: "name", name: "name" },
            { data: "action", name: "action", orderable: false, searchable: false }
        ]
    });

    // Helper: clear modal
    function clearModal() {
        $("#jobCategoryImagePreview").html("");
        $("#validationErrors").addClass("d-none").html("");
        $("#jobCategoryDescription").summernote("code", "");
    }

    // Add Job Category
    $(document).on("click", ".addJobCategoryBtn", function () {
        clearModal();
        $("#jobCategoryModal").modal("show");
        $(".submitBtn").show();
        $(".updateBtn").hide();
        $("#jobCategoryForm")[0].reset();
    });

    // Store Job Category
    $(document).off("submit", "#jobCategoryForm").on("submit", "#jobCategoryForm", function (event) {
        event.preventDefault();
        $(".submitBtn").prop("disabled", true);
        let formData = new FormData(this);
        $.ajax({
            type: "post",
            url: "/admin/job-categories/store",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    Swal.fire({ icon: "success", title: "Success", text: "Job Category Created Successfully", showConfirmButton: false, timer: 1000 });
                    table.draw();
                    $("#jobCategoryForm")[0].reset();
                    $("#jobCategoryModal").modal("hide");
                } else {
                    Swal.fire({ icon: "warning", title: "Something went wrong!", text: "Please try again!" });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = '<ul>';
                    $.each(errors, (key, value) => errorMessages += `<li>${value[0]}</li>`);
                    errorMessages += '</ul>';
                    $('#validationErrors').removeClass('d-none').html(errorMessages);
                }
            },
            complete: () => $(".submitBtn").prop("disabled", false)
        });
    });

    // Edit Job Category
    $(document).on("click", ".editJobCategoryBtn", function () {
        clearModal();
        $("#jobCategoryModal").modal("show");
        $(".submitBtn").hide();
        $(".updateBtn").show();

        var id = $(this).data("id");
        $.ajax({
            type: "get",
            url: "/admin/job-categories/" + id,
            success: function (response) {
                $("#name").val(response.message.name);
                $("#icon_class").val(response.message.icon_class);
                $("#slug").val(response.message.slug);
                $("#jobCategoryDescription").summernote('code', response.message.description);

                if (response.message.image) {
                    $("#jobCategoryImagePreview").html(`<img src="${response.message.image}" alt="Category Image" width="100" height="100" onerror="this.src='/defaultimage/defaultimage.webp';">`);
                }
            }
        });

        $(".updateBtn").off("click").on("click", function (event) {
            event.preventDefault();
            $(".updateBtn").prop("disabled", true);
            let formData = new FormData($("#jobCategoryForm")[0]);
            $.ajax({
                type: "post",
                url: "/admin/job-categories/" + id,
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({ icon: "success", title: "Success", text: "Job Category Updated Successfully", showConfirmButton: false, timer: 1000 });
                        table.draw();
                        $("#jobCategoryModal").modal("hide");
                    } else {
                        Swal.fire({ icon: "warning", title: "Something went wrong!", text: "Please try again!" });
                    }
                },
                error: function () {
                    Swal.fire({ icon: "warning", title: "Something went wrong!", showConfirmButton: false, timer: 1500 });
                },
                complete: () => $(".updateBtn").prop("disabled", false)
            });
        });
    });

    // Delete Job Category
    $(document).on("click", ".deleteJobCategory", function () {
        let id = $(this).data("id");
        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonText: "Yes, Delete it!",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "/admin/job-categories/delete/" + id,
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({ icon: "success", title: "Deleted Successfully", showConfirmButton: false, timer: 1500 });
                            table.draw();
                        } else {
                            Swal.fire({ icon: "warning", title: "Something went wrong!", text: "Please try again!" });
                        }
                    },
                    error: () => Swal.fire({ icon: "warning", title: "Something went wrong!", showConfirmButton: false, timer: 1500 })
                });
            }
        });
    });

});
