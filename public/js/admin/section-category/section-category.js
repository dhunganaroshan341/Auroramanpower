Dropzone.autoDiscover = false;

// Initialize Dropzone separately
function initSectionCategoryDropzone(existingImages = []) {
    return new Dropzone("#sectionCategoryDropzone", {
        url: '/admin/section-category/images/upload',
        paramName: "file",
        maxFilesize: 5,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        dictRemoveFile: "×",
        autoProcessQueue: false, // process manually
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

        init: function () {
            const dz = this;

            // Preload existing images
            existingImages.forEach(image => {
                let mockFile = { name: image.name, size: image.size || 12345, dataURL: image.url, serverId: image.id };
                dz.emit("addedfile", mockFile);
                dz.emit("thumbnail", mockFile, image.url);
                dz.emit("complete", mockFile);
            });

            dz.on("removedfile", function(file) {
                if (!file.serverId) return; // skip local files
                $('<input>').attr({
                    type: 'hidden',
                    name: 'removed_images[]',
                    value: file.serverId
                }).appendTo('#sectionCategoryForm');

                // Optional: delete immediately from server
                $.ajax({
                    url: '/section-category/images/delete/' + file.serverId,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: res => console.log('Deleted:', res),
                    error: err => console.error('Delete failed', err)
                });
            });
        }
    });
}

// ------------------ Main jQuery ------------------
$(document).ready(function () {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    let sectionCategoryTable = $("#section-category-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/section-category",
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'title', name: 'title' },
            { data: 'sub_heading', name: 'sub_heading' },
            { data: 'slug', name: 'slug' },
            { data: 'image', name: 'image' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    let sectionCategoryDropzone;

    // Add Category
    $(document).on('click', '.addCategoryBtn', function () {
        $('.sectionCategoryForm')[0].reset();
        $('.sectionCategoryForm').attr('id', 'SectionCategoryForm');
        $('#sectionCategoryModal').modal('show');
        $('.submitBtn').show();
        $('.updateBtn').hide();

        // Initialize Dropzone empty for new form
        if (sectionCategoryDropzone) sectionCategoryDropzone.destroy();
        sectionCategoryDropzone = initSectionCategoryDropzone([]);
    });

    // Edit Category
    $(document).on('click', '.editCategoryBtn', function () {
        const id = $(this).data('id');
        $('.sectionCategoryForm').attr('id', 'updateSectionCategoryForm');
        $("#updateSectionCategoryForm").attr("data-id", id);
        $('#categoryId').val(id);
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
                $('#video').val(response.video);
                $('#slug').val(response.slug);
                $('#description').val(response.description);
                $('#description2').val(response.description2);
                renderImage(response.image, "#imagePreview");

                // Destroy and re-init Dropzone with existing images
                if (sectionCategoryDropzone) sectionCategoryDropzone.destroy();
                sectionCategoryDropzone = initSectionCategoryDropzone(response.images || []);
            },
            error: function () { alert("Failed to fetch category for editing."); }
        });
    });

    // Submit form (create/update)
    $(document).off("submit", ".sectionCategoryForm").on("submit", ".sectionCategoryForm", function (e) {
        e.preventDefault();
        let form = $(this);
        let isUpdate = form.attr("id") === "updateSectionCategoryForm";

        // Append removed images hidden inputs already handled in Dropzone
        function submitForm() {
            let formData = new FormData(form[0]);
            if (isUpdate) {
                const id = form.attr("data-id");
                formData.append('_method', 'PUT');
                url = `/admin/section-category/${id}`;
            } else {
                url = '/admin/section-category';
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    Swal.fire({ icon: "success", title: "Success", text: res.message, timer: 1000, showConfirmButton: false });
                    $("#sectionCategoryModal").modal("hide");
                    form[0].reset();
                    sectionCategoryTable.ajax.reload(null, false);
                },
                error: function (err) {
                    let msg = err.responseJSON?.errors ? Object.values(err.responseJSON.errors).flat().join('\n') : err.responseJSON?.message || "Error";
                    Swal.fire({ icon: "error", title: "Error", text: msg });
                }
            });
        }

        // If Dropzone has files, process them first
        if (sectionCategoryDropzone.getQueuedFiles().length > 0) {
            sectionCategoryDropzone.on("queuecomplete", function() {
                submitForm();
            });
            sectionCategoryDropzone.processQueue();
        } else {
            submitForm();
        }
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
                    url: `/admin/section-category/${id}`,
                    success: function(res) {
                        Swal.fire({ icon: "success", title: "Deleted", text: res.message, timer: 1500, showConfirmButton: false });
                        sectionCategoryTable.ajax.reload(null, false);
                    }
                });
            }
        });
    });
});
