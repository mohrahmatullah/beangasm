@extends('frontend::dekstop.includes.default')
@section('title', 'Thank you payment bacs | Beangasm')
@section('content')
<section id="step4" class="dt-ord-s mt-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-8">
        <div class="chk-c py-3 px-3 mb-2 text-center">
          <h1>Terima Kasih</h1>
          <div class="mb-2">Mohon selesaikan pembayaran untuk no pesanan <span class="text-third fw-500">{{ $order_id }}</span></div>
          <div class="mb-2 st4-time">23 : 58 : 40</div>
          <div class="mb-2 text-grey">(Sebelum selasa 15 oktober 2019 pukul 13:17 WIB)</div>
        </div>
        <div class="chk-c py-3 px-3 mb-2 text-center">
          <div class="mb-2 text-grey">Jumlah yang di transfer</div>
          <div class="mb-2 st4-price">Rp 657.000.<span>329</span></div>
          <div class="mb-2">Mohon di transfer hingga 3 digit terakhir</div>
          <button class="btn text-third"><u>Salin Jumlah</u></button>
        </div>
        <div class="chk-c py-3 px-3 mb-2 text-center">
          <div class="mb-2 text-grey">Nomor Rekening</div>
          <div class="mb-2 st4-rek d-flex align-items-center justify-content-center fw-500"><img class="h-auto mr-2" src="{{url('assets/frontend/img/st4-bca.png')}}"/> 992 9390 342</div>
          <div class="mb-2 fw-500">a/n PT Kopikitasemua</div>
          <button class="btn text-third"><u>Salin No.Rek</u></button>
        </div>
        <a href="" class="d-block btn-bean w-100 fw-500 text-white third mb-2 text-center">Lihat Status Pemesanan</a>
        <a href="" class="d-block btn-bean w-100 fw-500 text-third white mb-2 text-center border-2-third">Upload Bukti Pembayaran</a>
        <a href="" class="d-block btn-bean w-100 fw-500 text-third white mb-2 text-center">Kembali ke halaman Home</a>
      </div>
    </div>
  </div>
</section>
@endsection