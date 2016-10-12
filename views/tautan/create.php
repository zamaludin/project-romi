<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-chain text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">URL</label>
                <div class="col-md-10">
                    <input required autofocus type="url" class="form-control" name="url" value="<?=(set_value('url')) ? set_value('url') : $query['url']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Keterangan</label>
                <div class="col-md-10">
                    <input required autofocus type="text" class="form-control" name="keterangan" value="<?=(set_value('keterangan')) ? set_value('keterangan') : $query['keterangan']?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('tautan');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>