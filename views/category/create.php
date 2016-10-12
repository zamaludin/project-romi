<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-tags text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Category</label>
                <div class="col-md-10">
                    <input required autofocus type="text" class="form-control" name="category" value="<?=(set_value('category')) ? set_value('category') : $query['category']?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('category');?>" class="btn bg-orange btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> BACK</a>
                </div>
            </div>
        </div>
    </form>
</section>