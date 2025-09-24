$(document).ready(function () {
    let jobIndex = 1;

    $('#addJobBtn').click(function () {
        $('#jobsWrapper').append(`
          <div class="row job-item mb-3 border p-3 rounded">
            <div class="col-md-4">
              <input type="text" name="jobs[${jobIndex}][title]" class="form-control" placeholder="Job Title" required>
            </div>
            <div class="col-md-2">
              <input type="number" name="jobs[${jobIndex}][openings]" class="form-control" placeholder="Openings" required>
            </div>
            <div class="col-md-2">
              <input type="number" name="jobs[${jobIndex}][salary_min]" class="form-control" placeholder="Min Salary" required>
            </div>
            <div class="col-md-2">
              <input type="number" name="jobs[${jobIndex}][salary_max]" class="form-control" placeholder="Max Salary" required>
            </div>
            <div class="col-md-2">
              <select name="jobs[${jobIndex}][currency]" class="form-control">
                <option value="USD">$</option>
                <option value="EURO">euro</option>
                <option value="NPR">NPR</option>
                <option value="JPY">¥</option>
                <option value="DHI">dhiram</option>
              </select>
            </div>
            <div class="col-md-12 mt-2">
              <button type="button" class="btn btn-danger btn-sm remove-job">Remove</button>
            </div>
          </div>
        `);
        jobIndex++;
    });

    // remove job row
    $(document).on('click', '.remove-job', function () {
        $(this).closest('.job-item').remove();
    });
});
