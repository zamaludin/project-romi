<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.date.extensions.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.extensions.js');?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $("#tanggal_lahir").inputmask("yyyy-mm-dd", {"placeholder": "YYYY-MM-DD"});
    });
</script>
<section class="content-header">
    <h1><i class="fa fa-user text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open_multipart($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-3 control-label">NIK</label>
                <div class="col-md-9">
                    <input autofocus type="text" class="form-control" name="nik" value="<?=$query ? $query['nik'] : set_value('nik')?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">NIP</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="nip" value="<?=(set_value('nip')) ? set_value('nip') : $query['nip']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">NUPTK</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="nuptk" value="<?=(set_value('nuptk')) ? set_value('nuptk') : $query['nuptk']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Nama</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="nama" value="<?=(set_value('nama')) ? set_value('nama') : $query['nama']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Status Kepegawaian</label>
                <div class="col-md-9">
                    <?=form_dropdown('status_kepegawaian', status_kepegawaian(), $query['status_kepegawaian'], "class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Jenis PTK</label>
                <div class="col-md-9">
                    <?=form_dropdown('jenis_ptk', jenis_ptk(), $query['jenis_ptk'], "class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Jenis Kelamin</label>
                <div class="col-md-9">
                    <?=form_dropdown('jenis_kelamin', sex(), $query['jenis_kelamin'], "class='form-control'");?>
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
                    <input type="text" class="form-control" name="telp" value="<?=(set_value('telp')) ? set_value('telp') : $query['telp']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                    <input type="email" class="form-control" name="email" value="<?=(set_value('email')) ? set_value('email') : $query['email']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Tempat Lahir</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="tempat_lahir" value="<?=(set_value('tempat_lahir')) ? set_value('tempat_lahir') : $query['tempat_lahir']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Tanggal Lahir</label>
                <div class="col-md-9">
                    <input id="tanggal_lahir" type="text" class="form-control" name="tanggal_lahir" value="<?=$query['tanggal_lahir']=='0000-00-00' ? '':$query['tanggal_lahir'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Pendidikan Terakhir</label>
                <div class="col-md-9">
                    <?=form_dropdown('pendidikan', pendidikan(), $query['pendidikan'], "class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Jurusan</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="jurusan" value="<?=(set_value('jurusan')) ? set_value('jurusan') : $query['jurusan']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Photo</label>
                <div class="col-md-9">
                    <?php if ($query['photo'] != NULL && file_exists('./assets/ptk/'.$query['photo'])) { ?>
                    <img src="<?=base_url('assets/ptk/'.$query['photo']);?>">
                    <?php } else { ?>
                    <img src="<?=base_url('assets/user.jpg');?>">
                    <?php } ?>
                    <br><br>
                    <input type="file" name="file">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('ptk');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>