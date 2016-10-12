<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url('views/themes/classic/assets/moodal/js/bootstrap.js');?>"></script>
<link href="<?=base_url('views/themes/classic/assets/moodal/css/bootstrap.css');?>" rel="stylesheet">
<section id="main-content">
	<div class="widget-title">
		<h4><i class="icon-user"></i> <?=$title;?></h4>
	</div>
	<div class="widget">
		<div class="form-wrapper">
			<form method="POST" action="<?=site_url('home/redirect_tahun_lulus');?>">
				<ol class="form">
					<li>
						<select style="width:auto;" name="tahun_lulus" onChange='this.form.submit()'>
							<option value="">Tahun Lulus :</option>
							<?php
							foreach ($tahun_lulus->result() as $tahun) {
							   echo '<option value="';
							   echo $tahun->tahun_lulus;
							   if ($this->uri->segment(3) == $tahun->tahun_lulus) {
							      echo '"selected>';
							   } else {
							      echo '">';
							   }
							   echo $tahun->tahun_lulus;
							   echo '</option>';
							}
							?>
						</select>
					</li>
				</ol>
			</form>
		</div>
		<?php if ($query->num_rows() > 0) { ?>
		<table class="table">
			<thead>
				<th>NO</th>
				<th>NISN</th>
				<th>NAMA</th>
				<th>JENIS KELAMIN</th>
				<th>&nbsp;</th>
			</thead>
			<tbody>
				<?php
				if ($this->uri->segment(2) == 'alumni') {
			      $no = $this->uri->segment(3) == FALSE ? 1 : $this->uri->segment(3) + 1;
			   } else if ($this->uri->segment(2) == 'tahun_lulus') {
			      $no = $this->uri->segment(4) == FALSE ? 1 : $this->uri->segment(4) + 1;
			   }
			   ?>

				<?php foreach ($query->result() as $row) { ?>
				<tr>
					<td><?=$no;?></td>
					<td><?=$row->nisn;?></td>
					<td><?=$row->nama;?></td>
					<td><?=$row->jenis_kelamin;?></td>
					<td>
						<a href="" data-toggle="modal" data-target="#<?=$row->nisn;?>"><i class="icon-zoom-in"></i></a>
					</td>
				</tr>
				<div class="modal fade" id="<?=$row->nisn;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h3 style="padding-left:10px;font-weight:bold;">BIODATA ALUMNI</h3>
				      </div>
				      <div class="modal-body">
			      			<ul class="post-list">
					        	<li class="clearfix">
					        		<div class="left-columns" style="min-height:200px;">
						      			<?php if ($row->photo != NULL && file_exists('./assets/siswa/' . $row->photo)) {?>
				                        <img style="margin-top:3px;" src="<?=base_url('assets/siswa/' . $row->photo);?>">
				                        <?php } else {?>
				                        <img style="margin-top:3px;" src="<?=base_url('assets/user.jpg');?>">
				                        <?php } ?>
						      		</div>
						      		<div class="right-columns">
					        		<p>
					        			<b>NISN</b> : <?=$row->nisn;?>
					        			<br>
										<b>Nama</b> : <?=$row->nama;?>
										<br>
										<b>Tempat, Tanggal lahir</b> : <?=$row->tempat_lahir;?>, <?=$row->tanggal_lahir != '0000-00-00' ? ', ' . indo_date($row->tanggal_lahir) : '';?>
										<br>
										<b>Jenis Kelamin</b> : <?=$row->jenis_kelamin;?>
										<br>
										<b>Agama</b> : <?=$row->agama;?>
										<br>
										<b>Alamat</b> : <?=$row->alamat;?>
										<br>
										<b>Telp</b> : <?=$row->telp_rumah;?>
										<br>
										<b>Tahun Lulus</b> : <?=$row->tahun_lulus;?>
										<br>
										<b>Aktivitas Sekarang</b> : <?=$row->aktivitas_sekarang;?>
										<br>
										<b>PIN BB</b> : <?=$row->pin_bb;?>
										<br>
										<b>Facebook</b> : <?=$row->facebook;?>
										<br>
										<b>Twitter</b> : <?=$row->twitter;?>
					        		</p>
					        		</div>
					        	</li>
					        </ul>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">X</button>
				      </div>
				    </div>
				  </div>
				</div>
				<?php $no++; } ?>
			</tbody>
		</table>

		<?php if ($total_rows > 20) {?>
		<div class="pagination">
			<ul class="clearfix" style="float:left">
				<?=$pagination;?>
			</ul>
		</div>
		<?php } ?>
		<?php } else {?>
			<div class="alert alert-info">
				Data alumni tidak ditemukan !
			</div>
		<?php } ?>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>