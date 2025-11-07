<!-- Applicant Info Modal -->
<div class="modal fade" id="applicantModal" tabindex="-1" aria-labelledby="applicantModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="applicantModalLabel">Applicant Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div id="applicantInfo" class="p-3">
          <div class="text-center mb-3">
            <img id="applicantImage" src="https://via.placeholder.com/100" alt="Applicant Image" class="rounded-circle" width="100" height="100">
            <h5 class="mt-2" id="applicantName"></h5>
          </div>

          <p><strong>Email:</strong> <span id="applicantEmail">-</span></p>
          <p><strong>Bio:</strong> <span id="applicantBio">-</span></p>
          <p><strong>Skills:</strong> <span id="applicantSkills">-</span></p>
          <p><strong>Experience:</strong> <span id="applicantExperience">-</span></p>
          <p><strong>Education:</strong> <span id="applicantEducation">-</span></p>

          <div id="resumeSection" class="mt-3"></div>
        </div>
      </div>
    </div>
  </div>
</div>
