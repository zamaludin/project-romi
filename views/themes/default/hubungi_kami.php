<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
var myCenter=new google.maps.LatLng(<?=$google_map?>);
function initialize() {
	var mapProp = {
  		center:myCenter,
	  zoom:15,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
  };
	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
	var marker=new google.maps.Marker({
  		position:myCenter,
  		title: 'Click to zoom'
	});
	marker.setMap(map);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<section id="main-content">
	<div class="widget-title">
		<h4><?=strtoupper($menu['hubungi_kami'] == '' ? 'Hubungi Kami' : $menu['hubungi_kami']);?> <i class="fa fa-envelope"></i> </h4>
	</div>
	<div class="widget">
		<div id="googleMap" style="width:643px;height:400px;"></div>
		<br>
		<div id="hubungi_kami_message" class="alert" style="display:none;"></div>
        	<img id="hubungi_kami_loading" style="display:none;" src="<?=base_url();?>assets/loading.gif">
        	<form action="<?=$action;?>" id="form-hubungi-kami" class="my-style" method="post">
				<label>
					<span>Nama :</span>
					<input id="nama" type="text" required autofocus name="nama" value="<?php echo set_value('nama'); ?>" placeholder="Masukan nama lengkap anda" />
				</label>
				<label>
					<span>Email :</span>
					<input id="email" type="email" required name="email" value="<?php echo set_value('email'); ?>" placeholder="Masukan alamat email aktif anda" />
				</label>
				<label>
					<span>Website :</span>
					<input id="url" type="url" name="url" value="<?php echo set_value('url'); ?>" placeholder="Masukan URL website anda" />
				</label>
				<label>
					<span>Pesan :</span>
					<textarea id="pertanyaan" name="pertanyaan" required placeholder="Silahkan ketikan saran, kritik, maupun pertanyaan seputar sekolah <?=$this->setting['nama_sekolah'];?> disini"><?php echo set_value('pertanyaan'); ?></textarea>
				</label>
				<label>
					<span>Kode Keamanan</span>
					<?=$captcha['image'];?>
				</label>
				<label>
					<span>&nbsp;</span>
					<input id="captcha" type="text" name="captcha" required placeholder="Untuk keamanan, silahkan masukan 5 angka diatas" />
				</label>
				<label class="submit">
					<span>&nbsp;</span>
					<input id="btn-guestbook" type="submit" class="button" value="KIRIM PESAN" />
				</label>
			</form>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>