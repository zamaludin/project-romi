<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<aside id="aside-secondary">
	 <?php if ($this->uri->segment(2) != 'why_robotic') { ?>
	 <div class="widget-title">
		  <h4><i class="icon-comment icon-white"></i> <?=$menu['why_robotic'] == '' ? 'Mengapa Harus Robotic?' : $menu['why_robotic'];?></h4>
	 </div>
	 <div class="widget">
		  <ul class="post-list">
				<li class="clearfix" style="padding:0;text-align:justify;">
					 <?php if ($kepsek['photo'] != NULL) {?>
					 <img width="120" title="<?=$kepsek['nama'];?>" src="<?=base_url('assets/ptk/' . $kepsek['photo']);?>" alt="image" style="margin-top:0;"/>
					 <?php } ?>
					 <?=strip_tags(substr($this->setting['why_robotic'], 0, 500));?>...
					 <a href="<?=site_url('home/why_robotic');?>">[selengkapnya]</a>
				</li>
		  </ul>
	 </div>
	 <?php } ?>
	 <div class="widget-title">
		  <h4><i class="icon-question-sign icon-white"></i> <?=$menu['jajak_pendapat'] == '' ? 'JAJAK PENDAPAT' : $menu['jajak_pendapat'];?></h4>
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
				<br>
				<button id="submit-polling" type="submit" value="submit" name="submit" class="btn btn-small btn-default">SUBMIT</button>
		  <?=form_close();?>
		  <br>
		  <a href="<?=site_url('home/result_polling');?>">Lihat Jawaban</a>
	 </div>
	 <?php if ($banner->num_rows() > 0) { ?>
	 <div class="widget-title">
		  <h4><i class="icon-picture icon-white"></i> <?=$menu['banner'] == '' ? 'BANNER' : $menu['banner'];?></h4>
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
	 <div class="widget-title">
		  <h4><i class="icon-question-sign icon-white"></i> TEMUKAN KAMI DI FACEBOOK</h4>
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