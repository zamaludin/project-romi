<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.date.extensions.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.extensions.js');?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $("#tanggal_lahir").inputmask("yyyy-mm-dd", {"placeholder": "YYYY-MM-DD"});
        $("#pada_tanggal").inputmask("yyyy-mm-dd", {"placeholder": "YYYY-MM-DD"});
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
                <label class="col-md-3 control-label">NIS</label>
                <div class="col-md-9">
                    <input required autofocus type="text" class="form-control" name="nis" value="<?=(set_value('nis')) ? set_value('nis') : $query['nis']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">NISN</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="nisn" value="<?=(set_value('nisn')) ? set_value('nisn') : $query['nisn']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Nama</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="nama" value="<?=(set_value('nama')) ? set_value('nama') : $query['nama']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Kelas</label>
                <div class="col-md-9">
                    <?=form_dropdown('kelas_id', $q_kelas, $query['kelas_id'], "class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Status Siswa</label>
                <div class="col-md-9">
                    <?php
                    $status_siswa['aktif']   = 'Aktif';
                    if ($this->uri->segment(2) != 'create')
                    {
                        $status_siswa['pindah']  = 'Pindah Sekolah';
                        $status_siswa['dropout'] = 'Drop Out / Dikeluarkan';
                        $status_siswa['lulus']   = 'Lulus';  
                    }
                    echo form_dropdown('status_siswa', $status_siswa, $query['status_siswa'], "class='form-control'");?>
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
                    <input id="tanggal_lahir" type="text" class="form-control" name="tanggal_lahir" value="<?=$query['tanggal_lahir']=='0000-00-00' ? '':$query['tanggal_lahir'];?>">
                </div>
            </div>            
            <div class="form-group">
                <label class="col-md-3 control-label">Jenis Kelamin</label>
                <div class="col-md-9">
                    <?=form_dropdown('jenis_kelamin', sex(), $query['jenis_kelamin'], "class='form-control'");?>
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
                    <?php
                    $status_anak = array(
                        'Anak Kandung' => 'Anak Kandung',
                        'Anak Angkat' => 'Anak Angkat'
                        );
                    echo form_dropdown('status_anak', $status_anak, $query['status_anak'], "class='form-control'");?>
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
                <label class="col-md-3 control-label">Telepon Rumah</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="telp_rumah" value="<?=(set_value('telp_rumah')) ? set_value('telp_rumah') : $query['telp_rumah']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Sekolah Asal</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="sekolah_asal" value="<?=(set_value('sekolah_asal')) ? set_value('sekolah_asal') : $query['sekolah_asal']?>">
                </div>
            </div>
           
            <div class="form-group">
                <label class="col-md-3 control-label">Diterima di Kelas</label>
                <div class="col-md-9">
                    <?=form_dropdown('diterima_dikelas', $q_kelas, $query['diterima_dikelas'], "class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Pada Tanggal</label>
                <div class="col-md-9">
                    <input id="pada_tanggal" type="text" class="form-control" name="pada_tanggal" value="<?=$query['pada_tanggal']=='0000-00-00' ? '':$query['pada_tanggal'];?>">
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
                    <img src="<?=base_url('assets/user.jpg');?>">
                    <?php } ?>
                    <br><br>
                    <input type="file" name="file" <?=$this->uri->segment(2)=='create'?'required':'';?>>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('siswa');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>