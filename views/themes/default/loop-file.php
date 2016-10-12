<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section id="main-content">
	<div class="widget-title">
		<h4><?=$title;?> <i class="fa fa-file-text"></i></h4>
	</div>
	<div class="widget">
		<?php if ($query->num_rows() > 0) { ?>
		<table class="table">
			<tbody>
				<?php foreach ($query->result() as $row) { ?>
				<tr>
					<td>
						<?php
						$type = explode('.', $row->type);
				      $ext = $type[1] . '.png';
				      $file = file_exists('./views/themes/default/assets/icon/' . $ext) ? $ext : 'empty.png';
				      ?>
						<img width="30" src="<?=base_url('views/themes/default/assets/icon/' . $file);?>">
					</td>
					<td>
						<strong style="color:#ac5b00;font-size:14px;"><?=strtoupper($row->title);?></strong>
						<br>
						<strong>Tipe file : <?=strtoupper(str_replace('.', '', $row->type));?> - Diunduh sebanyak : <?=$row->counter;?> kali</strong>
						<br>
						<?=$row->description;?>
					</td>
					<td style="text-align:center;"><a href="<?=site_url('home/download_file/' . $row->id);?>" title="size : <?=$row->size;?> KB"><img width="30" src="<?=base_url('views/themes/default/assets/icon/download.png');?>"></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<?php if ($total_rows > 10) {?>
		<div class="pagination">
			<ul class="clearfix" style="float:left">
				<?=$pagination;?>
			</ul>
		</div>
		<?php } ?>
		<?php } else {?>
			<div class="alert alert-info">
				File tidak ditemukan !
			</div>
		<?php } ?>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>