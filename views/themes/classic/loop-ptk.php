<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url('views/themes/classic/assets/moodal/js/bootstrap.js');?>"></script>
<link href="<?=base_url('views/themes/classic/assets/moodal/css/bootstrap.css');?>" rel="stylesheet">
<section id="main-content">
	<div class="widget-title">
		<h4><i class="icon-user"></i> <?=$title;?></h4>
	</div>
	<div class="widget">
		<?php if ($query->num_rows() > 0) { ?>
		<table class="table">
			<thead>
				<th>NO</th>
				<th>NIK</th>
				<th>NIP</th>
				<th>NUPTK</th>
				<th>NAMA</th>
				<th>JENIS KELAMIN</th>
				<th>&nbsp;</th>
			</thead>
			<tbody>
				<?php $no = ($this->uri->segment(3) ? ($this->uri->segment(3) + 1) : 1);foreach ($query->result() as $row) {?>
				<tr>
					<td><?=$no;?></td>
					<td><?=$row->nik;?></td>
					<td><?=$row->nip;?></td>
					<td><?=$row->nuptk;?></td>
					<td><?=$row->nama;?></td>
					<td><?=$row->jenis_kelamin;?></td>
					<td>
						<a href="" data-toggle="modal" data-target="#<?=$row->id;?>"><i class="icon-zoom-in"></i></a>
					</td>
				</tr>
				<div class="modal fade" id="<?=$row->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h3 style="padding-left:10px;font-weight:bold;">BIODATA PTK</h3>
				      </div>
				      <div class="modal-body">
			      			<ul class="post-list">
					        	<li class="clearfix">
					        		<div class="left-columns">
						      			<?php if ($row->photo != NULL && file_exists('./assets/ptk/' . $row->photo)) {?>
				                        <img style="margin-top:3px;" src="<?=base_url('assets/ptk/' . $row->photo);?>">
				                        <?php } else {?>
				                        <img style="margin-top:3px;" src="<?=base_url('assets/user.jpg');?>">
				                        <?php } ?>
						      		</div>
						      		<div class="right-columns">
					        		<p>
					        			<b>NIK</b> : <?=$row->nik;?>
					        			<br>
					        			<b>NIP</b> : <?=$row->nip;?>
					        			<br>
					        			<b>NUPTK</b> : <?=$row->nuptk;?>
					        			<br>
					        			<b>Status Kepegawaian</b> : <?=status_kepegawaian($row->status_kepegawaian);?>
					        			<br>
					        			<b>Jenis PTK</b> : <?=jenis_ptk($row->jenis_ptk);?>
					        			<br>
					        			<b>Nama</b> : <?=$row->nama;?>
					        			<br>
					        			<b>Jenis kelamin</b> : <?=$row->jenis_kelamin;?>
					        			<br>
					        			<b>Alamat</b> : <?=$row->alamat;?>
					        			<br>
					        			<b>Telp</b> : <?=$row->telp;?>
					        			<br>
					        			<b>Email</b> : <?=$row->email;?>
					        			<br>
					        			<b>Tempat, tanggal lahir</b> : <?=$row->tempat_lahir;?>, <?=$row->tanggal_lahir != '0000-00-00' ? ', ' . indo_date($row->tanggal_lahir) : '';?>
					        			<br>
					        			<b>Pendidikan Terakhir</b> : <?=pendidikan($row->pendidikan);?>
					        			<br>
					        			<b>Jurusan</b> : <?=$row->jurusan;?>
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

		<?php if ($total_rows > 20) { ?>
		<div class="pagination">
			<ul class="clearfix" style="float:left">
				<?=$pagination;?>
			</ul>
		</div>
		<?php } ?>
		<?php } else { ?>
			<div class="alert alert-info">
				Data Pendidik dan Tenaga Kependidikan tidak ditemukan !
			</div>
		<?php } ?>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>