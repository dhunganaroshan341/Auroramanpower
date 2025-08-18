$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let sectionCategoryTable;

    // Open modal for adding new category
    $(document).on('click', '.addCategoryBtn', function () {
        $('.sectionCategoryForm')[0].reset();
        $('.sectionCategoryForm').attr('id', 'SectionCategoryForm');
        $('#sectionCategoryModal').modal('show');
        $('.submitBtn').show();
        $('.updateBtn').hide();
    });

    // Open modal for editing category
    $(document).on('click', '.editCategoryBtn', function () {
        const id = $(this).data('id');
        $('.sectionCategoryForm').attr('id', 'updateSectionCategoryForm');
        $("#updateSectionCategoryForm").attr("data-id", id);
        $('#sectionCategoryModal').modal('show');
       $('.submitBtn').hide();
        $('.updateBtn').show();

        // Fetch category data
        $.ajax({
            url: `/admin/section-category/${id}`,
            type: 'GET',
            success: function (response) {
                $('#title').val(response.title);
                $('#sub_heading').val(response.sub_heading);
                $('#image').val(response.image);
                $('#video').val(response.video);
                $('#slug').val(response.slug);
                $('#description').val(response.description);
                $('#description2').val(response.description2);
            },
            error: function (err) {
                console.error("Error fetching category:", err);
                alert("Failed to fetch category for editing.");
            }
        });
    });

    // Initialize DataTable
    sectionCategoryTable = $("#section-category-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/admin/section-category",
            type: "GET"
        },
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'title', name: 'title' },
            { data: 'sub_heading', name: 'sub_heading' },
            { data: 'slug', name: 'slug' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // Handle form submit (create/update)
    $(document).off("submit", ".sectionCategoryForm").on("submit", ".sectionCategoryForm", function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = new FormData(this);
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        let isUpdate = form.attr("id") === "updateSectionCategoryForm";
        let url = '';
        let method = 'POST';

        if (isUpdate) {
            $('#updateCategoryBtn').show();
            $('#submitCategoryBtn').hide();
            const id = form.attr("data-id");
            url = `/admin/section-category/${id}`;
            method = 'POST';
            formData.append('_method', 'PUT');
        } else {
            url = '/admin/section-category';
        }

        $(".btn").prop("disabled", true);

        $.ajax({
            url: url,
            type: method,
            data: formData,
            contentType: false,
            processData: false,

            success: function (response) {
                $(".btn").prop("disabled", false);

                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: response.message || "Section Category saved successfully.",
                        showConfirmButton: false,
                        timer: 1000
                    });

                    if (sectionCategoryTable) {
                        sectionCategoryTable.ajax.reload(null, false);
                    }

                    $("#sectionCategoryModal").modal("hide");
                    form[0].reset();
                    form.attr("id", "SectionCategoryForm");
                    $('#submitCategoryBtn').show();
                    $('#updateCategoryBtn').hide();
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message || "Something went wrong!",
                    });
                }
            },

            error: function (err) {
                $(".btn").prop("disabled", false);
                console.error("Submission failed:", err);

                let message = "Something went wrong.";

                if (err.status === 422 && err.responseJSON?.errors) {
                    const errors = err.responseJSON.errors;
                    message = Object.values(errors).flat().join('\n');
                } else if (err.responseJSON?.message) {
                    message = err.responseJSON.message;
                }

                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: message,
                });
            }
        });
    });

    // Delete category
    $(document).on("click", ".deleteCategoryBtn", function () {
        let id = $(this).data("id");

        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            text: "This action cannot be reversed!",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: `/admin/section-category/${id}`,
                    success: function (response) {
                        Swal.fire({
                            icon: "success",
                            title: "Deleted",
                            text: response.message || "Section Category deleted successfully",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        if (sectionCategoryTable) {
                            sectionCategoryTable.ajax.reload(null, false);
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Failed to delete category",
                        });
                    }
                });
            }
        });
    });

});
