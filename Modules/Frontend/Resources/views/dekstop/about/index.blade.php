@extends('frontend::dekstop.includes.default')
@section('title', 'Beangasm | About')
@section('content')
<!-- Main Content -->
<main>

  <section class="py-5 grey">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-lg-5">
          <div class="white p-3 text-center" style="border-radius: 15px;">
            <h4 class="text-grey mb-4">About Us</h4>
            <p class="mb-3 text-grey fw-400">
              Beangasm adalah sebuah situs online dari PT Gesha Bersama Ultima yang merupakan pasar jual beli online khusus untuk kopi, mulai dari alat-alat, green bean, roasted bean sampai beragam merchandise dari roastery, coffee shop, trader/importer, merk-merk kopi lokal dan internasional sampai dengan petani langsung.
              <br /><br />
              Wilayah transaksi kami khusus di Republik Indonesia, dimanapun dan siapapun dapat menjual dan membeli secara langsung tanpa batas waktu dan jarak. Dengan menjadi pasar online kami berusaha menghilangkan batasan-batasan baik dari penjual maupun pembeli/penikmat kopi di tanah air. BEANGASM bermimpi untuk menjadi wadah yang bisa mempersatukan serta memajukan komunitas dan industri kopi di Indonesia.
            </p>
          </div>
          
        </div>
        <div class="col-12 col-lg-7">
          <img src="{{url('assets/frontend/img/store-illustrator.png')}}" class="w-100 h-auto" />
        </div>
      </div>
    </div>
  </section>

</main>
<!-- /Main Content -->
@endsection
