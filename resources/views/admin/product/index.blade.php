@extends('layouts.admin')
@section('content')
@isset($m)
    @if (!$e)
        <script>
            Swal.fire({
                title: 'Thành công!',
                text: $m,
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @else
        <script>
            Swal.fire({
                title: 'Thất bại!',
                text: $m,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endisset
<table class="table" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th scope="col">Name</th>
            <th scope="col">Slug</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Th</th>
            <th scope="col">ID Cat</th>
            <th scope="col">Chi tiết</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $sp)
            <tr>
                <th scope="row">{{$sp['id']}}</th>
                <td scope="col"><img class="w-75" src="/assets/{{$sp['images']}}" alt="" srcset=""></td>
                <td scope="col">{{$sp['name']}}</td>
                <td scope="col">{{$sp['slug']}}</td>
                <td scope="col">{{$sp['mota']}}</td>
                <td scope="col">{{$sp['th']}}</td>
                <td scope="col">{{$sp['idCat']}}</td>
                <td scope="col">{{$sp['chitiet']}}</td>
                <td scope="col">
                    <a type="button" class="btn btn-primary"
                        href="{{route('admin.product.editForm', ['id' => $sp['id']])}}">Edit</a>
                    <a type="button" class="btn btn-danger"
                        href="{{route('admin.product.remove', ['id' => $sp['id']])}}">Remove</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a type="button" class="btn btn-primary btn-lg" href="{{route('admin.product.addForm')}}">ADD</a>
@endsection