<div class="modal fade" id="VacancyFormModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="vacancyModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="vacancyForm" class="form">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="vacancyModalTitle">Add Vacancy</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="validationErrors" class="alert alert-danger d-none"></p>
                    <div class="row">

                        <span class="mt-2 mb-4">
                            <span class="text-danger">Note:</span> (<span class="text-danger">*</span>) required fields
                        </span>

                        <!-- Job Title -->
                        <div class="col-md-6">
                            <label class="form-label">Job Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="e.g. Software Engineer">
                        </div>

                        <!-- Company -->
                        <div class="col-md-6">
                            <label class="form-label">Company<span class="text-danger">*</span></label>
                            <select name="company_id" id="company_id" class="form-control">
                                <option value="">-- Select Company --</option>
                                {{-- Options dynamically --}}
                            </select>
                        </div>

                        <!-- Country -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label">Country<span class="text-danger">*</span></label>
                            <input type="text" name="country" id="country" class="form-control"
                                placeholder="e.g. Nepal">
                        </div>

                        <!-- Location -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" id="location" class="form-control"
                                placeholder="e.g. Kathmandu">
                        </div>

                        <!-- Salary Expectation -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label">Salary Expectation</label>
                            <input type="text" name="salary_expectation" id="salary_expectation" class="form-control"
                                placeholder="e.g. 50,000 NPR">
                        </div>

                        <!-- Age Limit -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label">Age Limit</label>
                            <input type="number" name="age_limit" id="age_limit" class="form-control"
                                placeholder="e.g. 35">
                        </div>

                        <!-- Skills (Dynamic) -->
                        <div class="col-md-12 mt-3">
                            <label class="form-label">Skills<span class="text-danger">*</span></label>
                            <div id="skillsWrapper">
                                <div class="d-flex mb-2 skill-item">
                                    <input type="text" name="skills[]" class="form-control"
                                        placeholder="e.g. PHP, Laravel">
                                    <button type="button" class="btn btn-danger ms-2 remove-skill">X</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary mt-2" id="addSkillBtn">+ Add
                                Skill</button>
                        </div>

                        <!-- Categories -->
                        <div class="col-md-12 mt-3">
                            <label class="form-label">Categories</label>
                            <select name="category_ids[]" id="category_ids" class="form-control" multiple>
                                {{-- Options dynamically --}}
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12 mt-3">
                            <label class="form-label">Description<span class="text-danger">*</span></label>
                            <textarea class="form-control summernote" id="vacancyDescription" name="description" rows="4"></textarea>
                        </div>

                        <!-- Requirements -->
                        <div class="col-md-12 mt-3">
                            <label class="form-label">Requirements</label>
                            <textarea class="form-control summernote" id="vacancyRequirements" name="requirements" rows="4"></textarea>
                        </div>

                        <!-- Status -->
                        <div class="col-md-12 mt-3">
                            <label class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success submitBtn" data-action="">Submit</button>
                    <button type="submit" class="btn btn-success updateBtn" data-action="edit">Update
                        Vacancy</button>
                </div>
            </form>
        </div>
    </div>
</div>
