<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url('views/themes/classic/assets/moodal/js/bootstrap.js');?>"></script>
<link href="<?=base_url('views/themes/classic/assets/moodal/css/bootstrap.css');?>" rel="stylesheet">
<aside id="aside-primary">
	<?php if ($categories->num_rows() > 0) { ?>
	<div class="widget-title">
		<h4><i class="icon-check icon-white"></i> <?=$menu['kategori']==''?'KATEGORI':$menu['kategori'];?></h4>
	</div>
	<div class="widget">
		<ul class="ul-list clearfix">
			<?php foreach ($categories->result() as $category)
			{
				echo '<li>'.anchor('home/category/'.$category->category_id, $category->category.' <span>'.$category->jumlah.'</span>').'</li>';
			}
			?>
		</ul>
	</div>
	<?php } ?>

	<?php if ($archives->num_rows() > 0) { ?>
	<div class="widget-title">
		<h4><i class="icon-calendar icon-white"></i> <?=$menu['arsip']==''?'ARSIP':$menu['arsip'];?> <?=date('Y');?></h4>
	</div>
	<div class="widget">
		<ul class="ul-list clearfix">
			<?php foreach ($archives->result() as $archive)
			{
				echo '<li>'.anchor('home/archive/'.$archive->kode.'/'.date('Y'), bulan($archive->kode).' <span>'.$archive->jumlah.'</span>', array('title' => 'Arsip berita bulan '.bulan($archive->kode))).'</li>';
			}
			?>
		</ul>
	</div>
	<?php } ?>

	<?php if ($tautan->num_rows() > 0) { ?>
	<div class="widget-title">
		<h4><i class="icon-bookmark icon-white"></i> <?=$menu['tautan']==''?'TAUTAN':$menu['tautan'];?></h4>
	</div>
	<div class="widget">
		<ul class="ul-list clearfix">
			<?php foreach ($tautan->result() as $link)
			{
				echo '<li>'.anchor($link->url, $link->keterangan, array('target' => '_blank', 'title' => $link->url)).'</li>';
			}
			?>
		</ul>
	</div>
	<?php } ?>

	<?php if ($prestasi->num_rows() > 0) { ?>
	<div class="widget-title">
		<h4><i class="icon-flag icon-white"></i> <?=$menu['prestasi']==''?'PRESTASI':$menu['prestasi'];?></h4>
	</div>
	<div class="widget">
		<ul class="ul-list clearfix">
			<?php foreach ($prestasi->result() as $result)
			{
				echo '<li>'.anchor($result->post_id, $result->post_title, array('data-toggle' => 'modal', 'data-target' => '#prestasi_'.$result->post_id)).'</li>';?>
				<div class="modal fade" id="prestasi_<?=$result->post_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h3 style="padding-left:10px;font-weight:bold;">
				        	<?php 
				        	if ($result->post_type == 'prestasi_sekolah')
				        	{
				        		echo 'PRESTASI SEKOLAH';
				        	}
				        	else if($result->post_type == 'prestasi_ptk')
				        	{
				        		echo 'PRESTASI PTK';
				        	}
				        	else if($result->post_type == 'prestasi_siswa')
				        	{
				        		echo 'PRESTASI SISWA';
				        	}
				        	?>
				        </h3>
				      </div>
				      <div class="modal-body">				      		
			      			<ul class="post-list">
					        	<li class="clearfix">
					        		<div class="left-columns" style="min-height:150px;width: 35%;">
						      			<?php if ($result->post_image != NULL && file_exists('./assets/post/thumb/'.$result->post_image)) { ?>
				                        <img width="200px" height="200px" style="margin-top:3px;" src="<?=base_url('assets/post/thumb/'.$result->post_image);?>">
				                        <?php } else { ?>
				                        <img width="200px" style="margin-top:3px;" src="<?=base_url('assets/190x190.gif');?>">
				                        <?php } ?>
						      		</div>
						      		<div class="right-columns">
					        		<p>
					        			<b><?=$result->post_title;?></b>
					        			<br>
					        			<?=$result->post_content;?>
					        		</p>
					        		</div>
					        	</li>
					        </ul>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">X</button>
				      </div>
				    </div>
				  </div>
				</div>
			<?php }	?>
		</ul>
	</div>
	<?php } ?>

	<div class="widget-title">
		<h4><i class="icon-comment icon-white"></i> <?=$menu['yahoo']==''?'YAHOO MESSANGER':$menu['yahoo'];?></h4>
	</div>
	<div class="widget">
		<a href="ymsgr:sendIM?<?=$this->setting['yahoo'];?>"> <img src="http://opi.yahoo.com/online?u=<?=$this->setting['yahoo'];?>&m=g&t=14&l=us"/></a>
	</div>
</aside>