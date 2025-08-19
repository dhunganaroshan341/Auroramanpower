<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="jobModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formId" class="form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="jobModalTitle">Add Job</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="validationErrors" class="alert alert-danger d-none"></p>
                    <div class="row">
                        <span class="mt-2 mb-4"><span class="text-danger">Note:</span> (<span
                                class="text-danger">*</span>) symbol represent that the field is required</span>

                        @csrf
                        <div class="col-md-6">
                            <label class="form-label">Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Employer</label>
                            <select name="employer_id" id="employer_id" class="form-control">
                                <option value="">-- Select Employer --</option>
                                {{-- Options to be populated dynamically --}}
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" id="location" class="form-control" placeholder="">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="form-label">Salary</label>
                            <input type="text" name="salary" id="salary" class="form-control" placeholder="">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="form-label">Link</label>
                            <input type="url" name="link" id="link" class="form-control" placeholder="">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="form-label">Icon Class</label>
                            <input type="text" name="icon_class" id="icon_class" class="form-control" placeholder="">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="form-label">Country</label>
                            <select name="our_country_id" id="our_country_id" class="form-control">
                                <option value="">-- Select Country --</option>
                                {{-- Options dynamically --}}
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <div id="jobImagePreview" class="mt-2"></div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="form-label">PDF</label>
                            <input type="file" name="pdf" id="pdf" class="form-control">
                            <div id="jobPdfPreview" class="mt-2"></div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label class="form-label">Description<span class="text-danger">*</span></label>
                            <textarea class="form-control summernote" id="jobDescription" name="description" rows="4"></textarea>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label class="form-label">Requirements</label>
                            <textarea class="form-control summernote" id="jobRequirements" name="requirements" rows="4"></textarea>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label class="form-label">Categories</label>
                            <select name="category_ids[]" id="category_ids" class="form-control" multiple>
                                {{-- Options dynamically --}}
                            </select>
                        </div>

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
                    <button type="submit" class="btn btn-success updateBtn" data-action="edit">Update Job</button>
                </div>
            </form>
        </div>
    </div>
</div>
