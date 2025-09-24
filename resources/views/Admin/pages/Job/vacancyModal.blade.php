<div class="modal fade" id="JobFormModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="vacancyModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="jobForm" class="form">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="vacancyModalTitle">Add Vacancy</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p id="validationErrors" class="alert alert-danger d-none"></p>

                    <div class="row">
                        <!-- Company -->
                        <div class="col-md-6">
                            <label class="form-label">Company<span class="text-danger">*</span></label>
                            <select name="company_id" id="company_id" class="form-control" required>
                                <option value="">-- Select Company --</option>
                                {{-- dynamic options --}}
                            </select>
                        </div>

                        <!-- Country -->
                        <div class="col-md-6">
                            <label class="form-label">Country<span class="text-danger">*</span></label>
                            <input type="text" name="country" id="country" class="form-control" required>
                        </div>
                    </div>

                    <!-- Jobs List -->
                    <div class="mt-4">
                        <h5>Jobs List</h5>
                        <div id="jobsWrapper">
                            <div class="row job-item mb-3 border p-3 rounded">
                                <div class="col-md-4">
                                    <input type="text" name="jobs[0][title]" class="form-control"
                                        placeholder="Job Title" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="jobs[0][openings]" class="form-control"
                                        placeholder="Openings" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="jobs[0][salary_min]" class="form-control"
                                        placeholder="Min Salary" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="jobs[0][salary_max]" class="form-control"
                                        placeholder="Max Salary" required>
                                </div>
                                <div class="col-md-2">
                                    <select name="jobs[0][currency]" class="form-control">
                                        <option value="USD">$</option>
                                        <option value="NPR">NPR</option>
                                        <option value="JPY">¥</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <button type="button"
                                        class="btn btn-danger btn-sm remove-job d-none">Remove</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary mt-2" id="addJobBtn">+ Add Job</button>
                    </div>

                    <!-- Vacancy Description -->
                    <div class="mt-4">
                        <label class="form-label">Description<span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control summernote" required></textarea>
                    </div>

                    <!-- Responsibilities -->
                    <div class="mt-3">
                        <label class="form-label">Responsibilities</label>
                        <textarea name="responsibilities" class="form-control summernote"></textarea>
                    </div>

                    <!-- Requirements -->
                    <div class="mt-3">
                        <label class="form-label">Requirements</label>
                        <textarea name="requirements" class="form-control summernote"></textarea>
                    </div>

                    <!-- Status -->
                    <div class="mt-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success submitBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
