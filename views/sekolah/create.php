<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-info-circle text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open_multipart($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-3 control-label">NPSN</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="npsn" value="<?=(set_value('npsn')) ? set_value('npsn') : $query['npsn']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Nama Sekolah</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="nama_sekolah" value="<?=(set_value('nama_sekolah')) ? set_value('nama_sekolah') : $query['nama_sekolah']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Jenjang</label>
                <div class="col-md-9">
                    <?=form_dropdown('jenjang', array('SD' => 'SD', 'SMP' => 'SMP/MTs', 'SMA' => 'SMA/Aliyah', 'Semua Tingkatan' => 'SMK'), $query['jenjang'], "class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Alamat</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="alamat" value="<?=(set_value('alamat')) ? set_value('alamat') : $query['alamat']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Kelurahan</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="kelurahan" value="<?=(set_value('kelurahan')) ? set_value('kelurahan') : $query['kelurahan']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Kecamatan</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="kecamatan" value="<?=(set_value('kecamatan')) ? set_value('kecamatan') : $query['kecamatan']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Kabupaten</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="kabupaten" value="<?=(set_value('kabupaten')) ? set_value('kabupaten') : $query['kabupaten']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Propinsi</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="propinsi" value="<?=(set_value('propinsi')) ? set_value('propinsi') : $query['propinsi']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Website</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="website" value="<?=(set_value('website')) ? set_value('website') : $query['website']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="email" value="<?=(set_value('email')) ? set_value('email') : $query['email']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Telepon</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="telp" value="<?=(set_value('telp')) ? set_value('telp') : $query['telp']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Kepala Sekolah</label>
                <div class="col-md-9">
                    <?=form_dropdown('ptk_id', $q_ptk, $query['ptk_id'], "required class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Logo Sekolah</label>
                <div class="col-md-9">
                    <?php if (file_exists('./assets/images/'.$query['logo'])) { ?>
                    <img src="<?=base_url('assets/images/'.$query['logo']);?>">
                    <br><br>
                    <?php } ?>
                    <input type="file" name="file">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Facebook</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="facebook" value="<?=(set_value('facebook')) ? set_value('facebook') : $query['facebook']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Twitter</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="twitter" value="<?=(set_value('twitter')) ? set_value('twitter') : $query['twitter']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Google Plus</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="google_plus" value="<?=(set_value('google_plus')) ? set_value('google_plus') : $query['google_plus']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Youtube</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="youtube" value="<?=(set_value('youtube')) ? set_value('youtube') : $query['youtube']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">ID Yahoo Messenger</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="yahoo" value="<?=(set_value('yahoo')) ? set_value('yahoo') : $query['yahoo']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Meta Keywords</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="meta_keywords" value="<?=(set_value('meta_keywords')) ? set_value('meta_keywords') : $query['meta_keywords']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Meta Description</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="meta_description" value="<?=(set_value('meta_description')) ? set_value('meta_description') : $query['meta_description']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Latitude and Longitude Coordinates</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="google_map" value="<?=(set_value('google_map')) ? set_value('google_map') : $query['google_map']?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                </div>
            </div>
        </div>
    </form>
</section>