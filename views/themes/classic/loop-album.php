<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section id="main-content">
	<div class="widget-title">
		<h4><i class="icon-picture"></i> <?=$title;?></h4>
	</div>
	<div class="widget">
		<?php if ($query->num_rows() > 0) {?>
		<ul class="post-list">
			<?php foreach ($query->result() as $row) {?>
			<li class="clearfix">
				<h5 style="padding-bottom:10px;"><a href="<?=site_url('home/photo/' . $row->album_id);?>"><?=strtoupper($row->album);?> <span style="float:right;"><i class="icon-picture"></i> <?=$row->jumlah;?> PHOTO</span></a></h5>
			</li>
			<?php } ?>
		</ul>
		<?php if ($total_rows > 20) {?>
		<div class="pagination">
			<ul class="clearfix" style="float:left">
				<?=$pagination;?>
			</ul>
		</div>
		<?php } ?>
		<?php } else {?>
			<div class="alert alert-info">
				Album tidak ditemukan !
			</div>
		<?php } ?>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>