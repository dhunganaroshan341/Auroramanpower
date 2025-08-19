Dropzone.autoDiscover = false;

function initSectionCategoryDropzone(categoryId = null, existingImages = []) {
    return new Dropzone("#sectionCategoryDropzone", {
        url: '/admin/section-category/images/upload',
        paramName: "file",
        maxFilesize: 5,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        dictRemoveFile: "×",
        autoProcessQueue: false,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

        init: function () {
            const dz = this;

            // Ensure category_id is always sent
            dz.on("sending", function(file, xhr, formData) {
                if (!categoryId) return; // prevent sending if categoryId undefined
                formData.append('category_id', categoryId);
            });

            // Preload existing images
            existingImages.forEach(image => {
                let mockFile = { name: image.name, size: image.size || 12345, dataURL: image.url, serverId: image.id };
                dz.emit("addedfile", mockFile);
                dz.emit("thumbnail", mockFile, image.url);
                dz.emit("complete", mockFile);
            });

            // Handle remove file
            dz.on("removedfile", function(file) {
                if (!file.serverId) return;
                $('<input>').attr({
                    type: 'hidden',
                    name: 'removed_images[]',
                    value: file.serverId
                }).appendTo('#sectionCategoryForm');

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
    let currentCategoryId = null;

    // ------------------ ADD ------------------
    $(document).on('click', '.addCategoryBtn', function () {
        $('.sectionCategoryForm')[0].reset();
        $('.sectionCategoryForm').attr('id', 'SectionCategoryForm');
        currentCategoryId = null;
        $('#categoryId').val('');
        $('#sectionCategoryModal').modal('show');
        $('.submitBtn').show();
        $('.updateBtn').hide();

        if (sectionCategoryDropzone) sectionCategoryDropzone.destroy();
        sectionCategoryDropzone = initSectionCategoryDropzone(); // empty Dropzone
    });

    // ------------------ EDIT ------------------
    $(document).on('click', '.editCategoryBtn', function () {
        const id = $(this).data('id');
        $('.sectionCategoryForm').attr('id', 'updateSectionCategoryForm');
        $("#updateSectionCategoryForm").attr("data-id", id);
        currentCategoryId = id;
        $('#categoryId').val(id);
        $('#sectionCategoryModal').modal('show');
        $('.submitBtn').hide();
        $('.updateBtn').show();

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

                if (sectionCategoryDropzone) sectionCategoryDropzone.destroy();
                sectionCategoryDropzone = initSectionCategoryDropzone(id, response.images || []);
            },
            error: function () { alert("Failed to fetch category for editing."); }
        });
    });

    // ------------------ SUBMIT ------------------
    $(document).off("submit", ".sectionCategoryForm").on("submit", ".sectionCategoryForm", function (e) {
        e.preventDefault();
        let form = $(this);
        let isUpdate = form.attr("id") === "updateSectionCategoryForm";
        let formData = new FormData(form[0]);
        let url = isUpdate ? `/admin/section-category/${currentCategoryId}` : '/admin/section-category';

        if (isUpdate) formData.append('_method', 'PUT');

        function afterCreateOrUpdate(res) {
            if (!currentCategoryId && res.id) currentCategoryId = res.id; // new ID
            $('#categoryId').val(currentCategoryId);

            // If Dropzone has files, upload them now
            if (sectionCategoryDropzone && sectionCategoryDropzone.getQueuedFiles().length > 0) {
                sectionCategoryDropzone.off("sending"); // remove old listeners
                sectionCategoryDropzone.on("sending", function(file, xhr, formData) {
                    formData.append('category_id', currentCategoryId);
                });
                sectionCategoryDropzone.off("queuecomplete");
                sectionCategoryDropzone.on("queuecomplete", function() {
                    sectionCategoryTable.ajax.reload(null, false);
                    $('#sectionCategoryModal').modal('hide');
                    form[0].reset();
                });
                sectionCategoryDropzone.processQueue();
            } else {
                sectionCategoryTable.ajax.reload(null, false);
                $('#sectionCategoryModal').modal('hide');
                form[0].reset();
            }

            Swal.fire({ icon: "success", title: "Success", text: res.message, timer: 1000, showConfirmButton: false });
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: afterCreateOrUpdate,
            error: function (err) {
                let msg = err.responseJSON?.errors ? Object.values(err.responseJSON.errors).flat().join('\n') : err.responseJSON?.message || "Error";
                Swal.fire({ icon: "error", title: "Error", text: msg });
            }
        });
    });

    // ------------------ DELETE ------------------
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
