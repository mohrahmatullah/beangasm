@extends('frontend::dekstop.includes.default')
@section('title', 'Beangasm | My Product')
@section('content')

<!-- Main -->
<main style="background: #f7f7f7;">
  <div class="container py-3">
		<div class="row">
			<!-- Side Menu Section -->
			<div class="col-12 col-lg-3 pr-lg-0 mb-2">
				<!-- Profile Menu Section -->
				<div class="row mx-0 py-3 px-1 white" style="border-bottom: 1px solid #f7f7f7;">
					<div class="col-12">
						<div class="d-flex align-items-center">
							<div class="primary img-circle mr-3 d-inline-block" style="width: 65px;height: 65px;">
								<img class="of-cover w-100 h-100 img-circle" src="{{url('assets/frontend/img/1.png')}}" />
							</div>
							<div class="d-inline-block">
								<h6 class="mb-0 text-grey">Abdul Jaelani</h6>
								<p class="mb-0 text-grey" style="font-size: .8rem;">Jakarta, Indonesia</p>
							</div>
						</div>
					</div>
					<!-- <div class="col-12 text-right">
						<a href="" class="d-inline-flex align-items-center text-grey" style="font-size: .8rem;"><img class="of-cover mr-1" src="{{url('assets/frontend/img/edit.png')}}" width="15" height="15" />Edit Profile</a>
					</div> -->
				</div>
				<!-- /Profile Menu Section -->

				<!-- Menu User Section -->
				<div class="row mx-0 white" style="border-bottom: 1px solid #f7f7f7;">
					<div class="col-12 px-0">
            <ul class="list-unstyled mb-0">
              <li><a href="{{ route('store-dashboard') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/dashboard.svg')}}" width="20" height="20" /> Halaman Depan</a></li>
              <li><a href="{{ route('store-myorder') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/bag-l.svg')}}" width="20" height="20" /> Order Saya <div class="third d-inline-flex text-white ml-2 mcart-notif py-1 px-2">5</div></a></li>
              <li><a href="{{ route('store-wishlist') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/heart.svg')}}" width="20" height="20" /> Wishlist</a></li>
              <li><a href="{{ route('store-coupon') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/coupon.svg')}}" width="20" height="20" /> Kupon Saya</a></li>
              <li><a href="{{ route('store-profile') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/user-l.svg')}}" width="20" height="20" /> Profile</a></li>
            </ul>
					</div>
				</div>
				<!-- /Menu User Section -->

				<!-- Menu Store Section -->
				<div class="row mx-0 white mb-2">
					<div class="col-12 px-0">
            <ul class="list-unstyled mb-0">
              <li><a href="{{ route('store-myproduct') }}" class="p-3 d-flex align-items-center dsb-menu-link active"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/coffee-l.svg')}}" width="20" height="20" /> Produk Saya</a></li>
              <li><a href="{{ route('store-orders') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/shop.svg')}}" width="20" height="20" /> Penjualan <div class="third d-inline-flex text-white ml-2 mcart-notif py-1 px-2">5</div></a></li>
              <li><a href="{{ route('store-withdraw') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/money.svg')}}" width="20" height="20" /> Withdraw</a></li>
              <li><a href="{{ route('store-reviews') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/doc.svg')}}" width="20" height="20" /> Vendor Review</a></li>
              <li><a href="{{ route('store-notification') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/mail.svg')}}" width="20" height="20" /> Kotak Masuk <div class="third d-inline-flex text-white ml-2 mcart-notif py-1 px-2">5</div></a></li>
            </ul>
					</div>
				</div>
				<!-- Menu Store Section -->

				<!-- Button Logout -->
				<form method="post" action="" enctype="multipart/form-data">
					<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">  
					<button type="submit" class="btn-bean mb-2 w-100 fw-500 text-primary white">Logout</button>
				</form>
				<!-- /Button Logout -->

			</div>
			<!-- /Side Menu Section -->

			<!-- Content Section -->
			<div class="col-12 col-lg-9 mb-2">
				<div class="row mx-0 p-3 white">
					<div class="col-12">
						<div class="row mb-3">
							<div class="col-12">
                <h6 class="dsb-title-content d-inline-block" style="padding-bottom: .75rem;border-bottom: 1px solid #f7f7f7;">Produk Saya</h6>
                <a class="btn-bean fw-500 text-white text-center fs-06 py-1 px-2 d-inline-block float-right" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Tambah produk baru</a>
							</div>
            </div>
            
            <!-- Collapse form tambah produk -->
            <div class="collapse mb-2" id="collapseExample">
              <div class="card card-body chk-c">
                <form action="">
                  <div class="form-group mb-1">
                    <label for="namaproduk" class="text-grey fs-07 mb-1">Nama Produk</label>
                    <input type="text" class="form-control fs-1" id="namaproduk" aria-describedby="emailHelp">
                  </div>
                  <div class="form-group mb-1">
                    <label for="deskripsiproduk" class="text-grey fs-07 mb-1">Deskripsi Produk</label>
                    <textarea class="form-control fs-1" id="deskripsiproduk" rows="3"></textarea>
                  </div>
                  <div class="form-group mb-1 mt-2">
                    <div class="row mb-3" style="border-bottom: 1px solid #f7f7f7;">
                      <div class="col-12 col-lg-4">
                        <div class="mb-1">
                          <label for="productimage" class="text-grey fs-07 mb-0">Image Produk</label>
                        </div>
                        <div class="mb-1">
                          <img class="of-cover" src="{{url('assets/frontend/img/1.png')}}" width="150px" height="150px" />
                        </div>
                        <div>
                          <div class="upload-btn-wrapper">
                            <button class="btn-bean fw-500 text-white third text-center fs-07 py-2">Browse</button>
                            <input type="file" name="myfile" />
                          </div>
                        </div>
                        <div>
                          <ul class="pl-3">
                            <li class="text-grey fs-06">Maksimal 10MP</li>
                            <li class="text-grey fs-06">File yang diperbolehkan <br /> .JPG .JPEG .PNG</li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-12 col-lg-4">
                        <div class="mb-1">
                          <label for="productimage" class="text-grey fs-07 mb-0">Image Gallery</label>
                        </div>
                        <div class="mb-1">
                          <img class="of-cover" src="{{url('assets/frontend/img/1.png')}}" width="150px" height="150px" />
                        </div>
                        <div>
                          <div class="upload-btn-wrapper">
                            <button class="btn-bean fw-500 text-white third text-center fs-07 py-2">Browse</button>
                            <input type="file" name="myfile" />
                          </div>
                        </div>
                        <div>
                          <ul class="pl-3">
                            <li class="text-grey fs-06">Maksimal 10MP</li>
                            <li class="text-grey fs-06">File yang diperbolehkan <br /> .JPG .JPEG .PNG</li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-12 col-lg-4">
                        <div class="mb-1">
                          <label for="productimage" class="text-grey fs-07 mb-0">Shop Banner</label>
                        </div>
                        <div class="mb-1">
                          <img class="of-cover" src="{{url('assets/frontend/img/1.png')}}" width="150px" height="150px" />
                        </div>
                        <div>
                          <div class="upload-btn-wrapper">
                            <button class="btn-bean fw-500 text-white third text-center fs-07 py-2">Browse</button>
                            <input type="file" name="myfile" />
                          </div>
                        </div>
                        <div>
                          <ul class="pl-3">
                            <li class="text-grey fs-06">Maksimal 10MP</li>
                            <li class="text-grey fs-06">File yang diperbolehkan <br /> .JPG .JPEG .PNG</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-1">
                    <div class="row pb-2" style="border-bottom: 1px solid #f7f7f7;">
                      <div class="col-12">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                            <a class="nav-link fs-08 active" id="pills-produk-general-tab" data-toggle="pill" href="#pills-produk-general" role="tab" aria-controls="pills-produk-general" aria-selected="true">General</a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a class="nav-link fs-08" id="pills-produk-stock-tab" data-toggle="pill" href="#pills-produk-stock" role="tab" aria-controls="pills-produk-stock" aria-selected="false">Stock</a>
                          </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="pills-produk-general" role="tabpanel" aria-labelledby="pills-produk-general-tab">
                            <div class="form-group mb-1">
                              <label for="hargaproduk" class="text-grey fs-07 mb-1">Harga (Rp)</label>
                              <input type="text" class="form-control fs-1" id="hargaproduk" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group mb-1">
                              <label for="weightproduk" class="text-grey fs-07 mb-1">Weight (grams)</label>
                              <input type="text" class="form-control fs-1" id="weightproduk" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group mb-1">
                              <label for="acidity" class="text-grey fs-07 mb-1">Acidity</label>
                              <select class="wide sort-by-acidity-min mb-1" name="acidity">
                                <option data-display="Acidity" value="0">Acidity</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                              </select>
                            </div>
                            <div class="form-group mb-1">
                              <label for="sweetness" class="text-grey fs-07 mb-1">Sweetness</label>
                              <select class="wide sort-by-acidity-min mb-1" name="sweetness">
                                <option data-display="Sweetness" value="0">Sweetness</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                              </select>
                            </div>
                            <div class="form-group mb-1">
                              <label for="body" class="text-grey fs-07 mb-1">Body</label>
                              <select class="wide sort-by-acidity-min mb-1" name="body">
                                <option data-display="Body" value="0">Body</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                              </select>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="pills-produk-stock" role="tabpanel" aria-labelledby="pills-produk-stock-tab">
                            <div class="form-group mb-1">
                              <div for="managestock" class="text-grey fs-07 mb-1">Manage Stock</div>
                              <div class="d-flex align-items-center">
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" id="managestock">
                                  <label class="custom-control-label" for="managestock">Show inventory item</label>
                                </div>
                              </div>
                            </div>
                            <div class="form-group mb-1">
                              <label for="stockavailability" class="text-grey fs-07 mb-1">Stock Availability</label>
                              <select class="wide sort-by-acidity-min mb-1" name="stockavailability">
                                <option data-display="Stock Availability" value="0">Stock Availability</option>
                                <option value="1">In Stock</option>
                                <option value="2">Out of Stock</option>
                              </select>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-1">
                    <div class="row pb-2">
                      <div class="col-12 col-xl-6">
                        <label for="productcategory" class="text-grey fs-07 mb-1">Kategori Produk</label>
                        <select class="wide sort-by-acidity-min mb-1" name="productcategory">
                          <option data-display="Kategori Produk" value="0">Kategori Produk</option>
                          <option value="1">Green Beans</option>
                          <option value="2">Roasted Beans</option>
                          <option value="3">Coffee Tools</option>
                          <option value="4">Merchandise</option>
                        </select>
                      </div>
                      <div class="col-12 col-xl-6">
                        <label for="producttag" class="text-grey fs-07 mb-1">Tag Produk / <a data-toggle="collapse" href="#collapseAddTag" role="button" aria-expanded="false" aria-controls="collapseAddTag">Buat tag baru</a></label>
                        <input type="text" class="form-control fs-1" id="producttag" aria-describedby="emailHelp">
                      </div>
                    </div>
                    <div class="collapse mb-2" id="collapseAddTag">
                      <div class="card card-body chk-c">
                        <div class="row pb-2">
                          <div class="col-12 col-xl-6">
                            <label for="nametag" class="text-grey fs-07 mb-1">Nama Tag</label>
                            <input type="text" class="form-control fs-1" id="nametag" aria-describedby="emailHelp">
                          </div>
                          <div class="col-12 col-xl-6">
                            <label for="tagstatus" class="text-grey fs-07 mb-1">Status Tag</label>
                            <select class="wide sort-by-acidity-min mb-1" name="tagstatus">
                              <option data-display="Status Tag" value="0">Status Tag</option>
                              <option value="1">Enable</option>
                              <option value="2">Disable</option>
                            </select>
                          </div>
                          <div class="col-12 col-xl-6">
                            <label for="deskripsitag" class="text-grey fs-07 mb-1">Deskripsi Tag</label>
                            <textarea class="form-control fs-1" id="deskripsitag" rows="3"></textarea>
                          </div>
                          <div class="col-12 col-xl-6 d-inline-flex align-items-center justify-content-center">
                            <button type="submit" class="btn-bean fw-500 text-white third text-center fs-07 py-2 mt-2 d-inline-block">Simpan tag baru</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>

                  <button type="submit" class="btn-bean fw-500 text-white third text-center fs-07 py-2 mt-2">Simpan</button>
                </form>
              </div>
            </div>
            <!-- /Collapse form tambah produk -->

						<!-- Wishlist Table -->
						<section class="row">
							<div class="col-12">
								<div class="table-responsive">
									<table class="table" id="example">
										<thead class="thead-light">
											<tr>
												<th scope="col">No</th>
												<th scope="col">Produk Image</th>
												<th scope="col">Nama Produk</th>
												<th scope="col">SKU</th>
												<th scope="col">Harga</th>
												<th scope="col">Status</th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th scope="row">01</th>
												<td><img class="of-cover" src="{{url('assets/frontend/img/1.png')}}" width="50px" height="50px" /></td>
												<td>Panama, Geisha Lily</td>
												<td>B216321109</td>
												<td>Rp. 50.000.000</td>
												<td>Tersedia</td>
												<td>
													<a href="/" class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">Edit</a>
													<a href="/" class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">Hapus</a>
												</td>
											</tr>
											
											<tr>
												<th scope="row">02</th>
												<td><img class="of-cover" src="{{url('assets/frontend/img/1.png')}}" width="50px" height="50px" /></td>
												<td>Panama, Deborah Limitless</td>
												<td>B216321109</td>
												<td>Rp. 50.000.000</td>
												<td>Tersedia</td>
												<td>
													<a href="/" class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">Edit</a>
													<a href="/" class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">Hapus</a>
												</td>
											</tr>
											
											<tr>
												<th scope="row">03</th>
												<td><img class="of-cover" src="{{url('assets/frontend/img/1.png')}}" width="50px" height="50px" /></td>
												<td>Panama, Deborah Illumination</td>
												<td>B216321109</td>
												<td>Rp. 50.000.000</td>
												<td>Tersedia</td>
												<td>
													<a href="/" class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">Edit</a>
													<a href="/" class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">Hapus</a>
												</td>
											</tr>
											
											
										</tbody>
									</table>
								</div>
							</div>							
						</section>
						<!-- /Wishlist Table -->

					</div>
				</div>
			</div>
			<!-- /Content Section -->

		</div>
  </div>
</main>
<!-- /Main -->

@endsection