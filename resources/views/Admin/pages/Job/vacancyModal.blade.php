<div class="modal fade" id="VacancyFormModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="vacancyModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <form id="vacancyForm" class="form">
                @csrf
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold" id="vacancyModalTitle">➕ Add Vacancy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p id="validationErrors" class="alert alert-danger d-none small"></p>

                    <!-- Company Selection -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Company Info</h6>

                            <div class="d-flex gap-4 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="company_type"
                                        id="company_existing" value="existing" checked>
                                    <label class="form-check-label" for="company_existing">Select Existing</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="company_type"
                                        id="company_custom" value="custom">
                                    <label class="form-check-label" for="company_custom">Add Custom</label>
                                </div>
                            </div>

                            <!-- Existing company -->
                            <div id="existingCompanyWrapper">
                                <label class="form-label small text-muted">Choose Company</label>
                                <select name="company_id" id="company_id" class="form-select">
                                    <option value="">-- Select Company --</option>
                                    {{-- dynamic options --}}
                                </select>
                            </div>

                            <!-- Custom company -->
                            <div id="customCompanyWrapper" class="row g-3 d-none">
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Company Name</label>
                                    <input type="text" name="custom_company_name" id="custom_company_name"
                                        class="form-control" placeholder="Enter company name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Country</label>
                                    <input type="text" name="custom_company_country" id="custom_company_country"
                                        class="form-control" placeholder="Enter country">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jobs List -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Jobs List</h6>

                            <div id="jobsWrapper">
                                <div class="row align-items-end job-item mb-3 border p-3 rounded bg-light">
                                    <div class="col-md-3">
                                        <label class="form-label small text-muted">Job Title</label>
                                        <input type="text" name="jobs[0][title]" class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label small text-muted">Openings</label>
                                        <input type="number" name="jobs[0][openings]" class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label small text-muted">Min Salary</label>
                                        <input type="number" name="jobs[0][salary_min]" class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label small text-muted">Max Salary</label>
                                        <input type="number" name="jobs[0][salary_max]" class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label small text-muted">Currency</label>
                                        <select name="jobs[0][currency]" class="form-select">
                                            <option value="USD">$</option>
                                            <option value="NPR">NPR</option>
                                            <option value="JPY">¥</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 text-end">
                                        <button type="button"
                                            class="btn btn-outline-danger btn-sm remove-job d-none">✖</button>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-sm btn-primary mt-2" id="addJobBtn">➕ Add Job</button>
                        </div>
                    </div>

                    <!-- Vacancy Details -->
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Vacancy Details</h6>

                            <div class="mb-3">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control summernote" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Responsibilities</label>
                                <textarea name="responsibilities" class="form-control summernote"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Requirements</label>
                                <textarea name="requirements" class="form-control summernote"></textarea>
                            </div>

                            <div>
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success submitBtn">Save Vacancy</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Toggle between existing vs custom company
    document.querySelectorAll('input[name="company_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('existingCompanyWrapper').classList.toggle('d-none', this.value !==
                'existing');
            document.getElementById('customCompanyWrapper').classList.toggle('d-none', this.value !==
                'custom');
        });
    });
</script>
