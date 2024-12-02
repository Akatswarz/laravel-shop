@extends('layouts.admin')
@section('content')
<h3>Add Product</h3>

<form method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Method is POST, no need for PUT or PATCH -->
    <div class="form-group">
        <label for="name">Product Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
    </div>

    <div class="form-group">
        <label for="slug">Product Slug</label>
        <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug') }}" required>
    </div>

    <div class="form-group">
        <label for="mota">Description</label>
        <textarea name="mota" class="form-control" id="mota">{{ old('mota') }}</textarea>
    </div>

    <div class="form-group">
        <label for="th">Category</label>
        <input type="text" name="th" class="form-control" id="th" value="{{ old('th') }}" required>
    </div>

    <div class="form-group">
        <label for="idCat">Category ID</label>
        <input type="number" name="idCat" class="form-control" id="idCat" value="{{ old('idCat') }}" required>
    </div>

    <div class="form-group">
        <label for="chitiet">Detail</label>
        <textarea name="chitiet" class="form-control" id="chitiet">{{ old('chitiet') }}</textarea>
    </div>

    <div class="form-group">
        <label for="images">Product Image</label>
        <input type="file" name="images" class="form-control" id="images">
    </div>

    <button type="submit" class="btn btn-primary">Add Product</button>
</form>


@endsection