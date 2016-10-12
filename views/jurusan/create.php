<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-random text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Nama Jurusan</label>
                <div class="col-md-10">
                    <input required autofocus type="text" class="form-control" name="jurusan" value="<?=(set_value('jurusan')) ? set_value('jurusan') : $query['jurusan']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama Singkat</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="nama_singkat" value="<?=(set_value('nama_singkat')) ? set_value('nama_singkat') : $query['nama_singkat']?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('jurusan');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>