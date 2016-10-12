<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.date.extensions.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.extensions.js');?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $("#tanggal_lahir").inputmask("yyyy-mm-dd", {"placeholder": "YYYY-MM-DD"});
    });
</script>
<section id="main-content">
	<div class="widget-title">
		<h4><?=strtoupper($title);?> <i class="fa fa-user"></i></h4>
	</div>
	<div class="widget">
		<?=$alert;?>
		<?php if ($this->setting['ppdb_status'] == 'open') { ?>
	        <?=form_open_multipart($action, array('role' => 'form', 'class' => 'my-style'));?>
				<h3>LENGKAPI FORMULIR BERIKUT<h3>
			    <h1>
			        <span><i class="icon-edit"></i>  Data Pendaftaran</span>
			    </h1>
			    <label>
			        <span>Jalur Pendaftaran :</span>
			        <?=form_dropdown('jalur_pendaftaran_id', $jalur, $this->uri->segment(3) == 'update' ? $query['jalur_pendaftaran_id'] : $this->input->post('jalur_pendaftaran_id'));?>
			    </label>
			    <label>
			        <span>Pilihan I :</span>
			        <?=form_dropdown('pilihan_1', $jurusan, $this->uri->segment(3) == 'update' ? $query['pilihan_1'] : $this->input->post('pilihan_1'));?>
			    </label>
			    <label>
			        <span>Pilihan II :</span>
			        <?=form_dropdown('pilihan_2', $jurusan, $this->uri->segment(3) == 'update' ? $query['pilihan_2'] : $this->input->post('pilihan_2'));?>
			    </label>
			    <label>
			        <span>Sekolah Asal :</span>
			        <input required value="<?=isset($query['sekolah_asal']) ? $query['sekolah_asal'] : set_value('sekolah_asal');?>" type="text" name="sekolah_asal"/>
			        <?=form_error('sekolah_asal');?>
			    </label>
			    <label>
			        <span>NISN :</span>
			        <input required value="<?=isset($query['nisn']) ? $query['nisn'] : set_value('nisn');?>" type="text" name="nisn"/>
			        <?=form_error('nisn');?>
			    </label>
			    <br>
			    <h1>
			        <span><i class="icon-edit"></i> Data Calon Peserta Didik Baru</span>
			    </h1>
			    <label>
			        <span>Nama Lengkap :</span>
			        <input required type="text" name="nama" value="<?=isset($query['nama']) ? $query['nama'] : set_value('nama');?>"/>
			        <?=form_error('nama');?>
			    </label>
			    <label>
			        <span>Tempat Lahir :</span>
			        <input required value="<?=isset($query['tempat_lahir']) ? $query['tempat_lahir'] : set_value('tempat_lahir');?>" type="text" name="tempat_lahir"/>
			        <?=form_error('tempat_lahir');?>
			    </label>
			    <label>
			        <span>Tanggal Lahir :</span>
			        <input id="tanggal_lahir" required placeholder="Tanggal lahir diisi dengan format : YYYY-MM-DD" value="<?=isset($query['tanggal_lahir']) ? $query['tanggal_lahir'] : set_value('tanggal_lahir');?>" type="text" name="tanggal_lahir"/>
			        <?=form_error('tanggal_lahir');?>
			    </label>
			    <label>
			        <span>Jenis Kelamin :</span>
			        <?=form_dropdown('jenis_kelamin', array('Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan'), isset($query['jenis_kelamin']) ? $query['jenis_kelamin'] : $this->input->post('jenis_kelamin'));?>
			    </label>
			    <label>
			        <span>Agama :</span>
			        <?=form_dropdown('agama', agama(), isset($query['agama']) ? $query['agama'] : $this->input->post('agama'));?>
			    </label>
			    <label>
			        <span>Status Anak :</span>
			        <?=form_dropdown('status_anak', status_anak(), isset($query['status_anak']) ? $query['status_anak'] : $this->input->post('status_anak'));?>
			    </label>
			    <label>
			        <span>Anak Ke :</span>
			        <input required value="<?=isset($query['anak_ke']) ? $query['anak_ke'] : set_value('anak_ke');?>" type="text" name="anak_ke"/>
			        <?=form_error('anak_ke');?>
			    </label>
			    <label>
			        <span>Alamat :</span>
			        <textarea required name="alamat"><?=isset($query['alamat']) ? $query['alamat'] : set_value('alamat');?></textarea>
			        <?=form_error('alamat');?>
			    </label>
			    <label>
			        <span>Telepon :</span>
			        <input required value="<?=isset($query['telp_rumah']) ? $query['telp_rumah'] : set_value('telp_rumah');?>" type="text" name="telp_rumah"/>
			        <?=form_error('telp_rumah');?>
			    </label>
			    <label>
			        <span>Email :</span>
			        <input value="<?=isset($query['email']) ? $query['email'] : set_value('email');?>" type="text" name="email"/>
			        <?=form_error('email');?>
			    </label>

			    <?php if ($this->uri->segment(3) == 'update') {?>
			    <label>
			        <span>Photo :</span>
			        <?php if ($this->uri->segment(3) == 'update' && file_exists('./assets/siswa/' . $query['photo'])) {?>
			        <img style="display:block;" src="<?=base_url('assets/siswa/' . $query['photo']);?>">
			        <?php } ?>
			    </label>
			    <label>
			        <span></span>
			        <input type="file" name="file">
			    </label>
			    <?php } else {?>
			    <label>
			        <span>Photo :</span>
			        <input required type="file" name="file">
			        <div class="block-error" style="color:#333;">Tipe file harus JPG dan ukuran maksimal photo 1 MB</div>
			    </label>
			    <?php } ?>

			    <br>
			    <h1>
			        <span><i class="icon-edit"></i> Data Orang Tua/Wali</span>
			    </h1>
			    <label>
			        <span>Nama Ayah :</span>
			        <input required value="<?=isset($query['ayah']) ? $query['ayah'] : set_value('ayah');?>" type="text" name="ayah"/>
			        <?=form_error('ayah');?>
			    </label>
			    <label>
			        <span>Nama Ibu :</span>
			        <input required value="<?=isset($query['ibu']) ? $query['ibu'] : set_value('ibu');?>" type="text" name="ibu"/>
			        <?=form_error('ibu');?>
			    </label>
			    <label>
			        <span>Alamat Orang Tua :</span>
			        <textarea required name="alamat_ortu"><?=isset($query['alamat_ortu']) ? $query['alamat_ortu'] : set_value('alamat_ortu');?></textarea>
			        <?=form_error('alamat_ortu');?>
			    </label>
			    <label>
			        <span>Telepon Orang Tua :</span>
			        <input required value="<?=isset($query['telp_ortu']) ? $query['telp_ortu'] : set_value('telp_ortu');?>" type="text" name="telp_ortu"/>
			        <?=form_error('telp_ortu');?>
			    </label>
			    <label>
			        <span>Pekerjaan Ayah :</span>
			        <input required value="<?=isset($query['pekerjaan_ayah']) ? $query['pekerjaan_ayah'] : set_value('pekerjaan_ayah');?>" type="text" name="pekerjaan_ayah"/>
			        <?=form_error('pekerjaan_ayah');?>
			    </label>
			    <label>
			        <span>Pekerjaan Ibu :</span>
			        <input value="<?=isset($query['pekerjaan_ibu']) ? $query['pekerjaan_ibu'] : set_value('pekerjaan_ibu');?>" type="text" name="pekerjaan_ibu"/>
			        <?=form_error('pekerjaan_ibu');?>
			    </label>
			    <label>
			        <span>Nama Wali :</span>
			        <input value="<?=isset($query['nama_wali']) ? $query['nama_wali'] : set_value('nama_wali');?>" type="text" name="nama_wali"/>
			        <?=form_error('nama_wali');?>
			    </label>
			    <label>
			        <span>Alamat Wali :</span>
			        <textarea name="alamat_wali"><?=isset($query['alamat_wali']) ? $query['alamat_wali'] : set_value('alamat_wali');?></textarea>
			        <?=form_error('alamat_wali');?>
			    </label>
			    <label>
			        <span>Telepon Wali :</span>
			        <input value="<?=isset($query['telp_wali']) ? $query['telp_wali'] : set_value('telp_wali');?>" type="text" name="telp_wali"/>
			        <?=form_error('telp_wali');?>
			    </label>
			    <label>
			        <span>Pekerjaan Wali :</span>
			        <input value="<?=isset($query['pekerjaan_wali']) ? $query['pekerjaan_wali'] : set_value('pekerjaan_wali');?>" type="text" name="pekerjaan_wali"/>
			        <?=form_error('pekerjaan_wali');?>
			    </label>
			    <br>
			    <h1>
			        <span><i class="icon-lock"></i> Kode Keamanan</span>
			    </h1>
			    <label>
			        <span>&nbsp;</span>
			        <?=$captcha['image'];?>
			    </label>
			    <label>
			        <span>&nbsp;</span>
			        <input required type="text" name="captcha" placeholder="Untuk keamanan, silahkan masukan 5 angka diatas" />
			        <?=form_error('captcha');?>
			    </label>

			    <label class="submit">
			        <span>&nbsp;</span>
			        <input type="submit" class="button" value="SIMPAN FORMULIR PENDAFTARAN" />
			    </label>
			</form>
		<?php } else {?>
		<p>Penerimaan peserta didik baru (PPDB) online tahun <?=$this->setting['ppdb_tahun']?> sudah ditutup</p>
		<?php } ?>
	</div>
</section>
<?php $this->load->view('themes/' . $this->setting['themes'] . '/aside-secondary');?>