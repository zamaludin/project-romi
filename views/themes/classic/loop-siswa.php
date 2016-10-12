<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url('views/themes/classic/assets/moodal/js/bootstrap.js');?>"></script>
<link href="<?=base_url('views/themes/classic/assets/moodal/css/bootstrap.css');?>" rel="stylesheet">
<section id="main-content">
	<div class="widget-title">
		<h4><i class="icon-user"></i> <?=$title;?></h4>
	</div>
	<div class="widget">
		<div class="form-wrapper">
			<form method="POST" action="<?=site_url('home/redirect_kelas');?>">
				<ol class="form">
					<li>
						<select style="width:auto;" name="kelas_id" onChange='this.form.submit()'>
							<option value="">Kelas :</option>
							<?php
							foreach ($q_kelas->result() as $kelas) {
							   echo '<option value="';
							   echo $kelas->kelas_id;
							   if ($this->uri->segment(3) == $kelas->kelas_id) {
							      echo '"selected>';
							   } else {
							      echo '">';
							   }
							   echo $kelas->kelas;
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
				if ($this->uri->segment(2) == 'siswa') {
			      $no = $this->uri->segment(3) == FALSE ? 1 : $this->uri->segment(3) + 1;
			   } else if ($this->uri->segment(2) == 'kelas') {
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
				        <h3 style="padding-left:10px;font-weight:bold;">BIODATA SISWA</h3>
				      </div>
				      <div class="modal-body">
			      			<ul class="post-list">
					        	<li class="clearfix">
					        		<div class="left-columns" style="min-height:450px;">
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
										<b>Kelas</b> : <?=$row->kelas;?>
										<br>
										<b>Status Siswa</b> : <?=$row->status_siswa;?>
										<br>
										<b>Tempat, Tanggal lahir</b> : <?=$row->tempat_lahir;?>, <?=$row->tanggal_lahir != '0000-00-00' ? ', ' . indo_date($row->tanggal_lahir) : '';?>
										<br>
										<b>Jenis Kelamin</b> : <?=$row->jenis_kelamin;?>
										<br>
										<b>Agama</b> : <?=$row->agama;?>
										<br>
										<b>Status Anak</b> : <?=$row->status_anak;?>
										<br>
										<b>Anak ke</b> : <?=$row->anak_ke;?>
										<br>
										<b>Alamat</b> : <?=$row->alamat;?>
										<br>
										<b>Telp Rumah</b> : <?=$row->telp_rumah;?>
										<br>
										<b>Sekolah Asal</b> : <?=$row->sekolah_asal;?>
										<br>
										<b>Diterima Dikelas</b> : <?php echo $row->dikelas;?>
										<br>
										<b>Pada Tanggal</b> : <?=$row->pada_tanggal == '0000-00-00' ? '' : indo_date($row->pada_tanggal);?>
										<br>
										<b>Nama Ayah</b> : <?=$row->ayah;?>
										<br>
										<b>Nama Ibu</b> : <?=$row->ibu;?>
										<br>
										<b>Alamat Orang Tua</b> : <?=$row->alamat_ortu;?>
										<br>
										<b>Telepon Orang Tua</b> : <?=$row->telp_ortu;?>
										<br>
										<b>Pekerjaan Ayah</b> : <?=$row->pekerjaan_ayah;?>
										<br>
										<b>Pekerjaan Ibu</b> : <?=$row->pekerjaan_ibu;?>
										<br>
										<b>Nama Wali</b> : <?=$row->nama_wali;?>
										<br>
										<b>Alamat Wali</b> : <?=$row->alamat_wali;?>
										<br>
										<b>Telp Wali</b> : <?=$row->telp_wali;?>
										<br>
										<b>Pekerjaan Wali</b> : <?=$row->pekerjaan_wali;?>
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
				<?php $no++;} ?>
			</tbody>
		</table>

		<?php if ($total_rows > 20) { ?>
		<div class="pagination">
			<ul class="clearfix" style="float:left">
				<?=$pagination;?>
			</ul>
		</div>
		<?php } ?>
		<?php } else {?>
			<div class="alert alert-info">
				Data siswa tidak ditemukan !
			</div>
		<?php } ?>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>