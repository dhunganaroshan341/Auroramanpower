@extends('Admin.layout.master')

@section('content')
<div class="container mt-5">
    <h2>Custom Website Menu</h2>
    <h4> <i> * currently not in use</i></h4>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Menu Form -->
    <form id="menuForm" method="POST" action="{{ route('admin.menus.store') }}">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="title" class="form-control" placeholder="Title" required>
            </div>
            <div class="col">
                <input type="text" name="link" class="form-control" placeholder="Link" required>
            </div>
            <div class="col">
                <input type="number" name="order" class="form-control" placeholder="Order" value="0">
            </div>
            <div class="col">
                <button class="btn btn-primary">Add Menu</button>
            </div>
        </div>
    </form>

    <!-- Menu List -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Link</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
            <tr>
                <!-- Update Form -->
                <td>
                    <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="title" value="{{ $menu->title }}" class="form-control" required>
                </td>
                <td>
                    <input type="text" name="link" value="{{ $menu->link }}" class="form-control" required>
                </td>
                <td>
                    <input type="number" name="order" value="{{ $menu->order }}" class="form-control">
                </td>
                <td>
                    <button class="btn btn-success btn-sm">Update</button>
                    </form> <!-- Close update form before delete -->

                    <!-- Delete Form -->
                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure to delete this menu?')"
                            class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection