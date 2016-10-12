<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$site_title;?></title>
	<meta name="description" content="<?=$meta_description;?>">
	<meta name="keywords" content="<?=$meta_keywords;?>, http://inorobo.com">
	<meta name="author" content="<?=$author;?>">
	<link rel="shortcut icon" href="<?=base_url('assets/images/icon.png');?>">
	<?=link_tag('views/themes/classic/assets/plugin/slider/flexslider.css');?>
	<?=link_tag('views/themes/classic/assets/plugin/prettyphoto/css/prettyphoto.css');?>
	<?=link_tag('views/themes/classic/assets/css/style.css');?>
	<?=link_tag('views/themes/classic/assets/css/custom.css');?>
	<?=link_tag('views/themes/classic/assets/css/form.css');?>
	<script src="<?=base_url('assets/backend/js/jquery.min.js');?>" type="text/javascript"></script>
	<script src="<?=base_url('views/themes/classic/assets/plugin/slider/jquery.flexslider-min.js');?>" type="text/javascript"></script>
	<script src="<?=base_url('views/themes/classic/assets/plugin/prettyphoto/js/jquery.prettyPhoto.js');?>" type="text/javascript"></script>
	<script src="<?=base_url('views/themes/classic/assets/js/plugins.library.js');?>" type="text/javascript"></script>
	<script src="<?=base_url('views/themes/classic/assets/js/init.js');?>" type="text/javascript"></script>
	<script src="<?=base_url('assets/js/action.js');?>" type="text/javascript"></script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div id="wrapper">
	<section id="top-bar" class="clearfix">
		<div class="container">
			<ul id="top-nav" class="clearfix">
				<li id="clock"></li>
				<li id="rss-feed"><a href="<?=site_url('home/rss');?>" target="_blank">RSS</a></li>
				<li id="subscribe"><a href="<?=site_url('home/peta_situs');?>">PETA SITUS</a></li>
			</ul>
		</div>
	</section>
	<header id="primary-header">
		<div class="header">
			<img src="<?=base_url('assets/images/' . $this->setting['header_image']);?>" alt="LOGO"/>
		</div>
	</header>
    <div id="fixed-wrapper">
	<nav id="primary-navigator">
		<div class="container">
			<ul id="primary-navigator-list" class="tree-menu">
				<li <?=isset($home) ? 'class="current"' : '';?>><a href="<?=base_url();?>"><?=strtoupper($menu['home'] == '' ? 'Home' : $menu['home']);?></a></li>
				<?php $parent = $this->m_global->get_parent_page();
				foreach ($parent as $nav) {
				   echo '<li ';
				   echo isset($page) ? 'class="current"' : '';
				   echo '>';
				   $href = site_url('home/readmore/' . $nav['post_id'] . '/' . $nav['slug']);
		         if (count($nav['child']) > 0) {
		            $href = '#';
		         }
				   echo anchor($href, strtoupper($nav['post_title']));
				   $sub_nav = recursive_list($nav['child']);
				   if ($sub_nav != '') {
				      echo '<ul>';
				      echo recursive_list($nav['child']);
				      echo '</ul>';
				   }
				   echo '</li>';
				}
				?>
				<li <?=isset($direktori) ? 'class="current"' : '';?>><a href="#"><?=strtoupper($menu['direktori'] == '' ? 'Direktori' : $menu['direktori']);?></a>
					<ul>
						<li><a href="<?=site_url('home/ptk');?>"><?=strtoupper($menu['direktori_ptk'] == '' ? 'Direktori PTK' : $menu['direktori_ptk']);?></a></li>
						<li><a href="<?=site_url('home/siswa');?>"><?=strtoupper($menu['direktori_siswa'] == '' ? 'Direktori Siswa' : $menu['direktori_siswa']);?></a></li>
						<li><a href="#"><?=strtoupper($menu['prestasi'] == '' ? 'Direktori Prestasi' : $menu['prestasi']);?></a>
							<ul>
								<li><a href="<?=site_url('home/prestasi_sekolah');?>"><?=strtoupper($menu['prestasi_sekolah'] == '' ? 'Prestasi Sekolah' : $menu['prestasi_sekolah']);?></a></li>
								<li><a href="<?=site_url('home/prestasi_ptk');?>"><?=strtoupper($menu['prestasi_ptk'] == '' ? 'Prestasi PTK' : $menu['prestasi_ptk']);?></a></li>
								<li><a href="<?=site_url('home/prestasi_siswa');?>"><?=strtoupper($menu['prestasi_siswa'] == '' ? 'Prestasi Siswa' : $menu['prestasi_siswa']);?></a></li>
							</ul>
						</li>
					</ul>
				</li>

				<?php if ($this->setting['ppdb_status'] == 'open' && ($this->setting['jenjang'] == 'SMP' || $this->setting['jenjang'] == 'SMA')) {?>
				<li <?=isset($ppdb) ? 'class="current"' : '';?>><a href="#"><?=strtoupper($menu['ppdb'] == '' ? 'PPDB' : $menu['ppdb']);?> <?=$this->setting['ppdb_tahun'];?></a>
					<ul>
						<li><a href="<?=site_url('ppdb/registration');?>"><?=strtoupper($menu['daftar_sekarang'] == '' ? 'Daftar Sekarang' : $menu['daftar_sekarang']);?></a></li>
						<li><a href="<?=site_url('ppdb/check');?>"><?=strtoupper($menu['hasil_seleksi'] == '' ? 'Hasil Seleksi' : $menu['hasil_seleksi']);?></a></li>
						<li><a href="<?=site_url('ppdb/cetak_formulir');?>"><?=strtoupper($menu['cetak_formulir'] == '' ? 'Cetak Formulir' : $menu['cetak_formulir']);?></a></li>
						<li><a href="<?=site_url('ppdb/statistik');?>"><?=strtoupper($menu['grafik_ppdb'] == '' ? 'Grafik PPDB' : $menu['grafik_ppdb']);?></a></li>
						<li><a href="<?=site_url('formulir_ppdb');?>"><?=strtoupper($menu['download_formulir'] == '' ? 'Download formulir' : $menu['download_formulir']);?></a></li>
					</ul>
				</li>
				<?php } ?>

				<?php if ($this->setting['ppdb_status'] == 'open' && $this->setting['jenjang'] == 'SMK') {?>
				<li <?=isset($ppdb) ? 'class="current"' : '';?>><a href="#"><?=strtoupper($menu['ppdb'] == '' ? 'PPDB' : $menu['ppdb']);?> <?=$this->setting['ppdb_tahun'];?></a>
					<ul>
						<li><a href="<?=site_url('ppdb-smk/registration');?>"><?=strtoupper($menu['daftar_sekarang'] == '' ? 'Daftar Sekarang' : $menu['daftar_sekarang']);?></a></li>
						<li><a href="<?=site_url('ppdb-smk/check');?>"><?=strtoupper($menu['hasil_seleksi'] == '' ? 'Hasil Seleksi' : $menu['hasil_seleksi']);?></a></li>
						<li><a href="<?=site_url('ppdb-smk/cetak_formulir');?>"><?=strtoupper($menu['cetak_formulir'] == '' ? 'Cetak Formulir' : $menu['cetak_formulir']);?></a></li>
						<li><a href="<?=site_url('ppdb-smk/statistik');?>"><?=strtoupper($menu['grafik_ppdb'] == '' ? 'Grafik PPDB' : $menu['grafik_ppdb']);?></a></li>
						<li><a href="<?=site_url('formulir_ppdb');?>"><?=strtoupper($menu['download_formulir'] == '' ? 'Download formulir' : $menu['download_formulir']);?></a></li>
					</ul>
				</li>
				<?php } ?>

				<?php if ($this->setting['ppdb_status'] == 'open' && $this->setting['jenjang'] == 'SD') {?>
				<li <?=isset($ppdb) ? 'class="current"' : '';?>><a href="#"><?=strtoupper($menu['ppdb'] == '' ? 'PPDB' : $menu['ppdb']);?> <?=$this->setting['ppdb_tahun'];?></a>
					<ul>
						<li><a href="<?=site_url('ppdb-sd/registration');?>"><?=strtoupper($menu['daftar_sekarang'] == '' ? 'Daftar Sekarang' : $menu['daftar_sekarang']);?></a></li>
						<li><a href="<?=site_url('ppdb-sd/check');?>"><?=strtoupper($menu['hasil_seleksi'] == '' ? 'Hasil Seleksi' : $menu['hasil_seleksi']);?></a></li>
						<li><a href="<?=site_url('ppdb-sd/cetak_formulir');?>"><?=strtoupper($menu['cetak_formulir'] == '' ? 'Cetak Formulir' : $menu['cetak_formulir']);?></a></li>
						<li><a href="<?=site_url('ppdb-sd/statistik');?>"><?=strtoupper($menu['grafik_ppdb'] == '' ? 'Grafik PPDB' : $menu['grafik_ppdb']);?></a></li>
						<li><a href="<?=site_url('formulir_ppdb');?>"><?=strtoupper($menu['download_formulir'] == '' ? 'Download formulir' : $menu['download_formulir']);?></a></li>
					</ul>
				</li>
				<?php } ?>

				<?php if ($file_category->num_rows() > 0) { ?>
				<li <?=isset($berkas) ? 'class="current"' : '';?>><a href="#"><?=strtoupper($menu['download'] == '' ? 'Download' : $menu['download']);?></a>
					<ul>
						<?php foreach ($file_category->result() as $files) {
					      echo '<li><a href="' . site_url('home/files/' . $files->category_id) . '">' . strtoupper($files->category) . '</a>';
					      $sub_category = $this->db->where('parent', $files->category_id)->get('file_category');
					      if ($sub_category->num_rows() > 0) {
					         echo '<ul>';
					         foreach ($sub_category->result() as $category) {
					            echo '<li><a href="' . site_url('home/files/' . $category->category_id) . '">' . strtoupper($category->category) . '</a></li>';
					         }
					         echo '</ul>';
					      }
					      echo '</li>';
					   }
					   ?>
					</ul>
				</li>
				<?php } ?>
				<li <?=isset($event) ? 'class="current"' : '';?>><a href="<?=site_url('home/agenda_sekolah');?>"><?=strtoupper($menu['event'] == '' ? 'Agenda Sekolah' : $menu['event']);?></a></li>
				<li <?=isset($gallery) ? 'class="current"' : '';?>><a href="#"><?=strtoupper($menu['gallery'] == '' ? 'Gallery' : $menu['gallery']);?></a>
					<ul>
						<li><a href="<?=site_url('home/album');?>"><?=strtoupper($menu['gallery_photo'] == '' ? 'Gallery Photo' : $menu['gallery_photo']);?></a></li>
						<li><a href="<?=site_url('home/video');?>"><?=strtoupper($menu['gallery_video'] == '' ? 'Gallery Video' : $menu['gallery_video']);?></a></li>
					</ul>
				</li>
				<li <?=isset($contact) ? 'class="current"' : '';?>><a href="<?=site_url('home/hubungi_kami');?>"><?=strtoupper($menu['hubungi_kami'] == '' ? 'Hubungi Kami' : $menu['hubungi_kami']);?></a></li>
			</ul>
		</div>
	</nav>
	<section id="sub-bar" class="container">
		<ul id="news-ticker">
			<?php foreach ($motivation->result() as $motivasi) {?>
			<li><?=$motivasi->content;?>. <strong style="font-style:italic;color:yellow;"><?=$motivasi->author;?></strong></li>
			<?php } ?>
		</ul>
	</section>
    </div>

    <section id="content-wrapper" class="container">
    <?php $this->load->view($content);?>
    </section>

	<footer id="sub-footer" class="container">
		<div class="footer-left">
			<h4><strong><?=strtoupper($this->setting['nama_sekolah']);?></strong></h4>
			<p><?=$this->setting['alamat'];?> 
				<?=$this->setting['telp'] != '' ? 'Telp. ' . $this->setting['telp'] : ''?></p>
			<ul id="social-network">
				<?php if ($this->setting['facebook'] != '') {?>
				<li class="tips" title="Facebook"><a href="<?=$this->setting['facebook'];?>" target="_blank"><img alt="image" src="<?=base_url('views/themes/classic/assets/icon/facebook.png');?>"/></a></li>
				<?php } ?>
				<?php if ($this->setting['twitter'] != '') {?>
				<li class="tips" title="Twitter"><a href="<?=$this->setting['twitter'];?>" target="_blank"><img alt="image" src="<?=base_url('views/themes/classic/assets/icon/twitter.png');?>"/></a></li>
				<?php } ?>
				<?php if ($this->setting['google_plus'] != '') {?>
				<li class="tips" title="Google"><a href="<?=$this->setting['google_plus'];?>" target="_blank"><img alt="image" src="<?=base_url('views/themes/classic/assets/icon/google.png');?>"/></a></li>
				<?php } ?>
				<?php if ($this->setting['youtube'] != '') {?>
				<li class="tips" title="Youtube"><a href="<?=$this->setting['youtube'];?>" target="_blank"><img alt="image" src="<?=base_url('views/themes/classic/assets/icon/youtube.png');?>"/></a></li>
				<?php } ?>
			</ul>
		</div>
		<div class="footer-right">
			<h4><strong>PHOTO TERBARU</strong></h4>
			<ul id="footer-img" class="clearfix">
				<?php foreach ($recent_photo->result() as $photo) { ?>
				<li>
					<div>
						<a href="<?=base_url('assets/gallery/' . $photo->photo_original);?>" rel="prettyPhoto[gallery-footer]" class="tips" original-title="<?=$photo->photo_title;?>">
							<img width="77px" height="77px" src="<?=base_url('assets/gallery/thumb/' . $photo->photo_thumb);?>" alt="<?=$photo->photo_title;?>">
						</a>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
		<ul id="copyright-wrapper" class="clearfix">
			<li>Copyright © <?=date('Y');?> <?=$this->setting['nama_sekolah'];?>. All Rights Reserved.
			<br>Alamat : <?=$this->setting['alamat'];?>
			<br><?=developed();?> <?=$this->config->item('version');?>
			</li>
		</ul>
	</footer>
</div>
</body>
</html>