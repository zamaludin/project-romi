<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-comments-o text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Kata Motivasi</label>
                <div class="col-md-10">
                    <textarea required autofocus class="form-control" rows="3" name="content"><?=(set_value('content')) ? set_value('content') : $query['content']?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Motivator</label>
                <div class="col-md-10">
                    <input required type="text" class="form-control" name="author" value="<?=(set_value('author')) ? set_value('author') : $query['author']?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('motivasi');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>