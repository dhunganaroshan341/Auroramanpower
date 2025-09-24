<!-- Apply Job Modal -->
<div class="modal fade" id="applyJobModal" tabindex="-1" aria-labelledby="applyJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="applyJobModalLabel">Apply for a Vacancy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form method="post" action="{{ route('jobseeker.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">

                        <!-- Desired Role -->
                        <div class="col-12">
                            <label for="desired_role" class="form-label">Position You’re Applying For</label>
                            <input type="text" name="desired_role" id="desired_role"
                                placeholder="e.g. Senior IT Manager (Japan)" class="form-control"
                                value="{{ old('desired_role') }}" required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                required>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"
                                required>
                        </div>

                        <!-- Upload CV -->
                        <div class="col-12">
                            <label for="resume_file" class="form-label">Upload Your CV</label>
                            <input type="file" name="resume_file" id="resume_file" accept=".pdf,.doc,.docx"
                                class="form-control" required>
                            <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX</small>
                        </div>

                        <!-- Additional Info -->
                        <div class="col-12">
                            <label for="bio" class="form-label">Additional Information</label>
                            <textarea name="bio" id="bio" rows="3" class="form-control">{{ old('bio') }}</textarea>
                        </div>

                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit Application</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
