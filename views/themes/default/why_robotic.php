<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section id="main-content" class="home kepala">
	<div class="widget-title">
		<h4><?=$title;?> <i class="fa fa-microphone"></i></h4>
	</div>
	<div class="widget" style="margin-top:1px;">
		<ul class="post-list">
			<li class="clearfix">
				<?php if ($kepsek['photo'] != '' && file_exists('./assets/ptk/' . $kepsek['photo'])) {?>
				<img src="<?=base_url('assets/ptk/' . $kepsek['photo']);?>" alt="Mengapa Harus Robotic?"/>
				<?php } ?>
				<h4><?=$kepsek['nama'];?></h4>
				<?=$this->setting['why_robotic'];?>
			</li>
		</ul>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>