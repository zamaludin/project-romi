<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section id="main-content" class="home eh">
	<?php if ($silder->num_rows() > 0) { ?>
	<div id="image-slider" class="clearfix">
		<div id="slider" class="flexslider">
				<ul class="slides">
				<?php foreach ($silder->result() as $slide) { ?>
				<li>
					<?php if ($slide->post_image != NULL && file_exists('assets/post/' . $slide->post_image)) {?>
						<img width="446px" height="438px" src="<?=base_url('assets/post/' . $slide->post_image);?>" alt="<?=$slide->post_title;?>"/>
					<?php } else {?>
						<img src="<?=base_url('assets/430x430.gif');?>" alt="<?=$slide->post_title;?>"/>
					<?php } ?>
					<div class="content">
						<h4><a href="<?=site_url('home/readmore/' . $slide->post_id . '/' . $slide->slug);?>"><?=$slide->post_title;?></a></h4>
						<p><?=substr(strip_tags($slide->post_content), 0, 140);?>...</p>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<?php } ?>
	<div class="widget">
		<div class="tab_block">
			<ul class="tabs clearfix">
				<li><a href="javascript:void(0);" class="defaulttab selected" rel="pengumuman">PENGUMUMAN</a></li>
				<li><a class="" href="javascript:void(0);" rel="sekilas_info">SEKILAS INFO</a></li>
			</ul>
			<div style="display: block;" class="tab-content" id="pengumuman">
				<ul class="post-list">
					<?php foreach ($pengumuman->result() as $p) { ?>
					<li class="clearfix">
						<?php if ($p->post_image != NULL && file_exists('assets/post/thumb/' . $p->post_image)) {?>
							<img width="150px" height="100px" src="<?=base_url('assets/post/thumb/' . $p->post_image);?>" alt="<?=$p->post_title;?>"/>
						<?php } else {?>
							<img src="<?=base_url('assets/70x70.gif');?>" alt="<?=$p->post_title;?>"/>
						<?php } ?>
						<h4><a href="<?=site_url('home/readmore/' . $p->post_id . '/' . $p->slug);?>"><?=$p->post_title;?></a></h4>
						<p><?=substr(strip_tags($p->post_content), 0, 50);?>...</p>
						<span class="timestamp-white"><?=indo_date($p->post_date);?></span>
					</li>
					<?php } ?>
				</ul>
			</div>
			<div style="display: none;" class="tab-content" id="sekilas_info">
				<ul class="post-list">
					<?php foreach ($sekilas_info->result() as $info) {?>
					<li class="clearfix">
						<h4><a href="<?=site_url('home/readmore/' . $info->post_id);?>"><?=$info->post_title;?></a></h4>
						<p><?=substr($info->post_content, 0, 250);?>...</p>
						<span class="timestamp-white"><?=indo_date($info->post_date);?></span>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="widget-title">
		<h4><i class="icon-file"></i> BERITA LAINNYA</h4>
	</div>
	<div class="widget">
		<ul class="post-list">
			<?php foreach ($more_post->result() as $more) { ?>
			<li class="clearfix">
				<?php if ($more->post_image != NULL && file_exists('assets/post/thumb/' . $more->post_image)) {?>
					<img width="150px" src="<?=base_url('assets/post/thumb/' . $more->post_image);?>" alt="<?=$more->post_title;?>"/>
				<?php } else {?>
					<img src="<?=base_url('assets/70x70.gif');?>" alt="<?=$more->post_title;?>"/>
				<?php } ?>
				<h4><a href="<?=site_url('home/readmore/' . $more->post_id . '/' . $more->slug);?>"><?=$more->post_title;?></a></h4>
				<p><?=substr(strip_tags($more->post_content), 0, 50);?>...</p>
				<span class="timestamp"><?=indo_date($more->post_date);?></span>
			</li>
			<?php } ?>
		</ul>
	</div>
	<?php if ($video->num_rows() == 1) {$result_video = $video->row();?>
	<div class="widget-title">
		<h4><i class="icon-film"></i> VIDEO TERBARU</h4>
	</div>
	<div class="widget">
		<ul class="post-list">
			<li class="clearfix">
				<iframe width="430px" height="auto" src="https://www.youtube.com/embed/<?=$result_video->unique_id;?>" frameborder="0" allowfullscreen></iframe>
				<p align="justify"><?=$result_video->title;?></p>
			</li>
		</ul>
	</div>
	<?php } ?>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-primary');?>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>