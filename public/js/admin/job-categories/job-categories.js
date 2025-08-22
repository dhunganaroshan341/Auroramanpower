$(document).ready(function () {
    // Initialize Summernote
    $(".summernote").summernote({ height: 300 });

    // Initialize DataTable
    const table = $("#show-job-category-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: Routes.admin.job_categories.index,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [[2, 'asc']],
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "image", name: "image", orderable: false, searchable: false },
            { data: "name", name: "name" },
            { data: "action", name: "action", orderable: false, searchable: false }
        ]
    });

    // Clear modal helper
    function clearModal() {
        $("#jobCategoryImagePreview").html("");
        $("#validationErrors").addClass("d-none").html("");
        $("#jobCategoryDescription").summernote("code", "");
        $("#jobCategoryForm")[0].reset();
    }

    // Show add modal
    $(document).on("click", ".addJobCategoryBtn", function () {
        clearModal();
        $("#jobCategoryModal").modal("show");
        $(".submitBtn").show();
        $(".updateBtn").hide();
    });

    // Store Job Category
    $(document).off("submit", "#jobCategoryForm").on("submit", "#jobCategoryForm", function (e) {
        e.preventDefault();
        $(".submitBtn").prop("disabled", true);
        const formData = new FormData(this);

        $.ajax({
            type: "post",
            url: Routes.admin.job_categories.store,
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.success) {
                    Swal.fire({ icon: "success", title: "Success", text: "Job Category Created Successfully", showConfirmButton: false, timer: 1000 });
                    table.draw();
                    $("#jobCategoryModal").modal("hide");
                } else {
                    Swal.fire({ icon: "warning", title: "Something went wrong!", text: res.message });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let html = "<ul>";
                    $.each(errors, (key, value) => html += `<li>${value[0]}</li>`);
                    html += "</ul>";
                    $('#validationErrors').removeClass('d-none').html(html);
                }
            },
            complete: () => $(".submitBtn").prop("disabled", false)
        });
    });

    // Edit Job Category
    $(document).on("click", ".editUserButton", function () {
        clearModal();
        $("#jobCategoryModal").modal("show");
        $(".submitBtn").hide();
        $(".updateBtn").show();

        const id = $(this).data("id");
        $.get(Routes.admin.job_categories.update(id), function (res) {
            $("#name").val(res.message.name);
            $("#icon_class").val(res.message.icon_class);
            $("#slug").val(res.message.slug);
            $("#jobCategoryDescription").summernote('code', res.message.description);

            if (res.message.image) {
                $("#jobCategoryImagePreview").html(`<img src="${res.message.image}" alt="Category Image" width="100" height="100" onerror="this.src='/defaultimage/defaultimage.webp';">`);
            }
        });

        $(".updateBtn").off("click").on("click", function (e) {
            e.preventDefault();
            $(".updateBtn").prop("disabled", true);

            const formData = new FormData($("#jobCategoryForm")[0]);
            $.ajax({
                type: "post",
                url: Routes.admin.job_categories.update(id),
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    if (res.success) {
                        Swal.fire({ icon: "success", title: "Updated!", text: "Job Category Updated Successfully", showConfirmButton: false, timer: 1000 });
                        table.draw();
                        $("#jobCategoryModal").modal("hide");
                    } else {
                        Swal.fire({ icon: "warning", title: "Something went wrong!", text: res.message });
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
        const id = $(this).data("id");
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
                $.get(Routes.admin.job_categories.destroy(id), function (res) {
                    if (res.success) {
                        Swal.fire({ icon: "success", title: "Deleted!", showConfirmButton: false, timer: 1500 });
                        table.draw();
                    } else {
                        Swal.fire({ icon: "warning", title: "Something went wrong!", text: res.message });
                    }
                }).fail(() => Swal.fire({ icon: "warning", title: "Something went wrong!", showConfirmButton: false, timer: 1500 }));
            }
        });
    });
});
