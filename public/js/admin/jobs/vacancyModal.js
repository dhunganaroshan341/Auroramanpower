 // Toggle between existing vs custom company
    document.querySelectorAll('input[name="company_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('existingCompanyWrapper').classList.toggle('d-none', this.value !==
                'existing');
            document.getElementById('customCompanyWrapper').classList.toggle('d-none', this.value !==
                'custom');
        });
    });

    // Dynamically add/remove jobs
    $(document).ready(function() {
        let jobIndex = 1;

        $('#addJobBtn').click(function() {
            $('#jobsWrapper').append(`
                <div class="row job-item mb-3 border p-3 rounded bg-light">
                    <div class="col-md-4">
                        <input type="text" name="jobs[${jobIndex}][title]" class="form-control" placeholder="Job Title" required>
                    </div>
                    <div class="col-md-4">
                        <select name="jobs[${jobIndex}][categories][]" class="form-select" multiple required>
                            <option value="factory">Factory</option>
                            <option value="driver">Driver</option>
                            <option value="welder">Welder</option>
                            <option value="technician">Technician</option>
                            <option value="other">Other</option>
                        </select>
                        <small class="text-muted">Hold Ctrl (Windows) / Cmd (Mac) to select multiple</small>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="jobs[${jobIndex}][openings]" class="form-control" placeholder="Openings" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="jobs[${jobIndex}][salary]" class="form-control" placeholder="Salary" required>
                    </div>
                    <div class="col-md-12 mt-2 text-end">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-job">✖ Remove</button>
                    </div>
                </div>
            `);
            jobIndex++;
        });

        // Remove job row
        $(document).on('click', '.remove-job', function() {
            $(this).closest('.job-item').remove();
        });
    });
