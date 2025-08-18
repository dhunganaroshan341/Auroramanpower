<div class="modal fade" id="sectionContentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="sectionContentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="sectionContentForm" class="sectionContentForm">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="sectionContentModalLabel">Add Section Content</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="validationErrors" class="alert alert-danger d-none"></p>
                    <div class="row">
                        <span class="mt-2 mb-4"><span class="text-danger">Note:</span> (<span
                                class="text-danger">*</span>) symbol represent that the field is required</span>
                        <div class="col-md-6">
                            @csrf
                            <label class="form-label">Category<span class="text-danger">*</span></label>
                            <select name="section_category_id" id="section_category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach ($categories ?? [] as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Short Description</label>
                            <input type="text" name="short_description" id="short_description"
                                class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Image</label>
                            <input type="text" name="image" id="image" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Video</label>
                            <input type="text" name="video" id="video" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">PDF</label>
                            <input type="text" name="pdf" id="pdf" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Icon Class</label>
                            <input type="text" name="icon_class" id="icon_class" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Link Title</label>
                            <input type="text" name="link_title" id="link_title" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Link URL</label>
                            <input type="text" name="link_url" id="link_url" class="form-control" />
                        </div>
                        <div class="col-md-12 mt-4 mb-2">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="col-md-12 mt-2 mb-2">
                            <label class="form-label">Description 2</label>
                            <textarea class="form-control" id="description2" name="description2" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success submitBtn" data-action="">Submit</button>
                    <button type="submit" class="btn btn-success updateBtn" data-action="edit">Update Section
                        Content</button>
                </div>
            </form>
        </div>
    </div>
</div>
