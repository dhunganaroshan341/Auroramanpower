$(document).ready(function () {
    // CSRF Setup
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
        // ========== DATATABLE ==========

     // ✅ Initialize DataTable (no extra $(document).ready)
    var table = $("#show-job-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/admin/jobs",
            type: "GET",
        },
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        order: [[1, "asc"]],
        columns: [
            { data: "DT_RowIndex", orderable: false, searchable: false },
            { data: "image", orderable: false, searchable: false },
            { data: "title" },
            { data: "employer", name: "employer.name" },
            { data: "location" },
            { data: "salary" },
            { data: "status", orderable: false, searchable: false },
            { data: "action", orderable: false, searchable: false },
        ],
        dom: '<"toolbar">Blfrtip',
        buttons: [
            {
                extend: "print",
                exportOptions: { columns: [0, 2, 3, 4, 5, 6] },
            },
            {
                extend: "excel",
                title: "",
                exportOptions: { columns: [0, 2, 3, 4, 5, 6] },
            },
        ],
    });



    $(".summernote").summernote({ height: 300 });

$(".generalRequirementsSummernote").on("summernote.init", function() {
    $(this).summernote("code", `
        <ul>
            <li>Age: 21-40 years</li>
            <li>Sex: Male/Female</li>
            <li>Education: High School / Diploma or above</li>
            <li>Experience: Relevant Field Experience preferred</li>
            <li>Skills: Teamwork, adaptability</li>
        </ul>
    `);
});
$(".generalRequirementsSummernote").summernote(); // call init after binding event



    // Bootstrap 5 Modal instance
    var jobModal = new bootstrap.Modal(document.getElementById("JobFormModal"));

    // ========== ADD JOB ==========
    $(document).on("click", ".addJobBtn", function () {
        clearModal();
        $(".submitBtn").show();
        $(".updateBtn").hide();
        $("#jobForm").data("action", "add").removeData("id");
        $("#jobModalTitle").text("Add Job");
        jobModal.show();
    });

    // ========== EDIT JOB ==========
    $(document).on("click", ".editJobButton", function () {
        clearModal();
        $(".submitBtn").hide();
        $(".updateBtn").show();
        $("#jobForm").data("action", "update").data("id", $(this).data("id"));
        $("#jobModalTitle").text("Edit Job");
        jobModal.show();
    });

    // ========== SUBMIT FORM ==========
    $(document).off("submit", "#jobForm").on("submit", "#jobForm", function (e) {
        e.preventDefault();

        let action = $(this).data("action");
        let id = $(this).data("id") || "";

        let formdata = new FormData(this);
        if (action === "update") {
            formdata.append("_method", "PUT");
        }

        $.ajax({
            type: "POST",
            url: action === "add" ? "/admin/jobs/" : "/admin/jobs/" + id,
            data: formdata,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.success) {
                    Swal.fire({
                        icon: "success",
                        title: action === "add" ? "Created" : "Updated",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    table.draw();
                    jobModal.hide();
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Failed",
                        text: "Please try again!",
                    });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let html = "<ul>";
                    $.each(errors, (k, v) => (html += `<li>${v[0]}</li>`));
                    html += "</ul>";
                    $("#validationErrors").removeClass("d-none").html(html);
                }
            },
        });
    });



    // Toolbar
    $("div.toolbar").html(`
        <button id="btnPrint" class="btn btn-primary mdi mdi-printer mdi-icon"></button>
        <button id="btnExport" class="btn btn-success mdi mdi-file-export mdi-icon"></button>
    `);

    $("#btnPrint").on("click", () => table.button(0).trigger());
    $("#btnExport").on("click", () => table.button(1).trigger());

    // ========== HELPER: RESET MODAL ==========
    function clearModal() {
        $("#jobImage").html("");
        $("#jobPdf").html("");
        $("#validationErrors").addClass("d-none").html("");
        $("#jobDescription").summernote("code", "");
        $("#jobRequirements").summernote("code", "");
        $("#jobForm")[0].reset();
    }

    // ========== TOGGLE STATUS ==========
    $(document).on("change", ".statusIdData", function () {
        let id = $(this).data("id");
        let checkbox = $(this).prop("disabled", true);

        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            showCancelButton: true,
            confirmButtonText: "Yes, Change it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.get("/admin/jobs/status/" + id, function () {
                    checkbox.prop("disabled", false);
                    table.draw();
                }).fail(() => checkbox.prop("disabled", false));
            } else {
                checkbox
                    .prop("disabled", false)
                    .prop("checked", !checkbox.prop("checked"));
            }
        });
    });

    // ========== DELETE JOB ==========
    $(document).on("click", ".deleteData", function () {
        let id = $(this).data("id");

        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonText: "Yes, Delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/admin/jobs/" + id,
                    data: {
                        _method: "DELETE",
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function (res) {
                        if (res.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Deleted",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            table.draw();
                        }
                    },
                });
            }
        });
    });
});
