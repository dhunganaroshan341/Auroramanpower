$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let sectionContentTable;

    // Open modal for adding new content
    $(document).on('click', '.addContentBtn', function () {
        $('.sectionContentForm')[0].reset();
        $('.sectionContentForm').attr('id', 'SectionContentForm');
        $('#sectionContentModal').modal('show');
        $('.updateBtn').hide();
        $('.submitBtn').show();
    });

    // Open modal for editing content
    $(document).on('click', '.editContentBtn', function () {
        const id = $(this).data('id');
        $('.sectionContentForm').attr('id', 'updateSectionContentForm');
        $("#updateSectionContentForm").attr("data-id", id);
        $('#sectionContentModal').modal('show');
        $('.submitBtn').hide();
        $('.updateBtn').show();

        // Fetch content data
        $.ajax({
            url: `/admin/section-contents/${id}`,
            type: 'GET',
            success: function (response) {
                $('#section_category_id').val(response.section_category_id);
                $('#title').val(response.title);
                $('#short_description').val(response.short_description);
                $('#image').val(response.image);
                $('#video').val(response.video);
                $('#pdf').val(response.pdf);
                $('#description').val(response.description);
                $('#description2').val(response.description2);
                $('#icon_class').val(response.icon_class);
                $('#link_title').val(response.link_title);
                $('#link_url').val(response.link_url);
            },
            error: function (err) {
                console.error("Error fetching content:", err);
                alert("Failed to fetch content for editing.");
            }
        });
    });

    // Initialize DataTable
    sectionContentTable = $("#section-content-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/admin/section-content",
            type: "GET"
        },
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'title', name: 'title' },
            { data: 'category', name: 'category' },
            { data: 'short_description', name: 'short_description' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // Handle form submit (create/update)
    $(document).off("submit", ".sectionContentForm").on("submit", ".sectionContentForm", function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = new FormData(this);
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        let isUpdate = form.attr("id") === "updateSectionContentForm";
        let url = '';
        let method = 'POST';

        if (isUpdate) {
            $('.updateBtn').show();
            $('.submitBtn').hide();
            const id = form.attr("data-id");
            url = `/admin/section-contents/${id}`;
            method = 'POST';
            formData.append('_method', 'PUT');
        } else {
            url = '/admin/section-contents';
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
                        text: response.message || "Section Content saved successfully.",
                        showConfirmButton: false,
                        timer: 1000
                    });

                    if (sectionContentTable) {
                        sectionContentTable.ajax.reload(null, false);
                    }

                    $("#sectionContentModal").modal("hide");
                    form[0].reset();
                    form.attr("id", "SectionContentForm");
                    $('.submitBtn').show();
                    $('.updateBtn').hide();
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

    // Delete content
    $(document).on("click", ".deleteContentBtn", function () {
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
                    url: `/admin/section-contents/${id}`,
                    success: function (response) {
                        Swal.fire({
                            icon: "success",
                            title: "Deleted",
                            text: response.message || "Section Content deleted successfully",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        if (sectionContentTable) {
                            sectionContentTable.ajax.reload(null, false);
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Failed to delete content",
                        });
                    }
                });
            }
        });
    });

});
