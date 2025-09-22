$(document).ready(function () {
    $(".summernote").summernote({
        height: 300
    });

    // Data Table
    var table = $("#show-job-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/jobs",
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       order: [[1, 'asc']],

        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "image", name: "image", orderable: false, searchable: false },
            { data: "title", name: "title" },
            { data: "employer", name: "employer.name" },
            { data: "location", name: "location" },
            { data: "salary", name: "salary" },
            { data: "status", name: "status", orderable: false, searchable: false },
            { data: "action", name: "action", orderable: false, searchable: false }
        ],
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: { columns: [0, 2, 3, 4, 5, 6] }
            }, {
                extend: 'excel',
                title: '',
                exportOptions: { columns: [0, 2, 3, 4, 5, 6] }
            }
        ],
        dom: '<"toolbar">lfrtip',
    });

    $("div.toolbar").html(`
        <span id="btnPrint" class="btn btn-primary mdi mdi-printer mdi-icon"></span>
        <span id="btnExport" class="btn btn-success mdi mdi-file-export mdi-icon"></span>
    `);

    $('#btnPrint').on('click', () => table.button(0).trigger());
    $('#btnExport').on('click', () => table.button(1).trigger());

    // Helper: clear modal
    function clearModal() {
        $("#jobImage").html("");
        $("#jobPdf").html("");
        $("#validationErrors").addClass("d-none").html("");
        $("#jobDescription").summernote("code", "");
        $("#jobRequirements").summernote("code", "");
    }

    // Add Job
    $(document).on("click", ".addJobBtn", function () {
        clearModal();
        $("#formModal").modal("show");
        $(".submitBtn").show();
        $(".updateBtn").hide();
        $(".form").attr("id", "addForm");
        $("#addForm")[0].reset();
    });

    $(document).off("submit", "#addForm").on("submit", "#addForm", function (event) {
        event.preventDefault();
        $(".submitBtn").prop("disabled", true);
        let formdata = new FormData(this);
        $.ajax({
            type: "post",
            url: "/admin/jobs/store",
            data: formdata,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    Swal.fire({ icon: "success", title: "Success", text: "Job Created Successfully", showConfirmButton: false, timer: 1000 });
                    table.draw();
                    $("#addForm")[0].reset();
                    $("#formModal").modal("hide");
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
        })
    });

    // Edit Job
    $(document).on("click", ".editJobButton", function () {
        clearModal();
        $("#formModal").modal("show");
        $(".submitBtn").hide();
        $(".updateBtn").show();
        $(".form").attr("id", "updateForm");

        var id = $(this).attr("data-id");
        $.ajax({
            type: "get",
            url: "/admin/jobs/detail/" + id,
            success: function (response) {
                $("#title").val(response.message.title);
                $("#location").val(response.message.location);
                $("#salary").val(response.message.salary);
                $("#link").val(response.message.link);
                $("#icon_class").val(response.message.icon_class);
                $("#jobDescription").summernote('code', response.message.description);
                $("#jobRequirements").summernote('code', response.message.requirements);

                if (response.message.image) {
                    $("#jobImage").html(`<img src="/uploads/${response.message.image}" alt="Job Image" width="100" height="100" onerror="this.src='/defaultimage/defaultimage.webp';">`);
                }
                if (response.message.pdf) {
                    $("#jobPdf").html(`<a href="/uploads/${response.message.pdf}" target="_blank" class="btn btn-sm btn-info">View PDF</a>`);
                }
            }
        });

        $("#updateForm").off("submit").on("submit", function (event) {
            event.preventDefault();
            $(".updateBtn").prop("disabled", true);
            let formdata = new FormData(this);
            $.ajax({
                type: "post",
                url: "/admin/jobs/update/" + id,
                data: formdata,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({ icon: "success", title: "Success", text: "Job Updated Successfully", showConfirmButton: false, timer: 1000 });
                        table.draw();
                        $("#formModal").modal("hide");
                    } else {
                        Swal.fire({ icon: "warning", title: "Something went wrong!", text: "Please try again!" });
                    }
                },
                error: function () {
                    Swal.fire({ icon: "warning", title: "Something went wrong!", showConfirmButton: false, timer: 1500 });
                },
                complete: () => $(".updateBtn").prop("disabled", false)
            })
        })
    });

    // Status Toggle
    $(document).on("change", ".statusIdData", function () {
        let id = $(this).data("id");
        let checkbox = $(this);
        checkbox.prop("disabled", true);
        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            showCancelButton: true,
            cancelButtonColor: "#d33",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes, Change it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "/admin/jobs/status/" + id,
                    success: function () {
                        checkbox.prop("disabled", false);
                        table.draw();
                    },
                    error: () => checkbox.prop("disabled", false)
                })
            } else {
                checkbox.prop("disabled", false).prop("checked", !checkbox.prop("checked"));
            }
        })
    });

    // Delete Job
    $(document).on("click", ".deleteData", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            icon: "warning",
            title: "Are you Sure?",
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonText: "Yes, Delete it!",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "/admin/jobs/delete/" + id,
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({ icon: "success", title: "Job Deleted Successfully", showConfirmButton: false, timer: 1500 });
                            table.draw();
                        } else {
                            Swal.fire({ icon: "warning", title: "Something went wrong!", text: "Please try again!" });
                        }
                    },
                    error: () => Swal.fire({ icon: "warning", title: "Something went wrong!", showConfirmButton: false, timer: 1500 })
                })
            }
        })
    });
});
