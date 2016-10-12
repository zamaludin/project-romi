<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.date.extensions.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.extensions.js');?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $("#tanggal_lahir").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
    });
</script>
<section class="content-header">
    <h1><i class="fa fa-plus text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open_multipart($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>        
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-3 control-label">No. Pendaftaran</label>
                <div class="col-md-9">
                    <input readonly autofocus type="text" class="form-control" name="nisn" value="<?=(set_value('nisn')) ? set_value('nisn') : $query['nisn']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Tanggal Pendaftaran</label>
                <div class="col-md-9">
                    <input readonly type="text" class="form-control" name="tanggal_daftar" value="<?=$query['tanggal_daftar']=='0000-00-00' ? '' : indo_date($query['tanggal_daftar']);?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">TK Asal</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="sekolah_asal" value="<?=(set_value('sekolah_asal')) ? set_value('sekolah_asal') : $query['sekolah_asal']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Nama</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="nama" value="<?=(set_value('nama')) ? set_value('nama') : $query['nama']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Tempat Lahir</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="tempat_lahir" value="<?=(set_value('tempat_lahir')) ? set_value('tempat_lahir') : $query['tempat_lahir']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Tanggal Lahir</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="tanggal_lahir" value="<?=$query['tanggal_lahir']=='0000-00-00' ? '':$query['tanggal_lahir'];?>">
                </div>
            </div>            
            <div class="form-group">
                <label class="col-md-3 control-label">Jenis Kelamin</label>
                <div class="col-md-9">
                    <?=form_dropdown('jenis_kelamin', array('Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'), $query['jenis_kelamin'], "class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Agama</label>
                <div class="col-md-9">
                    <?=form_dropdown('agama', agama(), $query['agama'], "class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Status Anak</label>
                <div class="col-md-9">
                    <?=form_dropdown('status_anak', status_anak(), $query['status_anak'], "class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Anak Ke</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="anak_ke" value="<?=(set_value('anak_ke')) ? set_value('anak_ke') : $query['anak_ke']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Alamat</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="alamat" value="<?=(set_value('alamat')) ? set_value('alamat') : $query['alamat']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Telepon</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="telp_rumah" value="<?=(set_value('telp_rumah')) ? set_value('telp_rumah') : $query['telp_rumah']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Nama Ayah</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="ayah" value="<?=(set_value('ayah')) ? set_value('ayah') : $query['ayah']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Nama Ibu</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="ibu" value="<?=(set_value('ibu')) ? set_value('ibu') : $query['ibu']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Alamat Orang Tua</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="alamat_ortu" value="<?=(set_value('alamat_ortu')) ? set_value('alamat_ortu') : $query['alamat_ortu']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Telepon Orang Tua</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="telp_ortu" value="<?=(set_value('telp_ortu')) ? set_value('telp_ortu') : $query['telp_ortu']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Pekerjaan Ayah</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="pekerjaan_ayah" value="<?=(set_value('pekerjaan_ayah')) ? set_value('pekerjaan_ayah') : $query['pekerjaan_ayah']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Pekerjaan Ibu</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="pekerjaan_ibu" value="<?=(set_value('pekerjaan_ibu')) ? set_value('pekerjaan_ibu') : $query['pekerjaan_ibu']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Nama Wali</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="nama_wali" value="<?=(set_value('nama_wali')) ? set_value('nama_wali') : $query['nama_wali']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Alamat Wali</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="alamat_wali" value="<?=(set_value('alamat_wali')) ? set_value('alamat_wali') : $query['alamat_wali']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Telepon Wali</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="telp_wali" value="<?=(set_value('telp_wali')) ? set_value('telp_wali') : $query['telp_wali']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Pekerjaan Wali</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="pekerjaan_wali" value="<?=(set_value('pekerjaan_wali')) ? set_value('pekerjaan_wali') : $query['pekerjaan_wali']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Photo</label>
                <div class="col-md-9">
                    <?php if ($query['photo'] != NULL && file_exists('./assets/siswa/'.$query['photo'])) { ?>
                    <img src="<?=base_url('assets/siswa/'.$query['photo']);?>">
                    <?php } else { ?>
                    <img src="<?=base_url('assets/3X4.jpg');?>">
                    <?php } ?>
                    <br><br>
                    <input type="file" name="file">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('ppdb-sd/siswa');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>