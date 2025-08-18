@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <button class="btn btn-primary addContentBtn mb-4 mt-4">Add Section Content</button>

        <!-- Category Filter -->
        <div class="mb-4 mt-4">
            <select id="categoryFilter" class="form-select">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @include('Admin.pages.SectionContent.sectionContentModal')

    <div class="table-responsive">
        <table class="table table-striped" id="section-content-table">
            <thead>
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
