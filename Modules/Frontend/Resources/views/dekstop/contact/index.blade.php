@extends('frontend::dekstop.includes.default')
@section('title', 'Beangasm | Contact')
@section('content')
<!-- Main Content -->
<main>

  <section class="py-5 grey">
    <div class="container">
      
      <div class="row align-items-center">
        <div class="col-12 col-lg-5">
          <div class="white p-3 text-center" style="border-radius: 15px;">
            <h4 class="text-grey">Contact Us</h4>
            <p>If you have any questions about our services kindly contact us:</p>
            <form action="">
              <div class="form-group">
                <input type="text" class="form-bean w-100" placeholder="Subject" />
              </div>
              <div class="form-group">
                <input type="email" class="form-bean w-100" placeholder="Email" />
              </div>
              <div class="form-group">
                <input type="text" class="form-bean w-100" placeholder="Phone" />
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="5" class="textarea-bean w-100" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" name="send" value="Send" class="btn-bean w-100 fw-600 text-uppercase">
              </div>
            </form>
          </div>
          
        </div>
        <div class="col-12 col-lg-7">
          <img src="{{url('assets/frontend/img/mail-illustrator.png')}}" class="w-100 h-auto" />
        </div>
      </div>
    </div>
  </section>

</main>
<!-- /Main Content -->
@endsection
