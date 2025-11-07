$(document).ready(function () {
    // ====================== CSRF Setup ======================
    $.ajaxSetup({
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    });

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

    const url = "/uploads/" + data; // make sure this path is correct

    return `
        <a href="${url}" target="_blank" class="btn btn-sm btn-outline-primary me-1">
            <i class="fa fa-file"></i> View
        </a>
        <a href="${url}" download class="btn btn-sm btn-outline-success">
            <i class="fa fa-download"></i> Download
        </a>
    `;
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

    // ====================== Delete Handler ======================
    $(document).on("click", ".deleteData", function () {
        const id = $(this).data("id");
        Swal.fire({
            title: "Are you sure?",
            text: "This will permanently delete the profile!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Delete it!",
        }).then((result) => {
            if (!result.isConfirmed) return;
            $.ajax({
                url: "/admin/job-seekers/" + id,
                type: "DELETE",
                success: function (res) {
                    if (res.success) {
                        Swal.fire({ icon: "success", title: "Deleted", showConfirmButton: false, timer: 1500 });
                        table.draw();
                    } else {
                        Swal.fire({ icon: "error", title: "Failed", text: "Cannot delete this profile!" });
                    }
                },
                error: function () {
                    Swal.fire({ icon: "error", title: "Error", text: "An error occurred while deleting the profile." });
                },
            });
        });
    });

    $(document).on('click', '.viewApplicant', function() {
    let id = $(this).data('id');

     $.ajax({
        url: `/admin/job-applications/${id}`,
        type: 'GET',
        success: function(response) {
            if (!response.success || !response.data) {
                alert('Invalid response.');
                return;
            }

            const res = response.data;

            // Fill data into modal
            $('#applicantName').text(res.full_name || '-');
            $('#applicantEmail').text(res.email || '-');
            $('#applicantBio').text(res.bio || '-');
            $('#applicantSkills').text(res.skills || '-');
            $('#applicantExperience').text(res.experience || '-');
            $('#applicantEducation').text(res.education || '-');

            // Applicant image
            if (res.image) {
                $('#applicantImage').attr('src', res.image);
            } else {
                $('#applicantImage').attr('src', 'https://via.placeholder.com/100');
            }

            // Resume file
            if (res.resume_file) {
                $('#resumeSection').html(`
                    <a href="${res.resume_file}" target="_blank" class="btn btn-success">
                        <i class="fa fa-download"></i> Download Resume
                    </a>
                `);
            } else {
                $('#resumeSection').html('<p><em>No resume uploaded.</em></p>');
            }

            // Show modal
            $('#applicantModal').modal('show');
        },
        error: function(xhr) {
            console.error(xhr);
            alert('Failed to load applicant details.');
        }
    });
});


// applied jobs by the applicant
let applicantJobsTable;

    $(document).on("click", ".viewApplicant", function () {
        const jobSeekerId = $(this).data("id");

        // If table already exists, destroy it
        if ($.fn.DataTable.isDataTable("#applicantJobsTable")) {
            $("#applicantJobsTable").DataTable().clear().destroy();
        }

        // Initialize DataTable
        applicantJobsTable = $("#applicantJobsTable").DataTable({
            processing: true,
            serverSide: true,
            ajax: `/admin/job-seekers/${jobSeekerId}/applied-jobs`,
            columns: [
                { data: null, render: (data, type, row, meta) => meta.row + 1 }, // S.N
                { data: "job_title", name: "job_title" },
                { data: "status", name: "status" },
                { data: "applied_on", name: "applied_on" },
                {
                    data: "job_id",
                    render: function (jobId) {
                        return `<a href="/admin/jobs/${jobId}" class="btn btn-sm btn-info" target="_blank">View Job</a>`;
                    },
                    orderable: false,
                    searchable: false
                }
            ],
            responsive: true,
            paging: true,
            lengthChange: false,
            searching: false,
            info: false
        });
    });
});
