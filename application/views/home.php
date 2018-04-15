
		<div class="row">
		<!-- IMAGE HEADLINE OPEN -->
		<div id="wrap-image-heading" class="">
		<img src="<?php echo base_url() ?>assets/img/web header-02.jpg">
			<div id="product-front-order" class="foo">
				<h1 style="color: #ee272a">Gonam Aqiqah</h1>	
				<h4>Simple, Amanah & Enak</h4>
				<a href="<?php echo base_url()."product/" ?>" class="btn-front-order">
					<div>PESAN SEKARANG  
					<span class="glyphicon glyphicon-triangle-right"></span>
					</div>
				</a>
				<h3>FREE DELIVERY</h3>
			</div>
		</div>
		</div>
		
		<div class="row">
			<div class="batas">
			<h2>Mudahnya Aqiqah Di <b>Gonamaqiqah.com</b></h2>
			<a class="hover-none" href="<?php echo base_url()."product" ?>">
				<button class="btn-order psn-skrg" style="margin: auto; z-index: 1; position: relative;">Pesan Sekarang</button>
			</a>
			</div>
		</div>
		<!-- IMAGE HEADLINE CLOSE -->


		<div class="row">
		<!-- CARA PEMESANAN OPEN -->
		<div class="block-white">
				<div class="container wrap-content">
					<div class="wrap-sub-head">
					</div>

					<div class="col-md-6 foo">
						<img class="img-responsive" style="width: 90%; margin: auto;" src="<?php echo base_url()."assets/img/siapaka kami.png" ?>">
					</div>
					<div class="col-md-6 foo">
						<div class="p-tentang">
							<h3>Tentang Kami</h3>
							<p>
								Gonam Aqiqah berdiri sejak 2010, Sebagai sebuah usaha yang bergerak di bidang jasa olahan daging kambing/domba seperti Aqiqah, Qurban, Kambing Guling, Nasi Kebuli dll. Fokus kami adalah memberikan pelayanan yang terbaik untuk para pelanggan.
								Untuk saat ini pelayanan aqiqah kami telah tersebar di beberapa kota besar seperti Jakarta, Bogor, Depok, Tangerang dan Bekasi,
								Amanah adalah kunci kami dalam melaksanakan setiap tugas yang dikerjakan, dan hasil akhir yang memuaskan menjadi prioritas utama kami.

								Syar’ie dalam pelaksanaan Aqiqah mulai dari Proses pemotongan, pembersihan Karkas, Pengolahan menjadi masakan hingga pengantaran ke pemesan.

							</p>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- CARA PEMESANAN OPEN -->



		<!-- WHY CONTENT OPEN -->

		<div class="row">
			<div class="batas foo"><h2>Kenapa Memilih <b>Gonam Aqiqah</b></h2></div>
		</div>

		<div class="row">

		<div class="container foo">
		<div class="block-white" style="border-radius: 10px;">

			<div class="col-md-2">
				<div class="triangle-block">
					<div class="triangle-block-top">
						<img src="<?php echo base_url() ?>assets/img/why5.png">
					</div>
					<div class="round-block-content">
						<h4><b>Amanah</b></h4>
						<p>Hewan yang disediakan sehat dan berkualitas
						</p>
					</div>
				</div>
			</div>



			<div class="col-md-2 foo">
				<div class="triangle-block">
					<div class="triangle-block-top">
						<img src="<?php echo base_url() ?>assets/img/why1.png">
					</div>
					<div class="round-block-content">
						<h4><b>Berkompeten<br></b></h4>
						<p>Telah mengikuti pelatihan dan sertifikasi juru sembelih halal
						</p>
					</div>
				</div>
			</div>

			<div class="col-md-2 foo">
				<div class="triangle-block">
					<div class="triangle-block-top">
						<img src="<?php echo base_url() ?>assets/img/why2.png">
					</div>
					<div class="round-block-content">
						<h4><b>Total Dipisah</b></h4>
						<p>Tidak dicampur antara pesanan
							satu dengan yang lain baik daging, tulang,
							jeroan, kaki
						</p>
					</div>
				</div>
			</div>

			<div class="col-md-2 foo">
				<div class="triangle-block">
					<div class="triangle-block-top">
						<img src="<?php echo base_url() ?>assets/img/why3.png">
					</div>
					<div class="round-block-content">
						<h4><b>Tidak Ada Biaya Tambahan</b></h4>
						<p>
							Gratis biaya masak, potong, pengiriman dan buku risalah
						</p>
					</div>
				</div>
			</div>

			<div class="col-md-2 foo">
				<div class="triangle-block">
					<div class="triangle-block-top">
						<img src="<?php echo base_url() ?>assets/img/why4.png">
					</div>
					<div class="round-block-content">
						<h4><b>Asosiasi</b></h4>
						<p>tergabung dalam ASPAQIN
							(asosiasi pengusaha aqiqah indonesia)
						</p>
					</div>
				</div>
			</div>

			<div class="col-md-2 foo">
				<div class="triangle-block">
					<div class="triangle-block-top">
						<img src="<?php echo base_url() ?>assets/img/why6.png">
					</div>
					<div class="round-block-content">
						<h4><b>Foto/Video</b></h4>
						<p>Siap mendokumentasikan penyembelihan berupa foto/video
						</p>
					</div>
				</div>
			</div>

			</div>
		</div>
		</div>

		<!-- WHY CONTENT CLOSE -->

		<div class="row">
			<div class="container">
				<div class="quote foo">
					<h2><i>Beserta Lahirnya Seorang Anak Ada Aqiqah (HR. Al Bukhori, Abu Dawud, At - Thirmidzi, An - Nasai, Al - Baihaqi, Ahmad, Dan Ibnu Majah)</i></h2>
				</div>
			</div>
		</div>

		<hr>


		<h2 class="text-center text-bold foo" style="margin-top: 70px;">Apa Kata Mereka ?</h2>
		<div class="row">

			<div class="container flex-wrap">

				<?php foreach ($query->result_array() as $key => $value) {
					
				?>
				<div class="col-md-4 foo">
					<div class="testi-wrap" style="background-color: white">
					<div class="row">
						<div class="col-md-4">
							<div class="img-testi-div">
							<img class="img-responsive" src="<?php echo image_exists("assets/img/testimoni_img/",$value['picture'],"yes-01.png"); ?>">
							</div>
						</div>
						<div class="col-md-8"><h4 style="line-height: 1.5"><b><?php echo $value['name'] ?></b><br><?php echo $value['testi_ket'] ?></h4></div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12 test-w-body">
						<p><i>
							" <?php echo $value['testi_isi'] ?>"
							</i>
						</p>
						</div>
					</div>
					
					</div>
				</div>
				<?php } ?>
				<div class="col-md-4">
					<div class="" style="margin-top: 70px;"><a class="hover-none" href="<?php echo base_url()."testimoni/" ?>"><button class="btn-order">Lihat selengkapnya</button></a></div>
				</div>


			</div>


		</div>
		<div style="margin-top: 70px; "></div>
		<div class="row"  style="padding:15px;">
			<div class="container">
				<hr>
				<div class="row">
				<div class="col-md-6"><h2 class="text-bold foo" style="line-height: 2;">Ayo Kirim Testimonimu Disini !!</h2></div>
				<?php if (empty($this->session_user->user_visitors())) {
				?>
				<div class="col-md-3 foo"><a href="<?php echo base_url()."login/" ?>"><button class="div-lainnya2 btn-hover">Masuk</button></a></div>
				<div class="col-md-3 foo"><a href="<?php echo base_url()."daftar/" ?>"><button class="div-lainnya2 btn-hover">Daftar</button></a></div>
				<?php } else{ ?>
				<div class="col-md-3 foo"><a href="<?php echo base_url()."user/testimoni/" ?>"><button class="div-lainnya2 btn-hover">Klik Disini</button></a></div>

				<?php } ?>

				</div>
				<hr>
			</div>
		</div>
		<div style="margin-top: 70px;"></div>
		<div class="row">
			<div class="block-white" style="padding: 50px 0">
			<div class="container">
				<div class="col-md-6">
					<img class="img-responsive" style="width: 70%; margin: auto;" src="<?php echo base_url()."assets/img/pertanyaan aqiqah.png" ?>">
				</div>
				<div class="why-c col-md-6">
					<div class="row">
						<div class="col-md-12"><h4 class="text-bold foo">Aqiqah artinya apa ?</h4></div>
						<div class="col-md-12"><h4 class="text-right line-15 foo"><i>“Secara bahasa maknanya memotong. Sabda
						Rosul, ‘Setiap anak digadaikan dengan
						aqiqahnya, disembelihkan pada hari
						ke-7 kelahirannya, diberi nama, dan dicukur
						kepalanya.”</i></h4></div>

						<div class="col-md-12"><h4 class="text-bold foo">Harus hari ke-7 ?</h4></div>
						<div class="col-md-12"><h4 class="text-right line-15 foo"><i>“Oh, tidak. Menurut Az-Zahiri, Sesuai
						kemampuan, kapan saja, tanpa batasan
						tertentu.”</i></h4></div>

						<div class="col-md-12"><h4 class="text-bold">Hukum aqiqah gimana sih?</h4></div>
						<div class="col-md-12"><h4 class="text-right line-15 foo"><i>“Pendapat terkuat adalah sunnah muakkadah,
						sunah yang dianjurkan.”</i></h4></div>

						<div class="col-md-12"><h4 class="text-bold foo">Aqiqah untuk anak perempuan
						dan laki laki sama?</h4></div>
						<div class="col-md-12"><h4 class="text-right line-15 foo"><i>“Yang afdol laki laki 2 ekor, perempuan 1 ekor”</i></h4></div>

						<div class="col-md-12"><h4 class="text-bold foo">Jika waktu bayi belum diaqiqahi bagaimana?
						</h4></div>
						<div class="col-md-12"><h4 class="text-right line-15 foo"><i>“Menurut al Hasan al Bashri,’Jika engkau
						belum diaqiqahi, aqiqahilah dirimu, sekalipun
						engkau telah dewasa!”</i></h4></div>

					</div>
				</div>
			</div>
		</div>
		</div>
	
		<div class="row">
			<div class="container">
			
				<div class="quote foo">
				<h2>Ayo ..!! Daftar jadi member sekarang juga dan dapatkan promo menarik</h2>
				<a href="<?php echo base_url()."daftar/" ?>" class="hover-none"><button class="btn-order2">Daftar disini</button></a>
				</div>
				<hr>
			</div>
		</div>

<script type="text/javascript">
$(document).ready(function(){
        window.sr = ScrollReveal({ reset: false });

// Customizing a reveal set
    sr.reveal('.foo', { duration: 1200 });
})
</script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/js/scrollreveal.js"></script>