<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section id="main-content" class="home eh">
	<div class="widget-title">
		<h4><i class="icon-check"></i> <?=$title;?></h4>
	</div>
	<div class="widget" style="margin-top:1px;">
		<ul class="post-list">
			<li class="clearfix">
				<?php if ($query['post_image'] != NULL && file_exists('assets/post/' . $query['post_image'])) {?>
				<img width="430px" src="<?=base_url('assets/post/' . $query['post_image']);?>" alt="<?=$query['post_title'];?>"/>
				<?php } ?>
				<h4><?=$query['post_title'];?></h4>
				<span class="timestamp"><?=indo_date($query['post_date']);?></span>
				<span class="author"><?=$query['display_name'];?></span>
				<span class="view"> Dibaca : <?=$query['counter'];?> Kali</span>
				<br><br>
				<?=$query['post_content'];?>
			</li>
		</ul>
	</div>

	<div class="widget-title">
		<h4><i class="icon-check"></i> KOMENTAR</h4>
		<ul class="post-list">
			<li>
				<div class="fb-comments" data-href="<?=current_url();?>" data-width="450" data-numposts="5"></div>
			</li>
		</ul>
	</div>

	<?php if ($more->num_rows() > 0) { ?>
	<div class="widget-title">
		<h4><i class="icon-check"></i> <?=$title;?> LAINNYA</h4>
		<?php if (isset($indeks)) {?>
		<span class="views-all"><a href="<?=$indeks;?>">Indeks</a></span>
		<?php } ?>
	</div>
	<div class="widget">
		<ul class="post-list">
			<?php foreach ($more->result() as $lainnya) {
	      echo '<li class="clearfix" style="border:none;">';
	      echo anchor('home/readmore/' . $lainnya->post_id . '/' . $lainnya->slug, $lainnya->post_title);
	      echo '</li>';
		   } ?>
		</ul>
	</div>
	<?php } ?>

</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-primary');?>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>