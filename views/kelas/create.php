<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-sitemap text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Kelas</label>
                <div class="col-md-10">
                    <input required autofocus type="text" class="form-control" name="kelas" value="<?=(set_value('kelas')) ? set_value('kelas') : $query['kelas']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Sub Kelas</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="sub_kelas" value="<?=(set_value('sub_kelas')) ? set_value('sub_kelas') : $query['sub_kelas']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Jurusan</label>
                <div class="col-md-10">
                    <?=form_dropdown('jurusan_id', $q_jurusan, $query['jurusan_id'], "class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('kelas');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>