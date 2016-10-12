<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section id="main-content" class="home">
	<div class="widget-title">
		<h4><?=$title;?><i class="fa fa-film"></i></h4>
	</div>
	<div class="widget">
		<?php if ($query->num_rows() > 0) {?>
			<?php foreach ($query->result() as $row) {?>
				<p><?=$row->title;?></p>
				<iframe class="livevideo" src="https://www.youtube.com/embed/<?=$row->unique_id;?>" frameborder="0" allowfullscreen></iframe>
				<hr>
			<?php } ?>
		<?php if ($total_rows > 1) {?>
		<div class="pagination">
			<ul class="clearfix" style="float:left">
				<?=$pagination;?>
			</ul>
		</div>
		<?php } ?>
		<?php } else {?>
			<div class="alert alert-info">
				Video tidak ditemukan !
			</div>
		<?php } ?>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>