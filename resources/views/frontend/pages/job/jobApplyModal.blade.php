<!-- Apply Job Modal -->
<div class="modal fade" id="applyJobModal" tabindex="-1" aria-labelledby="applyJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyJobModalLabel">Apply for a Vacancy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="applyJobForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="job_id" id="job_id" value="{{ $jobId ?? '' }}">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="desired_role" class="form-label">Position You’re Applying For</label>
                            <input type="text" name="desired_role" id="desired_role" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label for="name" class="form-label">Full Name *</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label for="resume_file" class="form-label">Upload Your CV</label>
                            <input type="file" name="resume_file" id="resume_file" accept=".pdf,.doc,.docx"
                                class="form-control" required>
                            <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX</small>
                        </div>
                        <div class="col-12">
                            <label for="bio" class="form-label">Additional Information</label>
                            <textarea name="bio" id="bio" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn theme-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn theme-btn active submitBtn">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- AJAX Submission Script -->
    <script>
        $(document).ready(function() {
            $('#applyJobForm').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                var jobId = $('#job_id').val();
                var url = `/jobs/${jobId}/apply`; // dynamically construct URL

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    beforeSend: function() {
                        $('.submitBtn').attr('disabled', true);
                    },
                    success: function(response) {
                        $('.submitBtn').attr('disabled', false);
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Applied!',
                                text: response.message,
                            }).then(() => {
                                $('#applyJobModal').modal('hide');
                                $('#applyJobForm')[0].reset();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Something went wrong',
                            });
                        }
                    },
                    error: function(xhr) {
                        $('.submitBtn').attr('disabled', false);
                        let errors = xhr.responseJSON?.errors;
                        let errorMsg = '';

                        if (errors) {
                            for (let field in errors) {
                                errorMsg += errors[field].join(' ') + '\n';
                            }
                        } else {
                            errorMsg = xhr.responseJSON?.message || 'Something went wrong';
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: errorMsg,
                        });
                    }
                });
            });
        });
    </script>
@endpush
