@extends('layouts.admin')
@section('content')
<div class="container">
    <h1>Edit Product</h1>

    <form action="{{route('admin.product.edit',['id'=>$product->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $product->name) }}"
                required>
        </div>

        <div class="form-group">
            <label for="slug">Product Slug</label>
            <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug', $product->slug) }}"
                required>
        </div>

        <div class="form-group">
            <label for="mota">Description</label>
            <textarea name="mota" class="form-control" id="mota">{{ old('mota', $product->mota) }}</textarea>
        </div>

        <div class="form-group">
            <label for="th">Category</label>
            <input type="text" name="th" class="form-control" id="th" value="{{ old('th', $product->th) }}" required>
        </div>

        <div class="form-group">
            <label for="idCat">Category ID</label>
            <input type="number" name="idCat" class="form-control" id="idCat"
                value="{{ old('idCat', $product->idCat) }}" required>
        </div>

        <div class="form-group">
            <label for="images">Product Image</label>
            <input type="file" name="images" class="form-control" id="images" oncanplaythrough="previewImage()">
            @if($product->images)
                <img id="current-image" src="/assets/{{$product->images}}" alt="Product Image"
                    style="max-width: 200px; margin-top: 10px;">
            @else
                <img id="current-image" src="#" alt="Product Image Preview"
                    style="max-width: 200px; margin-top: 10px; display: none;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('current-image');
            output.style.display = 'block';
            output.src = reader.result; 
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection