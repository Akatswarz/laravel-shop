@extends('layouts.main')
@section('content')
<section class="h-100 h-custom" style="background-color: #d2c9ff;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-3">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0">Shopping Cart</h1>
                  </div>
                  <hr class="my-4">

                  <!-- //sanpham -->
                  <div id="cartContent" class="row mb-4 d-flex justify-content-between align-items-center">

                  </div>

                  <div class="pt-5">
                    <h6 class="mb-0"><a href="#!" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back
                        to shop</a></h6>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 bg-body-tertiary">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                  <hr class="my-4">

                  <h5 class="text-uppercase mb-3">Give code</h5>

                  <div class="mb-5">
                    <div data-mdb-input-init class="form-outline">
                      <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Examplea2">Enter your code</label>
                    </div>
                  </div>

                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-5">
                    <h5 class="text-uppercase">Total price</h5>
                    <h5 class="tongTien"></h5>
                  </div>

                  <a href="{{route('checkout.sendEmail')}}" data-mdb-button-init data-mdb-ripple-init
                    class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Checkout</a>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if(session('success'))
    <script>
    Swal.fire({
      title: "{{ session('success') }}",
      text: "Cảm ơn bạn đã mua",
      icon: 'success',
      confirmButtonText: 'OK'
    });
    </script>
  @endif
</section>



<script>
  let gioHang = () => {
    fetch('/view-cart')
      .then(res => res.text())
      // .then(data=>console.log(data))
      .then(res => JSON.parse(res))
      .then(data => {
        document.querySelector('#cartContent').innerHTML = data['html'],
          document.querySelector('.tongTien').innerHTML = data['all'] + ' đ',
          tongSp()
      })
      .catch(error => console.error("Lỗi kết nối:", error));
  }

  let capNhatSoLuong = (sl, idpro) => {
    axios.post('update-cart', {
      sl: sl,
      idpro: idpro
    })
      .then(function (response) {
        if (!response.data.err) {
          gioHang();
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: response.data.mess,
            showConfirmButton: false,
            timer: 1500
          });
        } else {
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: response.data.mess,
            showConfirmButton: false,
            timer: 1500
          });
        }
      })
      .catch(function (error) {
        // Xử lý lỗi nếu có
        console.error("Có lỗi xảy ra:", error);
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'error',
          title: 'Lỗi kết nối!',
          showConfirmButton: false,
          timer: 1500
        });
      });
  }

  let xoaSanPham = (idpro) => {
    const button = event.target;
    button.disabled = true;
    axios.post(`/remove-cart`, {
      idpro: idpro
    })
      .then(function (response) {
        // Kiểm tra nếu có lỗi từ server
        if (!response.data.err) {
          gioHang();
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: response.data.mess,
            showConfirmButton: false,
            timer: 1500
          });
        } else {
          // Thông báo thành công
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Xóa thất bại',
            showConfirmButton: false,
            timer: 1500
          });
        }
      })
      .catch(function (error) {
        // Xử lý lỗi nếu có
        console.error("Có lỗi xảy ra:", error);
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'error',
          title: 'Lỗi kết nối!',
          showConfirmButton: false,
          timer: 1500
        });
      });
  }

  gioHang();


</script>
@endsection