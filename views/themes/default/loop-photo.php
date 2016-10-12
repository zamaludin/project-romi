<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section id="main-content" class="home">
	<div class="widget-title">
		<h4>GALLERY PHOTO <i class="fa fa-camera"></i></h4>
		<span class="views-all"><a href="<?=site_url('home/album');?>">Indeks</a></span>
	</div>
	<div class="widget">
		<?php if ($query->num_rows() > 0) {?>
		<h5 style="font-size:14px;font-weight:bold;margin:10px 0 10px 4px;"><?=strtoupper($title);?></h5>
		<ul id="gallery-photo" class="clearfix">
			<?php foreach ($query->result() as $row) {?>
			<li>
				<a href="<?=base_url('assets/gallery/' . $row->photo_original);?>" rel="prettyPhoto[gallery-photo]" class="tips" original-title="<?=$row->photo_title;?>"><img src="<?=base_url('assets/gallery/thumb/' . $row->photo_thumb);?>" alt="<?=$row->photo_title;?>"></a>
			</li>
			<?php } ?>
		</ul>

		<?php } else {?>
			<div class="alert alert-info">
				Photo tidak ditemukan !
			</div>
		<?php } ?>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>