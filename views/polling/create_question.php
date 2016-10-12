<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-question-circle text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-3 control-label">Pertanyaan</label>
                <div class="col-md-9">
                    <textarea class="form-control" rows="5" name="pertanyaan"><?=(set_value('pertanyaan')) ? set_value('pertanyaan') : $query['pertanyaan']?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('pertanyaan');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>