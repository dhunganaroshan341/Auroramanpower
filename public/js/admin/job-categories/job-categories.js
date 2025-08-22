$(document).ready(function () {

    // -------------------- CSRF SETUP --------------------
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // -------------------- SUMMERNOTE --------------------
    $(".summernote").summernote({ height: 300 });

    // -------------------- DATATABLE --------------------
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

    // -------------------- HELPERS --------------------
    function clearModal() {
        $("#jobCategoryImagePreview").html("");
        $("#validationErrors").addClass("d-none").html("");
        $("#jobCategoryDescription").summernote("code", "");
        $("#jobCategoryForm")[0].reset();
    }

    function previewImage(url) {
        return `<img src="${url}" alt="Category Image" width="100" height="100" onerror="this.src='/user.png';">`;
    }

    // -------------------- ADD MODAL --------------------
    $(document).on("click", ".addJobCategoryBtn", function () {
        clearModal();
        $("#jobCategoryModal").modal("show");
        $(".submitBtn").show();
        $(".updateBtn").hide();
    });

    // -------------------- STORE --------------------
    $(document).off("submit", "#jobCategoryForm").on("submit", "#jobCategoryForm", function (e) {
        e.preventDefault();
        $(".submitBtn").prop("disabled", true);

        const formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: Routes.admin.job_categories.store,
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.success) {
                    Swal.fire({ icon: "success", title: "Created!", text: res.message, showConfirmButton: false, timer: 1000 });
                    table.draw();
                    $("#jobCategoryModal").modal("hide");
                } else {
                    Swal.fire({ icon: "warning", title: "Oops!", text: res.message });
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

    // -------------------- EDIT / UPDATE --------------------
    $(document).on("click", ".editUserButton", function () {
        clearModal();
        $("#jobCategoryModal").modal("show");
        $(".submitBtn").hide();
        $(".updateBtn").show();

        const id = $(this).data("id");

        // FETCH DATA
        $.get(Routes.admin.job_categories.update(id), function (res) {
            if (res.success) {
                const data = res.data;
                $("#name").val(data.name);
                $("#icon_class").val(data.icon_class);
                $("#slug").val(data.slug);
                $("#jobCategoryDescription").summernote('code', data.description);
                if (data.image) $("#jobCategoryImagePreview").html(previewImage(data.image));
            } else {
                Swal.fire({ icon: "warning", title: "Oops!", text: res.message });
            }
        });

        // UPDATE
        $(".updateBtn").off("click").on("click", function (e) {
            e.preventDefault();
            $(".updateBtn").prop("disabled", true);

            const formData = new FormData($("#jobCategoryForm")[0]);
            formData.append('_method', 'PUT'); // Tell Laravel it's a PUT request
            $.ajax({
                type: "POST", // Laravel doesn't allow PUT in FormData directly, so POST with _method
                url: Routes.admin.job_categories.update(id),
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    if (res.success) {
                        Swal.fire({ icon: "success", title: "Updated!", text: res.message, showConfirmButton: false, timer: 1000 });
                        table.draw();
                        $("#jobCategoryModal").modal("hide");
                    } else {
                        Swal.fire({ icon: "warning", title: "Oops!", text: res.message });
                    }
                },
                error: function () {
                    Swal.fire({ icon: "warning", title: "Something went wrong!", showConfirmButton: false, timer: 1500 });
                },
                complete: () => $(".updateBtn").prop("disabled", false)
            });
        });
    });

    // -------------------- DELETE --------------------
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
                        Swal.fire({ icon: "warning", title: "Oops!", text: res.message });
                    }
                }).fail(() => Swal.fire({ icon: "warning", title: "Something went wrong!", showConfirmButton: false, timer: 1500 }));
            }
        });
    });

});
