<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-check-square-o text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-3 control-label">Home</label>
                <div class="col-md-9">
                    <input autofocus required type="text" class="form-control" name="home" value="<?=$set_menu['home']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Agenda Sekolah</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="event" value="<?=$set_menu['event']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Direktori</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="direktori" value="<?=$set_menu['direktori']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Direktori PTK</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="direktori_ptk" value="<?=$set_menu['direktori_ptk']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Direktori Siswa</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="direktori_siswa" value="<?=$set_menu['direktori_siswa']?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Mengapa Harus Robotic?</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="sambutan_kepala_sekolah" value="<?=isset($set_menu['sambutan_kepala_sekolah']) ? $set_menu['sambutan_kepala_sekolah'] : NULL;?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Prestasi</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="prestasi" value="<?=$set_menu['prestasi']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Prestasi Sekolah</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="prestasi_sekolah" value="<?=$set_menu['prestasi_sekolah']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Prestasi PTK</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="prestasi_ptk" value="<?=$set_menu['prestasi_ptk']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Prestasi Siswa</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="prestasi_siswa" value="<?=$set_menu['prestasi_siswa']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">PPDB</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="ppdb" value="<?=$set_menu['ppdb']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Daftar Sekarang</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="daftar_sekarang" value="<?=$set_menu['daftar_sekarang']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Hasil Seleksi</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="hasil_seleksi" value="<?=$set_menu['hasil_seleksi']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Cetak Formulir</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="cetak_formulir" value="<?=$set_menu['cetak_formulir']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Grafik PPDB</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="grafik_ppdb" value="<?=$set_menu['grafik_ppdb']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Download Formulir</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="download_formulir" value="<?=$set_menu['download_formulir']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Download</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="download" value="<?=$set_menu['download']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Gallery</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="gallery" value="<?=$set_menu['gallery']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">gallery Photo</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="gallery_photo" value="<?=$set_menu['gallery_photo']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">gallery Video</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="gallery_video" value="<?=$set_menu['gallery_video']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Hubungi Kami</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="hubungi_kami" value="<?=$set_menu['hubungi_kami']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Jajak Pendapat</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="jajak_pendapat" value="<?=$set_menu['jajak_pendapat']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Banner</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="banner" value="<?=$set_menu['banner']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Login</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="login" value="<?=$set_menu['login']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Kategori</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="kategori" value="<?=$set_menu['kategori']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Arsip</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="arsip" value="<?=$set_menu['arsip']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Tautan</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="tautan" value="<?=$set_menu['tautan']?>">
                </div>
            </div>
            <div class="form-group">
               <label class="col-md-3 control-label">Yahoo Messenger</label>
                <div class="col-md-9">
                    <input required type="text" class="form-control" name="yahoo" value="<?=$set_menu['yahoo']?>">
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