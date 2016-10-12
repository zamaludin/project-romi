<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section id="main-content" class="home eh">
	<div class="widget-title">
		<h4><i class="icon-check"></i> <?=$title;?></h4>
	</div>
	<div class="widget" style="margin-top:1px;">
		<ul class="post-list">
			<li class="clearfix">
				<?php if ($kepsek['photo'] != '' && file_exists('./assets/ptk/' . $kepsek['photo'])) {?>
				<img src="<?=base_url('assets/ptk/' . $kepsek['photo']);?>" alt="Mengapa Harus Robotik"/>
				<?php } ?>
				<h4><?=$kepsek['nama'];?></h4>
				<?=$this->setting['why_robotic'];?>
			</li>
		</ul>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-primary');?>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>