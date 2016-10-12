<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section id="main-content">
	<div class="widget-title">
		<h4><i class="icon-user"></i> <?=strtoupper($title);?></h4>
	</div>
	<div class="widget">
		<?=$alert;?>
        <?=form_open_multipart('#', array('role' => 'form', 'class' => 'my-style'));?>
		    <h1>
		        <span><i class="icon-edit"></i>  Data Pendaftaran</span>
		    </h1>
		    <label>
		        <span>Nomor Pendaftaran :</span>
		        <input readonly type="text" value="<?=$query['no_daftar'];?>"/>
		    </label>
		    <label>
		        <span>Tanggal Pendaftaran :</span>
		        <input readonly type="text" value="<?=indo_date($query['tanggal_daftar']);?>"/>
		    </label>
		    <label>
		        <span>Jalur Pendaftaran :</span>
		        <input readonly type="text" value="<?=$query['jalur_pendaftaran'];?>"/>
		    </label>
		    <label>
		        <span>Pilihan I :</span>
		        <input readonly type="text" value="<?=$query['pilihan_satu'];?>"/>
		    </label>
		    <label>
		        <span>Pilihan II :</span>
		        <input readonly type="text" value="<?=$query['pilihan_dua'];?>"/>
		    </label>
		    <label>
		        <span>Sekolah Asal :</span>
		        <input readonly type="text" value="<?=$query['sekolah_asal'];?>"/>
		    </label>
		    <label>
		        <span>NISN :</span>
		        <input readonly type="text" value="<?=$query['nisn'];?>"/>
		    </label>
		    <br>
		    <h1>
		        <span><i class="icon-edit"></i> Data Calon Peserta Didik Baru</span>
		    </h1>
		    <label>
		        <span>Nama Lengkap :</span>
		        <input readonly type="text" value="<?=$query['nama'];?>"/>
		    </label>
		    <label>
		        <span>Tempat Lahir :</span>
		        <input readonly type="text" value="<?=$query['tempat_lahir'];?>"/>
		    </label>
		    <label>
		        <span>Tanggal Lahir :</span>
		        <input readonly type="text" value="<?=indo_date($query['tanggal_lahir']);?>"/>
		    </label>
		    <label>
		        <span>Jenis Kelamin :</span>
		        <input readonly type="text" value="<?=$query['jenis_kelamin'];?>"/>
		    </label>
		    <label>
		        <span>Agama :</span>
		        <input readonly type="text" value="<?=$query['agama'];?>"/>
		    </label>
		    <label>
		        <span>Status Anak :</span>
		        <input readonly type="text" value="<?=$query['status_anak'];?>"/>
		    </label>
		    <label>
		        <span>Anak Ke :</span>
		        <input readonly type="text" value="<?=$query['anak_ke'];?>"/>
		    </label>
		    <label>
		        <span>Alamat :</span>
		        <textarea readonly name="alamat"><?=$query['alamat'];?></textarea>
		    </label>
		    <label>
		        <span>Telepon :</span>
		        <input readonly type="text" value="<?=$query['telp_rumah'];?>"/>
		    </label>
		    <label>
		        <span>Email :</span>
		        <input readonly type="text" value="<?=$query['email'];?>"/>
		    </label>
		    <label>
		        <span>Photo :</span>
		        <img src="<?=base_url('assets/siswa/' . $query['photo']);?>">
		    </label>
		    <br>
		    <h1>
		        <span><i class="icon-edit"></i> Data Orang Tua/Wali</span>
		    </h1>
		    <label>
		        <span>Nama Ayah :</span>
		        <input readonly type="text" value="<?=$query['ayah'];?>"/>
		    </label>
		    <label>
		        <span>Nama Ibu :</span>
		        <input readonly type="text" value="<?=$query['ibu'];?>"/>
		    </label>
		    <label>
		        <span>Alamat Orang Tua :</span>
		        <input readonly type="text" value="<?=$query['alamat_ortu'];?>"/>
		    </label>
		    <label>
		        <span>Telepon Orang Tua :</span>
		        <input readonly type="text" value="<?=$query['telp_ortu'];?>"/>
		    </label>
		    <label>
		        <span>Pekerjaan Ayah :</span>
		        <input readonly type="text" value="<?=$query['pekerjaan_ayah'];?>"/>
		    </label>
		    <label>
		        <span>Pekerjaan Ibu :</span>
		        <input readonly type="text" value="<?=$query['pekerjaan_ibu'];?>"/>
		    </label>
		    <label>
		        <span>Nama Wali :</span>
		        <input readonly type="text" value="<?=$query['nama_wali'];?>"/>
		    </label>
		    <label>
		        <span>Alamat Wali :</span>
		        <input readonly type="text" value="<?=$query['alamat_wali'];?>"/>
		    </label>
		    <label>
		        <span>Telepon Wali :</span>
		        <input readonly type="text" value="<?=$query['telp_wali'];?>"/>
		    </label>
		    <label>
		        <span>Pekerjaan Wali :</span>
		        <input readonly type="text" value="<?=$query['pekerjaan_wali'];?>"/>
		    </label>
		    <label class="submit">
		    	<br><br>
		        <span>&nbsp;</span>
		        <a href="<?=site_url('ppdb/cetak/index/' . $this->uri->segment(4));?>" target="_blank" class="button">CETAK FORMULIR</a>
		        <a href="<?=site_url('ppdb/registration/update/' . $this->uri->segment(4));?>" class="warning">PERBAIKI DATA</a>
		        <br><br>
		    </label>
		</form>

	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>