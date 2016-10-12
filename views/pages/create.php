<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">.cke_contents { height: 500px !important; }</style>
<section class="content-header">
    <h1><i class="fa fa-plus text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Title</label>
                <div class="col-md-10">
                    <input required autofocus placeholder="Enter title here" type="text" class="form-control" name="post_title" value="<?=(set_value('post_title')) ? set_value('post_title') : $query['post_title']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Parent</label>
                <div class="col-md-10">
                    <?=form_dropdown('post_parent', $parent, $query['post_parent'], "required class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label"></label>
                <div class="col-md-10">
                    <textarea class="ckeditor" id="ckeditor" name="post_content">
                        <?=(set_value('post_content')) ? set_value('post_content') : $query['post_content']?>
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-share"></i> <?=$button;?></button>
                    <a href="<?=site_url('pages');?>" class="btn bg-orange btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> BACK</a>
                </div>
            </div>
        </div>
    </form>
</section>