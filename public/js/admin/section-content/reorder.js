
$(document).ready(function () {
$('#reorderBtn').on('click', function () {
    let categoryId = $('#categoryFilter').val();
    if (!categoryId) return;

    $.ajax({
        url: `/admin/section-content/${categoryId}/list`,
        type: "GET",
        success: function (items) {
            let listHtml = '';
            items.forEach(item => {
                listHtml += `<li class="list-group-item" data-id="${item.id}">
                                <i class="fas fa-arrows-alt me-2"></i> ${item.title}
                             </li>`;
            });
            $('#sortableList').html(listHtml);

            // Initialize SortableJS
            new Sortable(document.getElementById('sortableList'), {
                animation: 150
            });

            $('#reorderModal').modal('show');
        }
    });
});
$('#saveOrderBtn').on('click', function () {
    let order = [];
    $('#sortableList li').each(function (index) {
        order.push({
            id: $(this).data('id'),
            position: index + 1
        });
    });

    $.ajax({
        url: "/admin/section-content/reorder",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            order: order
        },
        success: function () {
            $('#reorderModal').modal('hide');
            sectionContentTable.ajax.reload(); // reload table

            // SweetAlert success notification
            Swal.fire({
                icon: 'success',
                title: 'Reordered!',
                text: 'Section content order has been updated.',
                timer: 2000,
                showConfirmButton: false
            });
        },
        error: function (err) {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Failed to update order.',
            });
        }
    });
});

});
