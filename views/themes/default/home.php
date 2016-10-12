<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section id="main-content" class="homepage eh">
	<?php if ($silder->num_rows() > 0) { ?>
	<div id="image-slider" class="clearfix">
		<div id="slider" class="flexslider">
				<ul class="slides">
				<?php foreach ($silder->result() as $slide) { ?>
				<li>
					<?php if ($slide->post_image != NULL && file_exists('assets/post/' . $slide->post_image)) {?>
						<img src="<?=base_url('assets/post/' . $slide->post_image);?>" alt="<?=$slide->post_title;?>"/>
					<?php } else {?>
						<img src="<?=base_url('assets/430x430.gif');?>" alt="<?=$slide->post_title;?>"/>
					<?php } ?>
					<div class="content">
						<h4><a href="<?=site_url('home/readmore/' . $slide->post_id . '/' . $slide->slug);?>"><?=$slide->post_title;?></a></h4>
						<p><?=substr(strip_tags($slide->post_content), 0, 200);?>...</p>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<?php } ?>
	<section id="sub-bar" class="container">
		<ul id="news-ticker">
			<?php foreach ($motivation->result() as $motivasi) {?>
			<li>"...<?=$motivasi->content;?>..." - <span><?=$motivasi->author;?></span></li>
			<?php } ?>
		</ul>
	</section>
	<div id="sekolahku" class="clearfix">
	    <div class="kepsek">
		    <?php if ($this->uri->segment(2) != 'why_robotic') { ?>
				<?php if ($kepsek['photo'] != NULL) {?>
					<img title="<?=$kepsek['nama'];?>" src="<?=base_url('assets/ptk/'.$kepsek['photo']);?>" alt="image"/>
			    <?php } ?>
			    <h4><i class="fa fa-microphone"></i> <?=$menu['why_robotic'] == '' ? 'Mengapa Harus Robotic?' : $menu['why_robotic'];?></h4>
				<p><?=strip_tags(substr($this->setting['why_robotic'], 0, 280));?>...</p>
				<div class="kep-more">
					<a class="more" href="<?=site_url('home/why_robotic');?>">Selengkapnya <i class="fa fa-angle-right"></i></a>
				</div>
		    <?php } ?>
		</div>
	    <div class="poll">
		    <h4><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i> <?=$menu['jajak_pendapat'] == '' ? 'JAJAK PENDAPAT' : $menu['jajak_pendapat'];?></h4>
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
				    <button id="submit-polling" type="submit" value="submit" name="submit">SUBMIT</button> <a class="jawaban" href="<?=site_url('home/result_polling');?>">Lihat Jawaban</a>
		        </div>
			<?=form_close();?>
	    </div>
	</div>
	<div style="clear: both;"></div>
	<div class="information">
		<div class="info-block clearfix">
			<div id="sekilas_info">
				<h3 class="info">SEKILAS INFO <i class="fa fa-comment"></i></h3>
				<div class="infose">
					<?php foreach ($sekilas_info->result() as $info) {?>
					<div class="isiinfo clearfix">
						<h4><a href="<?=site_url('home/readmore/' . $info->post_id);?>"><?=$info->post_title;?></a></h4>
						<p><strong><i class="fa fa-calendar"></i> <?=indo_date($info->post_date);?></strong> - <?=substr($info->post_content, 0, 200);?>...<a href="<?=site_url('home/readmore/' . $info->post_id . '/' . $info->slug);?>"><em>Selengkapnya</em></a></p>
						
					</div>
					<?php } ?>
				</div>
			</div>
			<div id="pengumuman">
			    <h3 class="info">PENGUMUMAN <i class="fa fa-bullhorn"></i></h3>
				<div class="list-peng">
					<?php foreach ($pengumuman->result() as $p) { ?>
					<div class="peng clearfix">
						<?php if ($p->post_image != NULL && file_exists('assets/post/thumb/' . $p->post_image)) {?>
							<img src="<?=base_url('assets/post/thumb/' . $p->post_image);?>" alt="<?=$p->post_title;?>"/>
						<?php } else {?>
							<img src="<?=base_url('assets/70x70.gif');?>" alt="<?=$p->post_title;?>"/>
						<?php } ?>
						<h4><a href="<?=site_url('home/readmore/' . $p->post_id . '/' . $p->slug);?>"><?=$p->post_title;?></a></h4>
						<p><strong><i class="fa fa-calendar"></i> <?=indo_date($p->post_date);?></strong> - <?=substr(strip_tags($p->post_content), 0, 150);?>..<a href="<?=site_url('home/readmore/' . $p->post_id . '/' . $p->slug);?>"><em>Selengkapnya</em></a></p>
					</div>
					<?php } ?>
				</div>
			</div>
			<div id="prestasi">	
				<h3 class="info">BERITA LAINNYA <i class="fa fa-sticky-note"></i></h3>
				<div class="list-peng">
			        <?php foreach ($more_post->result() as $more) { ?>
			        <div class="peng clearfix">
						<?php if ($more->post_image != NULL && file_exists('assets/post/thumb/' . $more->post_image)) {?>
					        <img src="<?=base_url('assets/post/thumb/' . $more->post_image);?>" alt="<?=$more->post_title;?>"/>
				        <?php } else {?>
					        <img src="<?=base_url('assets/70x70.gif');?>" alt="<?=$more->post_title;?>"/>
				        <?php } ?>
				        <h4><a href="<?=site_url('home/readmore/' . $more->post_id . '/' . $more->slug);?>"><?=$more->post_title;?></a></h4>
				        <p><i class="fa fa-calendar"></i> - <?=indo_date($more->post_date);?> - <?=substr(strip_tags($more->post_content), 0, 150);?>...<a href="<?=site_url('home/readmore/' . $more->post_id . '/' . $more->slug);?>"><em>Selengkapnya</em></a></p>
			        </div>
			        <?php } ?>
		        </div>
		    </div>
	    </div>
	</div>
	<div class="galeria">
	    <h4><i class="fa fa-camera head"></i> PHOTO GALERI <a href="<?=site_url('home/album');?>">LIHAT GALERI <i class="fa fa-angle-right"></i></a></h4>
	    <div>
	        <ul id="galeria-img" class="clearfix">
				<?php foreach ($recent_photo->result() as $photo) { ?>
				<li>
					<div>
						<a href="<?=base_url('assets/gallery/' . $photo->photo_original);?>" rel="prettyPhoto[gallery-footer]" class="tips" original-title="<?=$photo->photo_title;?>"><img src="<?=base_url('assets/gallery/thumb/' . $photo->photo_thumb);?>" alt="<?=$photo->photo_title;?>"></a>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</section>