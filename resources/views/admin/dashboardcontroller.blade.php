@extends('layouts.admin')
@section('content')
    <!-- nguoi dung -->
    <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative">
                <a href={{route('admin.product')}}><img src="/admin/assets/images/products/s4.jpg" class="card-img-top rounded-0" alt="..."></a>
                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>                      </div>
              <div class="card-body pt-3 p-4">
                <h4 class="fw-semibold fs-4">Product</h4>
              </div>
            </div>
          </div>
          <!-- san pham -->
          
@endsection
