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

                    <!-- Company Selection -->
                    <div class="mb-4">
                        <label class="form-label d-block">Company<span class="text-danger">*</span></label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="company_type" id="company_existing"
                                value="existing" checked>
                            <label class="form-check-label" for="company_existing">Select Existing</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="company_type" id="company_custom"
                                value="custom">
                            <label class="form-check-label" for="company_custom">Add Custom</label>
                        </div>

                        <!-- Existing company -->
                        <div id="existingCompanyWrapper" class="mt-3">
                            <select name="company_id" id="company_id" class="form-control">
                                <option value="">-- Select Company --</option>
                                {{-- dynamic options --}}
                            </select>
                        </div>

                        <!-- Custom company -->
                        <div id="customCompanyWrapper" class="row mt-3 d-none">
                            <div class="col-md-6">
                                <input type="text" name="custom_company_name" id="custom_company_name"
                                    class="form-control" placeholder="Company Name">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="custom_company_country" id="custom_company_country"
                                    class="form-control" placeholder="Country">
                            </div>
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
                                <div class="col-md-12 mt-2 text-end">
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

<script>
    document.querySelectorAll('input[name="company_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'existing') {
                document.getElementById('existingCompanyWrapper').classList.remove('d-none');
                document.getElementById('customCompanyWrapper').classList.add('d-none');
            } else {
                document.getElementById('existingCompanyWrapper').classList.add('d-none');
                document.getElementById('customCompanyWrapper').classList.remove('d-none');
            }
        });
    });
</script>
