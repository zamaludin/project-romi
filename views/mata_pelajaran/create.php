<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-book text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('id'=>'form', 'role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Kode</label>
                <div class="col-md-10">
                    <input required autofocus type="text" class="form-control" name="kode" id="kode" value="<?=(set_value('kode')) ? set_value('kode') : $query['kode']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Mata Pelajaran</label>
                <div class="col-md-10">
                    <input required type="text" class="form-control" name="mata_pelajaran"id="mata_pelajaran" value="<?=(set_value('mata_pelajaran')) ? set_value('mata_pelajaran') : $query['mata_pelajaran']?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('mata_pelajaran');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>