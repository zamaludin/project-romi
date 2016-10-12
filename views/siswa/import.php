<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
     <h1><i class="fa fa-user text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <div class="callout callout-warning">
        <h4>Petunjuk Singkat</h4>
        <p>Penginputan data Siswa bisa dilakukan dengan mengcopy data dari file Ms. Excel. Format file excel harus sesuai kebutuhan aplikasi. Silahkan download formatnya <a href="<?=site_url('siswa/download');?>"><span class="label label-success">Disini</span></a>
        <br>
        <strong>CATATAN :</strong>
        <ol>
            <li>Pengisian data tanggal lahir pada kolom <strong>TANGGAL LAHIR</strong> diisi dengan format YYYY-MM-DD. Contoh : Jika lahir tanggal 12 Januari 1982 maka diisi dengan format : 1982-01-12.</li>
            <li>Pengisian data jenis kelamin pada kolom <strong>JENIS KELAMIN</strong> diisi dengan huruf <strong>L</strong> jika <strong>Laki-laki</strong> atau huruf <strong>P</strong> jika <strong>Perempuan</strong>.</li>
        </ol>
        </p>
    </div>
    <br>
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
    <div class="form-body">
        <div class="form-group">
            <div class="col-md-12">
                <textarea placeholder="Copy data yang akan dimasukan dari file excel, dan paste disini" rows="20" class="form-control" name="rows"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                <a href="<?=site_url('siswa');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
            </div>
        </div>
    </div>
    </form>
</section>