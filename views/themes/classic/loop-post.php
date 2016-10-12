<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section id="main-content" class="home">
	<div class="widget-title">
		<h4><i class="icon-check"></i> <?=$title;?></h4>
	</div>
	<div class="widget" style="margin-top:1px;">
		<?php if ($query->num_rows() > 0) { ?>
		<ul class="post-list">
			<?php foreach ($query->result() as $row) {?>
			<li class="clearfix">
				<?php if ($this->uri->segment(2) == 'post' || $this->uri->segment(2) == 'category') {?>
					<?php if ($row->post_image != NULL && file_exists('assets/post/thumb/' . $row->post_image)) {?>
						<img width="150px" height="150px" src="<?=base_url('assets/post/thumb/' . $row->post_image);?>" alt="<?=$row->post_title;?>"/>
					<?php } else {?>
						<img width="150px" height="150px" src="<?=base_url('assets/190x190.gif');?>" alt="<?=$row->post_title;?>"/>
					<?php } ?>
				<?php } else if ($this->uri->segment(2) == 'archive') {?>
					<?php if ($row->post_image != NULL && file_exists('assets/post/thumb/' . $row->post_image)) {?>
						<img width="150px" height="150px" src="<?=base_url('assets/post/thumb/' . $row->post_image);?>" alt="<?=$row->post_title;?>"/>
					<?php } else {?>
						<img src="<?=base_url('assets/190x190.gif');?>" alt="<?=$row->post_title;?>"/>
					<?php } ?>
				<?php } else if ($this->uri->segment(2) == 'pengumuman') {?>
					<?php if ($row->post_image != NULL && file_exists('assets/post/' . $row->post_image)) {?>
						<img width="150px" height="150px" src="<?=base_url('assets/post/' . $row->post_image);?>" alt="<?=$row->post_title;?>"/>
					<?php } else {?>
						<img width="150px" height="150px" src="<?=base_url('assets/190x190.gif');?>" alt="<?=$row->post_title;?>"/>
					<?php } ?>
				<?php } ?>

				<h4><a href="<?=site_url('home/readmore/' . $row->post_id . '/' . $row->slug);?>"><?=$row->post_title;?></a></h4>
				<span class="timestamp"><?=substr($row->post_date, 8, 2);?> <?=bulan(substr($row->post_date, 5, 2), 'S');?> <?=substr($row->post_date, 0, 4);?></span>
				<span class="author"><?=$row->display_name;?></span>
				<br><br>
				<?php if ($this->uri->segment(2) == 'post' || $this->uri->segment(2) == 'category') {?>
					<p><?=substr($row->post_content, 0, 245);?>...</p>
				<?php } else if ($this->uri->segment(2) == 'pengumuman') {?>
					<p><?=substr($row->post_content, 0, 245);?>...</p>
				<?php } else if ($this->uri->segment(2) == 'sekilas_info') {?>
					<p><?=substr($row->post_content, 0, 245);?>...</p>
				<?php } else if ($this->uri->segment(2) == 'archive') {?>
					<p><?=substr($row->post_content, 0, 245);?>...</p>
				<?php } ?>
			</li>
			<?php }?>
		</ul>
		<?php
		if ($this->uri->segment(2) == 'post') {
	      if ($total_rows > 5) {
	         echo '<div class="pagination">';
	         echo '<ul class="clearfix" style="float:left">';
	         echo $pagination;
	         echo '</ul>';
	         echo '</div>';
	      }
		} else {
	      if ($total_rows > 10) {
	         echo '<div class="pagination">';
	         echo '<ul class="clearfix" style="float:left">';
	         echo $pagination;
	         echo '</ul>';
	         echo '</div>';
	      }
	   } ?>
		<?php } else {?>
			<div class="alert alert-info">
			Data tidak ditemukan !
			</div>
		<?php } ?>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-primary');?>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>