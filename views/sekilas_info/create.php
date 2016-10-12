<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-info-circle text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Judul</label>
                <div class="col-md-10">
                    <input required autofocus type="text" class="form-control" name="post_title" value="<?=(set_value('post_title')) ? set_value('post_title') : $query['post_title']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Sekilas Info</label>
                <div class="col-md-10">
                    <textarea name="post_content" class="form-control" rows="5"><?=isset($query['post_content']) ? $query['post_content'] : '';?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('sekilas_info');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>