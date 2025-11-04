$(function () {
    // ====================== CSRF Setup ======================
    $.ajaxSetup({
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    });

    // ====================== Initialize Bootstrap Modal ======================
    const jobSeekerModal = new bootstrap.Modal(document.getElementById("jobSeekerModal"));

    // ====================== Initialize DataTable ======================
    const table = $("#show-jobseeker-data").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "/admin/job-seekers",
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [[1, "asc"]],
        columns: [
            { data: "DT_RowIndex", orderable: false, searchable: false },
            { data: "name", name: "name" },
            { data: "email", name: "email" },
            { data: "phone", name: "phone" },
            { data: "skills", name: "skills", orderable: false, searchable: true },
            { data: "experience", name: "experience", orderable: false, searchable: true },
            { data: "education", name: "education", orderable: false, searchable: true },
            {
                data: "resume_file",
                orderable: false,
                searchable: false,
                render: function (data) {
                    if (!data) return "<em>No File</em>";
                    return `<a href="/uploads/resumes/${data}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-file"></i> View
                            </a>`;
                },
            },
            { data: "action", name: "action", orderable: false, searchable: false },
        ],
        dom: '<"d-flex justify-content-between align-items-center mb-2"Bf>rtip',
        buttons: [
            { extend: "print", text: '<i class="fa fa-print me-1"></i> Print', className: "btn btn-outline-secondary btn-sm" },
            { extend: "excel", text: '<i class="fa fa-file-excel me-1"></i> Excel', className: "btn btn-outline-success btn-sm", title: "Job Seeker Profiles" },
        ],
        columnDefs: [{ className: "text-center align-middle", targets: "_all" }],
    });

    table.on("draw", () => $('[data-bs-toggle="tooltip"]').tooltip());

    // ====================== Modal Handlers ======================
    function openModal(action, id = null) {
        clearModal();
        if (action === "add") {
            $(".submitBtn").show();
            $(".updateBtn").hide();
        } else {
            $(".submitBtn").hide();
            $(".updateBtn").show().data("id", id);
        }

        $("#jobSeekerModalLabel").text(action === "add" ? "Add Job Seeker Profile" : "Update Job Seeker Profile");
        jobSeekerModal.show();

        if (action === "update" && id) {
            $.get("/admin/job-seekers/" + id, function (res) {
                if (res.success) populateModal(res.data);
            });
        }
    }

    $(document).on("click", ".addJobSeekerBtn", () => openModal("add"));
    $(document).on("click", ".editData", function () {
        openModal("update", $(this).data("id"));
    });

    // ====================== Populate Modal ======================
    function populateModal(profile) {
        $("#name").val(profile.name);
        $("#email").val(profile.email);
        $("#phone").val(profile.phone);
        $("#skills").val(profile.skills);
        $("#experience").val(profile.experience);
        $("#education").val(profile.education);
        if (profile.resume_file) {
            $("#previewResume").html(
                `<a href="/uploads/resumes/${profile.resume_file}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="fa fa-file"></i> View Current Resume
                </a>`
            );
        } else {
            $("#previewResume").html("<em>No Resume Uploaded</em>");
        }
    }

    // ====================== Form Submit ======================
    function submitForm(action, id = "") {
        const form = $("#jobSeekerForm");
        const formData = new FormData(form[0]);
        if (action === "update") formData.append("_method", "PUT");

        $.ajax({
            type: "POST",
            url: action === "add" ? "/admin/job-seekers" : "/admin/job-seekers/" + id,
            data: formData,
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
                    jobSeekerModal.hide();
                } else {
                    Swal.fire({ icon: "warning", title: "Failed", text: "Please try again!" });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let html = "<ul>";
                    $.each(errors, (k, v) => (html += `<li>${v[0]}</li>`));
                    html += "</ul>";
                    $("#validationErrors").removeClass("d-none").html(html);
                }
            },
        });
    }

    $(".submitBtn").on("click", function (e) {
        e.preventDefault();
        submitForm("add");
    });

    $(".updateBtn").on("click", function (e) {
        e.preventDefault();
        submitForm("update", $(this).data("id"));
    });

    // ====================== Delete Handler ======================
    $(document).on("click", ".deleteData", function () {
        const id = $(this).data("id");
        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            text: "This will permanently delete the profile!",
            showCancelButton: true,
            confirmButtonText: "Yes, Delete it!",
        }).then((result) => {
            if (!result.isConfirmed) return;
            $.post("/admin/job-seekers/" + id, {
                _method: "DELETE",
                _token: $('meta[name="csrf-token"]').attr("content"),
            }, function (res) {
                if (res.success) {
                    Swal.fire({ icon: "success", title: "Deleted", showConfirmButton: false, timer: 1500 });
                    table.draw();
                }
            });
        });
    });

    // ====================== Helper: Clear Modal ======================
    function clearModal() {
        $("#jobSeekerForm")[0].reset();
        $("#validationErrors").addClass("d-none").html("");
        $("#previewResume").html("");
        $(".submitBtn").show();
        $(".updateBtn").hide();
    }
});
