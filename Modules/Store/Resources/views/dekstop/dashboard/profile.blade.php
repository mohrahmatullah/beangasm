@extends('frontend::dekstop.includes.default')
@section('title', 'Beangasm | My Profile')
@section('content')

<!-- Main -->
<main style="background: #f7f7f7;">
  <div class="container py-3">
		<div class="row">
			<!-- Side Menu Section -->
			<div class="col-12 col-lg-3 pr-lg-0 mb-2">
				<!-- Profile Section -->
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
				<!-- /Profile Section -->

				<!-- Menu User Section -->
				<div class="row mx-0 white" style="border-bottom: 1px solid #f7f7f7;">
					<div class="col-12 px-0">
					<ul class="list-unstyled mb-0">
						<li><a href="{{ route('store-dashboard') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/dashboard.svg')}}" width="20" height="20" /> Halaman Depan</a></li>
						<li><a href="{{ route('store-myorder') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/bag-l.svg')}}" width="20" height="20" /> Order Saya <div class="third d-inline-flex text-white ml-2 mcart-notif py-1 px-2">5</div></a></li>
						<li><a href="{{ route('store-wishlist') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/heart.svg')}}" width="20" height="20" /> Wishlist</a></li>
						<li><a href="{{ route('store-coupon') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/coupon.svg')}}" width="20" height="20" /> Kupon Saya</a></li>
						<li><a href="{{ route('store-profile') }}" class="p-3 d-flex align-items-center dsb-menu-link active"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/user-l.svg')}}" width="20" height="20" /> Profile</a></li>
					</ul>
					</div>
				</div>
				<!-- /Menu User Section -->

				<!-- Menu Store Section -->
				<div class="row mx-0 white mb-2">
					<div class="col-12 px-0">
					<ul class="list-unstyled mb-0">
						<li><a href="{{ route('store-myproduct') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/coffee-l.svg')}}" width="20" height="20" /> Produk Saya</a></li>
						<li><a href="{{ route('store-orders') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/shop.svg')}}" width="20" height="20" /> Penjualan <div class="third d-inline-flex text-white ml-2 mcart-notif py-1 px-2">5</div></a></li>
						<li><a href="{{ route('store-withdraw') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/money.svg')}}" width="20" height="20" /> Withdraw</a></li>
						<li><a href="{{ route('store-reviews') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/doc.svg')}}" width="20" height="20" /> Vendor Review</a></li>
						<li><a href="{{ route('store-notification') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/mail.svg')}}" width="20" height="20" /> Kotak Masuk <div class="third d-inline-flex text-white ml-2 mcart-notif py-1 px-2">5</div></a></li>
					</ul>
					</div>
				</div>
				<!-- Menu Store Section -->

				<!-- Button Sign Up Vendor -->
				<a href="/" class="btn-bean mb-2 w-100 fw-500 text-white d-inline-block text-center" >
					Change to user
				</a>
				<!-- /Button Sign Up Vendor -->

				<!-- Button Logout -->
				<form method="post" action="" enctype="multipart/form-data">
					<input type="hidden" name="_token" id="_token" value="">  
					<button type="submit" class="btn-bean mb-2 w-100 fw-500 text-primary white">Logout</button>
				</form>
				<!-- /Button Logout -->

			</div>
			<!-- /Side Menu Section -->

			<!-- Content Section -->
			<div class="col-12 col-lg-9 mb-2">

				<!-- Navs -->
				<ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
					<li class="nav-item" role="presentation">
						<a class="nav-link fs-08 active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">Profile User</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link fs-08" id="pills-address-tab" data-toggle="pill" href="#pills-address" role="tab" aria-controls="pills-address" aria-selected="false">Alamat User</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link fs-08" id="pills-store-tab" data-toggle="pill" href="#pills-store" role="tab" aria-controls="pills-store" aria-selected="false">Profil Store</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link fs-08" id="pills-social-tab" data-toggle="pill" href="#pills-social" role="tab" aria-controls="pills-social" aria-selected="false">Social Media</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link fs-08" id="pills-bank-tab" data-toggle="pill" href="#pills-bank" role="tab" aria-controls="pills-bank" aria-selected="false">Bank Transfer</a>
					</li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
						<div class="row mx-0 p-3 white">
							<div class="col-12">
								<div class="row mb-3">
									<div class="col-12">
										<h6 style="padding-bottom: .75rem;border-bottom: 1px solid #f7f7f7;">Update Profile</h6>
									</div>
								</div>

								<!-- Form Update Profile -->
								<section class="row">
									<div class="col-12 col-xl-3">

										<div class="mb-1">
											<img class="of-cover" src="{{url('assets/frontend/img/1.png')}}" width="150px" height="150px" />
										</div>
										<div>
											<form>
												<div class="upload-btn-wrapper">
													<button class="btn-bean fw-500 text-white third text-center fs-07 py-2">Browse</button>
													<input type="file" name="myfile" />
												</div>
											</form>
										</div>
										<div>
											<ul class="pl-3">
												<li class="text-grey fs-06">Maksimal 10MP</li>
												<li class="text-grey fs-06">File yang diperbolehkan <br /> .JPG .JPEG .PNG</li>
											</ul>
										</div>

									</div>
									<div class="col-12 col-xl-9">
										<form action="">
											<div class="form-group mb-1">
												<label for="displayname" class="text-grey fs-07 mb-1">Display Name</label>
												<input type="text" class="form-control fs-08" id="displayname" aria-describedby="emailHelp">
											</div>
											<div class="form-group mb-1">
												<label for="username" class="text-grey fs-07 mb-1">Username</label>
												<input type="text" class="form-control fs-08" id="username" aria-describedby="emailHelp">
											</div>
											<div class="form-group mb-1">
												<label for="email" class="text-grey fs-07 mb-1">Email</label>
												<input type="email" class="form-control fs-08" id="email" aria-describedby="emailHelp">
											</div>
											<div class="form-group mb-1">
												<label for="password" class="text-grey fs-07 mb-1">New Password</label>
												<input type="password" class="form-control fs-08" id="password">
											</div>
											<button type="submit" class="btn-bean fw-500 text-white third text-center fs-07 py-2 mt-2">Simpan Perubahan</button>
										</form>
									</div>
									
								</section>
								<!-- /Form Update Profile -->

							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-address" role="tabpanel" aria-labelledby="pills-address-tab">
						<div class="row mx-0 p-3 white">
							<div class="col-12">
								<div class="row mb-3">
									<div class="col-12">
										<h6 class="dsb-title-content d-inline-block" style="padding-bottom: .75rem;border-bottom: 1px solid #f7f7f7;">Alamat</h6>
										<a class="btn-bean fw-500 text-white text-center fs-06 py-1 px-2 d-inline-block float-right" data-toggle="collapse" href="#collapseAddAddress" role="button" aria-expanded="false" aria-controls="collapseAddAddress">Tambah alamat baru</a>
									</div>
								</div>

								<!-- Daftar Alamat -->
								<section class="row">
									<div class="col-12">

										<!-- Collapse form tambah alamat -->
										<div class="collapse mb-2" id="collapseAddAddress">
											<div class="card card-body chk-c">
												<form action="">
													<div class="form-group mb-1">
														<label for="namaalamat" class="text-grey fs-07 mb-1">Nama Alamat (contoh: Kantor, Rumah, Cafe, dll)</label>
														<input type="text" class="form-control fs-1" id="namaalamat" aria-describedby="emailHelp">
													</div>
													<div class="form-group mb-1">
														<label for="namapenerima" class="text-grey fs-07 mb-1">Nama Penerima</label>
														<input type="text" class="form-control fs-1" id="namapenerima" aria-describedby="emailHelp">
													</div>
													<div class="form-group mb-1">
														<label for="telepon" class="text-grey fs-07 mb-1">Telepon</label>
														<input type="text" class="form-control fs-1" id="telepon" aria-describedby="emailHelp">
													</div>
													<div class="form-group mb-1">
														<label for="email" class="text-grey fs-07 mb-1">Email</label>
														<input type="email" class="form-control fs-1" id="email" aria-describedby="emailHelp">
													</div>
													<div class="form-group mb-1">
														<label for="negara" class="text-grey fs-07 mb-1">Negara</label>
														<select class="wide sort-by-acidity-min mb-1" name="negara">
															<option data-display="Negara" value="0">Negara</option>
															<option value="1">Indonesia</option>
															<option value="2">Malaysia</option>
															<option value="3">Singapore</option>
															<option value="4">Australia</option>
														</select>
													</div>
													<div class="form-group mb-1">
														<label for="provinsi" class="text-grey fs-07 mb-1">Provinsi</label>
														<select class="wide sort-by-acidity-min mb-1" name="provinsi">
															<option data-display="Provinsi" value="0">Provinsi</option>
															<option value="1">Banten</option>
															<option value="2">DKI Jakarta</option>
															<option value="3">Jawa Barat</option>
															<option value="4">Jawa Tengah</option>
														</select>
													</div>
													<div class="form-group mb-1">
														<label for="kota" class="text-grey fs-07 mb-1">Kabupaten/Kota</label>
														<select class="wide sort-by-acidity-min mb-1" name="provinsi">
															<option data-display="Kabupaten/Kota" value="0">Kabupaten/Kota</option>
															<option value="1">Kota Tangerang</option>
															<option value="2">Kota Bogor</option>
															<option value="3">Kota Bandung</option>
															<option value="4">Kota Surabaya</option>
														</select>
													</div>
													<div class="form-group mb-1">
														<label for="kecamatan" class="text-grey fs-07 mb-1">Kecamatan</label>
														<select class="wide sort-by-acidity-min mb-1" name="kecamatan">
															<option data-display="Kecamatan" value="0">Kecamatan</option>
															<option value="1">Neglasari</option>
															<option value="2">Pagedangan</option>
															<option value="3">Slipi</option>
															<option value="4">Kuningan</option>
														</select>
													</div>
													<div class="form-group mb-1">
														<label for="kelurahan" class="text-grey fs-07 mb-1">Kelurahan</label>
														<select class="wide sort-by-acidity-min mb-1" name="kelurahan">
															<option data-display="Kelurahan" value="0">Kelurahan</option>
															<option value="1">Neglasari</option>
															<option value="2">Pagedangan</option>
															<option value="3">Slipi</option>
															<option value="4">Kuningan</option>
														</select>
													</div>
													<div class="form-group mb-1">
														<label for="alamatlengkap" class="text-grey fs-07 mb-1">Alamat Lengkap</label>
														<textarea class="form-control fs-1" id="alamatlengkap" rows="3"></textarea>
													</div>
													<div class="form-group mb-1">
														<label for="kodepos" class="text-grey fs-07 mb-1">Kode Pos</label>
														<input type="text" class="form-control fs-1" id="kodepos" aria-describedby="emailHelp">
													</div>
													<button type="submit" class="btn-bean fw-500 text-white third text-center fs-07 py-2 mt-2">Simpan Perubahan</button>
												</form>
											</div>
										</div>
										<!-- /Collapse form tambah alamat -->

										<div class="chk-c py-2 px-3 mb-2">
											<div>
												<input id="address_akun_0" type="radio" name="address" class="mr-2 position-absolute chk-ck" /><label for="address_akun_0" class="d-inline-block ml-4 fw-500 mb-0">Alamat Rumah</label>
											</div>
											<div class="pl-4">
												<p>
													Jl. Iskandar Muda, RT002/003 no. 40, Kedaung Baru, Neglasari, Tangerang, Banten, 15128, Indonesia
												</p>
												<p>
													Penerima : Rifki <br />
													Phone : 0213-456-789 <br />
													Email : myemail@mail.com
												</p>
												<a href="" class="text-primary">Edit alamat</a>
											</div>
										</div>

										<div class="chk-c py-2 px-3 mb-2">
											<div>
												<input id="address_akun_0" type="radio" name="address" class="mr-2 position-absolute chk-ck" /><label for="address_akun_0" class="d-inline-block ml-4 fw-500 mb-0">Alamat Kantor</label>
											</div>
											<div class="pl-4">
												<p>
													Jl. Iskandar Muda, RT002/003 no. 40, Kedaung Baru, Neglasari, Tangerang, Banten, 15128, Indonesia
												</p>
												<p>
													Penerima : Rifki <br />
													Phone : 0213-456-789 <br />
													Email : myemail@mail.com
												</p>
												<a href="" class="text-primary">Edit alamat</a>
											</div>
										</div>

									</div>
									
								</section>
								<!-- /Daftar Alamat -->

							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-store" role="tabpanel" aria-labelledby="pills-store-tab">
						<div class="row mx-0 p-3 white">
							<div class="col-12">
								<div class="row mb-3">
									<div class="col-12">
										<h6 style="padding-bottom: .75rem;border-bottom: 1px solid #f7f7f7;">Update Profile Store</h6>
									</div>
								</div>

								<!-- Form Update Profile -->
								<form action="">
									<section class="row pb-3 mb-2" style="border-bottom: 1px solid #f7f7f7;">
										<div class="col-12">

											<div class="mb-1">
												<img class="of-cover" src="{{url('assets/frontend/img/1.png')}}" width="100%" height="385px" />
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
										<div class="col-12">
											
											<div class="form-group mb-1">
												<label for="addCategories" class="text-grey fs-07 mb-1">Add Categories</label>
												<input type="text" class="form-control fs-08" id="addCategories" aria-describedby="emailHelp">
											</div>
											<div class="form-group mb-1">
												<label for="storeDescription" class="text-grey fs-07 mb-1">Desription</label>
												<textarea class="form-control fs-1" id="storeDescription" rows="3"></textarea>
											</div>

										</div>
										
									</section>

									<section class="row">
										<div class="col-12">
											<div class="form-group mb-1">
												<label for="mapApi" class="text-grey fs-07 mb-1">Google Map API Key</label>
												<input type="text" class="form-control fs-08" id="mapApi" aria-describedby="emailHelp">
											</div>
											<div class="form-group mb-1">
												<label for="mapLatitude" class="text-grey fs-07 mb-1">Latitude Value</label>
												<input type="text" class="form-control fs-08" id="mapLatitude" aria-describedby="emailHelp">
											</div>
											<div class="form-group mb-1">
												<label for="mapLongitude" class="text-grey fs-07 mb-1">Longitude Value</label>
												<input type="text" class="form-control fs-08" id="mapLongitude" aria-describedby="emailHelp">
											</div>
										</div>
									</section>

									<button type="submit" class="btn-bean fw-500 text-white third text-center fs-07 py-2 mt-2">Simpan Perubahan</button>

								</form>
								
								<!-- /Form Update Profile -->

							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-social" role="tabpanel" aria-labelledby="pills-social-tab">
						<div class="row mx-0 p-3 white">
							<div class="col-12">
								<div class="row mb-3">
									<div class="col-12">
										<h6 style="padding-bottom: .75rem;border-bottom: 1px solid #f7f7f7;">Social Media</h6>
									</div>
								</div>

								<!-- Form Update Social Media -->
								<section class="row">
									
									<div class="col-12">
										<form action="">
											<div class="form-group mb-1">
												<label for="facebook" class="text-grey fs-07 mb-1">Facebook</label>
												<input type="text" class="form-control fs-08" id="facebook" placeholder="ex: www.facebook.com/me"> 
											</div>
											<div class="form-group mb-1">
												<label for="twitter" class="text-grey fs-07 mb-1">Twitter</label>
												<input type="text" class="form-control fs-08" id="twitter" placeholder="ex: www.twitter.com/me">
											</div>
											<div class="form-group mb-1">
												<label for="linkedin" class="text-grey fs-07 mb-1">Linkedin</label>
												<input type="text" class="form-control fs-08" id="linkedin" placeholder="ex: www.linkedin.com/in/me">
											</div>
											<div class="form-group mb-1">
												<label for="dribbble" class="text-grey fs-07 mb-1">Dribbble</label>
												<input type="text" class="form-control fs-08" id="dribbble" placeholder="ex: www.dribbble.com/me">
											</div>
											<div class="form-group mb-1">
												<label for="instagram" class="text-grey fs-07 mb-1">Instagram</label>
												<input type="text" class="form-control fs-08" id="instagram" placeholder="ex: www.instagram.com/me">
											</div>
											<div class="form-group mb-1">
												<label for="youtube" class="text-grey fs-07 mb-1">Youtube</label>
												<input type="text" class="form-control fs-08" id="youtube" placeholder="ex: www.youtube.com/channel/me">
											</div>
											<button type="submit" class="btn-bean fw-500 text-white third text-center fs-07 py-2 mt-2">Simpan Perubahan</button>
										</form>
									</div>
									
								</section>
								<!-- /Form Update Social Media -->

							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="pills-bank" role="tabpanel" aria-labelledby="pills-bank-tab">
						<div class="row mx-0 p-3 white">
							<div class="col-12">
								<div class="row mb-3">
									<div class="col-12">
										<h6 style="padding-bottom: .75rem;border-bottom: 1px solid #f7f7f7;">Direct Bank Transfer</h6>
									</div>
								</div>

								<!-- Form Update Bank -->
								<section class="row">
									
									<div class="col-12">
										<form action="">
											<div class="form-group mb-1">
												<div for="enableBankTransfer" class="text-grey fs-07 mb-1">Bank Transfer</div>
												<div class="d-flex align-items-center">
													<div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" id="enableBankTransfer">
														<label class="custom-control-label" for="enableBankTransfer">Enable Bank Transfer</label>
													</div>
												</div>
											</div>
											<div class="form-group mb-1">
												<label for="accountBankName" class="text-grey fs-07 mb-1">Account Name</label>
												<input type="text" class="form-control fs-08" id="accountBankName"> 
											</div>
											<div class="form-group mb-1">
												<label for="accountBankNumber" class="text-grey fs-07 mb-1">Account Number</label>
												<input type="text" class="form-control fs-08" id="accountBankNumber"> 
											</div>
											<div class="form-group mb-1">
												<label for="bankName" class="text-grey fs-07 mb-1">Bank Name</label>
												<input type="text" class="form-control fs-08" id="bankName"> 
											</div>
											<button type="submit" class="btn-bean fw-500 text-white third text-center fs-07 py-2 mt-2">Simpan Perubahan</button>
										</form>
									</div>
									
								</section>
								<!-- /Form Update Social Media -->

							</div>
						</div>
					</div>
				</div>
				<!-- /Navs -->

			
			</div>
			<!-- /Content Section -->
		</div>
  </div>
</main>
<!-- /Main -->

@endsection