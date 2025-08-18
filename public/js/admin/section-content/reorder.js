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
