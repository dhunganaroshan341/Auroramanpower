@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">
        <button class="btn btn-primary addContentBtn mb-4 mt-4">Add Section Content</button>
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
    </div>
@endsection
