<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">.cke_contents { height: 500px !important; }</style>
<section class="content-header">
    <h1><i class="fa fa-plus text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open_multipart($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Title</label>
                <div class="col-md-10">
                    <input required autofocus placeholder="Enter title here" type="text" class="form-control" name="post_title" value="<?=(set_value('post_title')) ? set_value('post_title') : $query['post_title']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Category</label>
                <div class="col-md-10">
                    <?=form_dropdown('category_id', $category, $query['category_id'], "required class='form-control'");?>
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
                    <?php if ($this->uri->segment(2) == 'update' && $query['post_image'] != '' && file_exists('./assets/post/thumb/'.$query['post_image'])) { ?>
                    <img src="<?=base_url('assets/post/thumb/'.$query['post_image']);?>">
                    <br><br>
                    <?php } else { ?>
                    <img src="<?=base_url('assets/190x190.gif');?>">
                    <?php } ?>
                    <input type="file" name="file">
                    <span class="help-block">Type file : JPEG or PNG and max file size 5 MB</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-share"></i> <?=$button;?></button>
                    <a href="<?=site_url('posts');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> BACK</a>
                </div>
            </div>
        </div>
    </form>
</section>