<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url('views/themes/default/assets/moodal/js/bootstrap.js');?>"></script>
<link href="<?=base_url('views/themes/default/assets/moodal/css/bootstrap.css');?>" rel="stylesheet">
<aside id="aside-secondary">
	 <?php if ($this->uri->segment(2) != 'why_robotic') { ?>
	 <div class="widget-title">
		  <h4><span class="ja ji"><?=$menu['why_robotic'] == '' ? 'Mengapa Harus Robotic?' : $menu['why_robotic'];?></span> <i class="fa fa-microphone"></i></h4>
	 </div>
	 <div class="widget">
		  <ul class="post-list">
				<li class="clearfix" style="padding:0;">
				    <div class="sambut">
					    <?php if ($kepsek['photo'] != NULL) {?>
					    <img width="100%" title="<?=$kepsek['nama'];?>" src="<?=base_url('assets/ptk/' . $kepsek['photo']);?>" alt="image" style="margin-top:0;"/>
					    <?php } ?>
					</div>
					 <p><?=strip_tags(substr($this->setting['why_robotic'], 0, 180));?>...</p>
					 <p><a class="samkep" href="<?=site_url('home/why_robotic');?>">Selengkapnya..<i class="fa fa-angle-right"></i></a></p>
				</li>
		  </ul>
	 </div>
	 <?php } ?>

	 <div class="widget-title">
		  <h4><span><?=$menu['jajak_pendapat'] == '' ? 'JAJAK PENDAPAT' : $menu['jajak_pendapat'];?></span> <i class="fa fa-star"></i></h4>
	 </div>
	 <div class="widget">
		  <div id="message-polling" style="display:none;"></div>
		  <img id="loading-polling" style="display:none;" src="<?=base_url();?>assets/loading.gif">
		  <?=form_open(site_url('home/polling'), ['class' => 'form-inline', 'role' => 'form', 'id' => 'form-polling']);?>
				<p><?=$pertanyaan['pertanyaan'];?></p>
				<?php foreach ($jawaban->result() as $option) {?>
				<label for="<?=$option->jawaban_id;?>">
					 <input type="radio" id="jawaban_id" name="jawaban_id" value="<?=$option->jawaban_id;?>"/> <?=$option->jawaban;?>
				</label>
				<?php } ?>
				<div class="botpoll">
				    <button id="submit-polling" type="submit" value="submit" name="submit">SUBMIT</button><a class="jawaban" href="<?=site_url('home/result_polling');?>">Lihat Jawaban</a>
				</div>
		  <?=form_close();?>
	 </div>
	 <?php if ($banner->num_rows() > 0) { ?>
	 <div class="widget-title">
		  <h4><span><?=$menu['banner'] == '' ? 'BANNER' : $menu['banner'];?> </span> <i class="fa fa-heart"></i></h4>
	 </div>
	 <div class="widget">
		<?php
		foreach ($banner->result() as $iklan) {
	      echo '<div class="banner">';
	      echo '<a href="' . $iklan->url . '" title="' . $iklan->keterangan . '" target="_blank">';
	      echo '<img src="' . base_url('assets/banner/' . $iklan->gambar) . '">';
	      echo '</a>';
	      echo '</div>';
   	} ?>
	 </div>
	 <?php } ?>
	 
	 	<?php if ($categories->num_rows() > 0) { ?>
	<div class="widget-title">
		<h4><span><?=$menu['kategori']==''?'KATEGORI':$menu['kategori'];?></span> <i class="fa fa-folder-open"></i></h4>
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
		<h4><span><?=$menu['arsip']==''?'ARSIP':$menu['arsip'];?> <?=date('Y');?></span> <i class="fa fa-calendar-check-o"></i></h4>
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
		<h4><span><?=$menu['tautan']==''?'TAUTAN':$menu['tautan'];?></span> <i class="fa fa-list"></i></h4>
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
		<h4><span><?=$menu['prestasi']==''?'PRESTASI':$menu['prestasi'];?></span> <i class="fa fa-throphy"></i></h4>
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
				                        <img style="margin-top:3px;" src="<?=base_url('assets/post/thumb/'.$result->post_image);?>">
				                        <?php } else { ?>
				                        <img style="margin-top:3px;" src="<?=base_url('assets/190x190.gif');?>">
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
		<h4><span><?=$menu['yahoo']==''?'YAHOO MESSANGER':$menu['yahoo'];?></span> <i class="fa fa-comment"></i></h4>
	</div>
	<div class="widget">
		<a href="ymsgr:sendIM?<?=$this->setting['yahoo'];?>"> <img src="http://opi.yahoo.com/online?u=<?=$this->setting['yahoo'];?>&m=g&t=14&l=us"/></a>
	</div>

	 <div class="widget-title">
		  <h4><span>KAMI DI FACEBOOK</span> <i class="fa fa-facebook"></i></h4>
	 </div>
	 <div class="widget" style="background:#fff;">
		  <div class="fb-like-box"
				data-href="<?=$this->setting['facebook'];?>"
				data-height="350"
				data-width="250"
				data-colorscheme="light"
				data-show-faces="true"
				data-header="false"
				data-stream="false"
				data-show-border="false">
		  </div>
		  <br>
		  <br>
	 </div>
</aside>