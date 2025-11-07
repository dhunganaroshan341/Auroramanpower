$(function () {
    // ====================== CSRF Setup ======================
   $.ajaxSetup({
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    });
       // ====================== Initialize Summernote ======================
    $(".summernote").summernote({ height: 300 });
//   make status pending by default on load
    $('#statusFilter').val('Pending');


    $(".generalRequirementsSummernote").on("summernote.init", function () {
        $(this).summernote("code", `
            <ul>
                <li>Age: 21-40 years</li>
                <li>Sex: Male/Female</li>
                <li>Education: High School / Diploma or above</li>
                <li>Experience: Relevant Field Experience preferred</li>
                <li>Skills: Teamwork, adaptability</li>
            </ul>
        `);
    }).summernote();

    

    let defaultJobId = $('#show-application-data').data('job-id');

      let table = $('#show-application-data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/admin/job-applications/",
            data: function (d) {
                d.job_id = $('#jobFilter').val();
                d.status = $('#statusFilter').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'job_title', name: 'job_title' },
            { data: 'job_seeker', name: 'job_seeker' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $('#jobFilter, #statusFilter').change(function () {
        table.ajax.reload();
    });


 



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
        $("#jobModalTitle").text(action === "add" ? "Add Job" : "Update Job");
        jobModal.show();

        if (action === "update" && id) {
            $.get("/admin/jobs/" + id, function (res) {
                if (res.success) populateModal(res.data);
            });
        }
    }

    $(document).on("click", ".addJobBtn", () => openModal("add"));
    $(document).on("click", ".editUserButton", function () {
        openModal("update", $(this).data("id"));
    });

    // ====================== Populate Modal ======================
    function populateModal(job) {
        $('#our_country_id').val(job.our_country_id).trigger('change');
        $('#category_ids').val(job.categories.map(cat => cat.id)).trigger('change');
        $('#title').val(job.title);
        $('#description').summernote('code', job.description);
        $('#location').val(job.location);
        $('#salary').val(job.salary);
        $('#custom_company_name').val(job.custom_company_name);
        $('#job_code').val(job.job_code);
        $('#male_opening').val(job.male_opening);
        $('#female_opening').val(job.female_opening);
        $('#total_openings').val(job.total_openings);
        $('#status').val(job.status.toLowerCase());
        $('#interview_date').val(job.interview_date);
        $('#link').val(job.link);
        $('#icon_class').val(job.icon_class);
        $('#requirements').val(job.requirements);
         if (job.image != null) {
                    $("#previewImage").html(
                        `<img src="/${job.image}"
                                  alt="User Image"
                                  width="100"
                                  height="100"
                                  onerror="this.onerror=404; this.src='/user.png';">`
                    );
                } else {
                    $("#previewImage").html(
                        `<img src="user.png"
                                  alt="Default Image"
                                  width="100"
                                  height="100">`
                    );
                }

        const mode = (job.male_opening > 0 || job.female_opening > 0) ? 'male-female' : 'total';
        $('#openingsMode').val(mode).trigger('change');
        $('#openings_mode').val(mode);
    }

    // ====================== Form Submit ======================
    function submitForm(action, id = "") {
        const form = $("#jobForm");
        const formData = new FormData(form[0]);
        if (action === "update") formData.append("_method", "PUT");

        $.ajax({
            type: "POST",
            url: action === "add" ? "/admin/jobs/" : "/admin/jobs/" + id,
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.success) {
                    Swal.fire({ icon: "success", title: action === "add" ? "Created" : "Updated", showConfirmButton: false, timer: 1000 });
                    table.draw();
                    jobModal.hide();
                } else Swal.fire({ icon: "warning", title: "Failed", text: "Please try again!" });
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let html = "<ul>";
                    $.each(errors, (k, v) => html += `<li>${v[0]}</li>`);
                    html += "</ul>";
                    $("#validationErrors").removeClass("d-none").html(html);
                }
            },
        });
    }

    // ====================== Submit Buttons ======================
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
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonText: "Yes, Delete it!",
        }).then((result) => {
            if (!result.isConfirmed) return;
            $.post("/admin/job-applications/" + id, { _method: "DELETE", _token: $('meta[name="csrf-token"]').attr("content") }, function (res) {
                if (res.success) {
                    Swal.fire({ icon: "success", title: "Deleted", showConfirmButton: false, timer: 1500 });
                    table.draw();
                }
            });
        });
    });

    // ====================== Status Toggle ======================
    $(document).on("change", ".statusIdData", function () {
        const checkbox = $(this).prop("disabled", true);
        const id = $(this).data("id");

        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            showCancelButton: true,
            confirmButtonText: "Yes, Change it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.get("/admin/jobs/status/" + id).always(() => {
                    checkbox.prop("disabled", false);
                    table.draw();
                });
            } else {
                checkbox.prop("disabled", false).prop("checked", !checkbox.prop("checked"));
            }
        });
    });

    // ====================== Openings Mode Toggle ======================
    $("#openingsMode").on("change", function () {
        const mode = this.value;
        $("#openings_mode").val(mode);
        if (mode === "male-female") {
            $("#totalOpeningsWrapper").addClass("d-none");
            $("#maleFemaleWrapper").removeClass("d-none");
        } else {
            $("#totalOpeningsWrapper").removeClass("d-none");
            $("#maleFemaleWrapper").addClass("d-none");
        }
    });

    // ====================== Helper: Clear Modal ======================
    function clearModal() {
        $("#jobForm")[0].reset();
        $("#validationErrors").addClass("d-none").html("");
        $(".summernote").summernote("code", "");
        $("#category_ids, #our_country_id").val(null).trigger("change");
        $(".submitBtn").show();
        $(".updateBtn").hide();
    }


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

// Change application status
$(document).on('change', '.application-status', function() {
    const id = $(this).data('id');
    const newStatus = $(this).val();

    Swal.fire({
        icon: 'warning',
        title: 'Change Status?',
        text: `Are you sure you want to change the status to "${newStatus}"?`,
        showCancelButton: true,
        confirmButtonText: 'Yes, change it!',
    }).then((result) => {
        if (!result.isConfirmed) return;

        $.ajax({
            url: `/admin/job-applications/${id}/status`,
            type: 'PATCH',
            data: { status: newStatus, _token: $('meta[name="csrf-token"]').attr('content') },
            success: function(res) {
                if (res.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Status Updated',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Redraw DataTable to reflect changes
                    $('#show-application-data').DataTable().ajax.reload(null, false);
                } else {
                    Swal.fire('Error', res.message || 'Failed to update status', 'error');
                }
            },
            error: function(xhr) {
                console.error(xhr);
                Swal.fire('Error', 'Failed to update status', 'error');
            }
        });
    });
});

});
