<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">
.link a, .link ul li a {
	color: #c90606;
}
</style>
<section id="main-content" class="home">
	<div class="widget-title">
		<h4><i class="icon-check"></i> <?=$title;?></h4>
	</div>
	<div class="widget link">
		<ul class="post-list">
			<li class="clearfix">
				<a href="<?=site_url('home/pengumuman');?>">--&nbsp;&nbsp;PENGUMUMAN</a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('home/event');?>">--&nbsp;&nbsp;AGENDA</a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('home/sekilas_info');?>">--&nbsp;&nbsp;SEKILAS INFO</a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('home/hubungi_kami');?>">--&nbsp;&nbsp;HUBUNGI KAMI</a>
			</li>
		</ul>
		<?php if ($categories->num_rows() > 0) { ?>
		<h4><b><?=$menu['kategori'];?></b></h4>
		<ul class="post-list">
			<?php foreach ($categories->result() as $row) {?>
			<li class="clearfix">
				<a href="<?=site_url('home/category/' . $row->category_id);?>">--&nbsp;&nbsp;<?=strtoupper($row->category);?></a>
			</li>
			<?php } ?>
		</ul>
		<br>
		<?php } ?>
		<?php if ($pages->num_rows() > 0) { ?>
		<h4><b>HALAMAN</b></h4>
		<ul class="post-list">
			<?php foreach ($pages->result() as $row) {?>
			<li class="clearfix">
				<a href="<?=site_url('home/readmore/' . $row->post_id);?>">--&nbsp;&nbsp;<?=$row->post_title;?></a>
			</li>
			<?php } ?>
		</ul>
		<br>
		<?php } ?>
		<h4><b><?=$menu['direktori'] == '' ? 'DIREKTORI' : $menu['direktori'];?></b></h4>
		<ul class="post-list">
			<li class="clearfix">
				<a href="<?=site_url('home/siswa');?>">--&nbsp;&nbsp;<?=$menu['direktori_siswa'] == '' ? 'DIREKTORI SISWA' : $menu['direktori_siswa'];?></a>
			</li>
			<li>
				<a href="<?=site_url('home/ptk');?>">--&nbsp;&nbsp;<?=$menu['direktori_ptk'] == '' ? 'DIREKTORI PTK' : $menu['direktori_ptk'];?></a>
			</li>
			<li>
				<a href="<?=site_url('home/alumni');?>">--&nbsp;&nbsp;<?=$menu['direktori_alumni'] == '' ? 'DIREKTORI ALUMNI' : $menu['direktori_alumni'];?></a>
			</li>
			<li>
				<a href="#">--&nbsp;&nbsp;<?=$menu['prestasi'] == '' ? 'PRESTASI' : $menu['prestasi'];?></a>
			</li>
			<li>
				<a href="<?=site_url('home/prestasi_sekolah');?>">&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;<?=$menu['prestasi_sekolah'] == '' ? 'PRESTASI SEKOLAH' : $menu['prestasi_sekolah'];?></a>
			</li>
			<li>
				<a href="<?=site_url('home/prestasi_ptk');?>">&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;<?=$menu['prestasi_ptk'] == '' ? 'PRESTASI PTK' : $menu['prestasi_ptk'];?></a>
			</li>
			<li>
				<a href="<?=site_url('home/prestasi_siswa');?>">&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;<?=$menu['prestasi_siswa'] == '' ? 'PRESTASI SISWA' : $menu['prestasi_siswa'];?></a>
			</li>
		</ul>

		<?php if ($this->setting['jenjang'] == 'SD' && is_dir(APPPATH . 'controllers/ppdb-sd')) {?>
		<br>
		<h4><b><?=$menu['ppdb'] == '' ? 'PPDB' : $menu['ppdb'];?> <?=$this->setting['ppdb_tahun'];?></b></h4>
		<ul class="post-list">
			<li class="clearfix">
				<a href="<?=site_url('ppdb-sd/registration');?>">--&nbsp;&nbsp;<?=$menu['daftar_sekarang'] == '' ? 'DAFTAR SEKARANG' : $menu['daftar_sekarang'];?></a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('ppdb-sd/check');?>">--&nbsp;&nbsp;<?=$menu['hasil_seleksi'] == '' ? 'HASIL SELEKSI' : $menu['hasil_seleksi'];?></a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('ppdb-sd/cetak_formulir');?>">--&nbsp;&nbsp;<?=$menu['cetak_formulir'] == '' ? 'CETAK FORMULIR' : $menu['cetak_formulir'];?></a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('ppdb-sd/statistik');?>">--&nbsp;&nbsp;<?=$menu['grafik_ppdb'] == '' ? 'GRAFIK PPDB' : $menu['grafik_ppdb'];?></a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('ppdb-sd/cetak/formulir_kosong');?>">--&nbsp;&nbsp;<?=$menu['download_formulir'] == '' ? 'DOWNLOAD FORMULIR' : $menu['download_formulir'];?></a>
			</li>
		</ul>
		<?php } ?>

		<?php if ($this->setting['jenjang'] == 'SMK' && is_dir(APPPATH . 'controllers/ppdb-smk')) {?>
		<br>
		<h4><b><?=$menu['ppdb'] == '' ? 'PPDB' : $menu['ppdb'];?> <?=$this->setting['ppdb_tahun'];?></b></h4>
		<ul class="post-list">
			<li class="clearfix">
				<a href="<?=site_url('ppdb-smk/registration');?>">--&nbsp;&nbsp;<?=$menu['daftar_sekarang'] == '' ? 'DAFTAR SEKARANG' : $menu['daftar_sekarang'];?></a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('ppdb-smk/check');?>">--&nbsp;&nbsp;<?=$menu['hasil_seleksi'] == '' ? 'HASIL SELEKSI' : $menu['hasil_seleksi'];?></a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('ppdb-smk/cetak_formulir');?>">--&nbsp;&nbsp;<?=$menu['cetak_formulir'] == '' ? 'CETAK FORMULIR' : $menu['cetak_formulir'];?></a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('ppdb-smk/statistik');?>">--&nbsp;&nbsp;<?=$menu['grafik_ppdb'] == '' ? 'GRAFIK PPDB' : $menu['grafik_ppdb'];?></a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('ppdb-smk/cetak/formulir_kosong');?>">--&nbsp;&nbsp;<?=$menu['download_formulir'] == '' ? 'DOWNLOAD FORMULIR' : $menu['download_formulir'];?></a>
			</li>
		</ul>
		<?php } ?>

		<?php if ($this->setting['jenjang'] == 'SMP' || $this->setting['jenjang'] == 'SMA' && is_dir(APPPATH . 'controllers/ppdb-smk')) {?>
		<br>
		<h4><b><?=$menu['ppdb'] == '' ? 'PPDB' : $menu['ppdb'];?> <?=$this->setting['ppdb_tahun'];?></b></h4>
		<ul class="post-list">
			<li class="clearfix">
				<a href="<?=site_url('ppdb/registration');?>">--&nbsp;&nbsp;<?=$menu['daftar_sekarang'] == '' ? 'DAFTAR SEKARANG' : $menu['daftar_sekarang'];?></a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('ppdb/check');?>">--&nbsp;&nbsp;<?=$menu['hasil_seleksi'] == '' ? 'HASIL SELEKSI' : $menu['hasil_seleksi'];?></a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('ppdb/cetak_formulir');?>">--&nbsp;&nbsp;<?=$menu['cetak_formulir'] == '' ? 'CETAK FORMULIR' : $menu['cetak_formulir'];?></a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('ppdb/statistik');?>">--&nbsp;&nbsp;<?=$menu['grafik_ppdb'] == '' ? 'GRAFIK PPDB' : $menu['grafik_ppdb'];?></a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('ppdb/cetak/formulir_kosong');?>">--&nbsp;&nbsp;<?=$menu['download_formulir'] == '' ? 'DOWNLOAD FORMULIR' : $menu['download_formulir'];?></a>
			</li>
		</ul>
		<?php } ?>

		<?php if ($files->num_rows() > 0) { ?>
		<br>
		<h4><b><?=$menu['download'] == '' ? 'DOWNLOAD' : $menu['download'];?></b></h4>
		<ul class="post-list">
			<?php
			foreach ($files->result() as $row) {
			      echo '<li class="clearfix">';
			      echo '<a href="' . site_url('home/files/' . $row->category_id) . '">--&nbsp;&nbsp;' . strtoupper($row->category) . '</a>';
			      echo '</li>';
			      $sub_files = $this->m_global->find('file_category', 'parent', $row->category_id);
			      foreach ($sub_files->result() as $value) {
			         echo '<li class="clearfix">';
			         echo '<a href="' . site_url('home/files/' . $value->category_id) . '">&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;' . strtoupper($value->category) . '</a>';
			         echo '</li>';
			      }
			   }
			   ?>
		</ul>
		<?php } ?>
		<br>
		<h4><b><?=$menu['gallery'] == '' ? 'GALLERY' : $menu['gallery'];?></b></h4>
		<ul class="post-list">
			<li class="clearfix">
				<a href="<?=site_url('home/album');?>">--&nbsp;&nbsp;<?=$menu['gallery_photo'] == '' ? 'PHOTO' : $menu['gallery_photo'];?></a>
			</li>
			<li class="clearfix">
				<a href="<?=site_url('home/video');?>">--&nbsp;&nbsp;<?=$menu['gallery_video'] == '' ? 'VIDEO' : $menu['gallery_video'];?></a>
			</li>
		</ul>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-primary');?>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>