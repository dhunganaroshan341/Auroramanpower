<!-- Applicant Info Modal -->
<div class="modal fade" id="applicantModal" tabindex="-1" aria-labelledby="applicantModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl"> <!-- Make modal wider for table -->
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="applicantModalLabel">Applicant Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div id="applicantInfo" class="p-3">
          <!-- Applicant Basic Info -->
          <div class="text-center mb-3">
            <img id="applicantImage" src="https://via.placeholder.com/100" alt="Applicant Image" class="rounded-circle" width="100" height="100">
            <h5 class="mt-2" id="applicantName">-</h5>
          </div>

          <div class="row mb-3">
            <div class="col-md-6"><strong>Email:</strong> <span id="applicantEmail">-</span></div>
            <div class="col-md-6"><strong>Bio:</strong> <span id="applicantBio">-</span></div>
          </div>

          <div class="row mb-3">
            <div class="col-md-4"><strong>Skills:</strong> <span id="applicantSkills">-</span></div>
            <div class="col-md-4"><strong>Experience:</strong> <span id="applicantExperience">-</span></div>
            <div class="col-md-4"><strong>Education:</strong> <span id="applicantEducation">-</span></div>
          </div>

          <div id="resumeSection" class="mb-4"></div>

          <!-- Jobs Applied Table -->
          <h6>Applied Jobs</h6>
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="applicantJobsTable" style="width:100%">
              <thead>
                <tr>
                  <th>S.N</th>
                  <th>Job Title</th>
                  <th>Status</th>
                  <th>Applied On</th>
                  <th class = 'viewJob'> view jobs <th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
