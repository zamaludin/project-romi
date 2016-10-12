<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">.cke_contents { height: 500px !important; }</style>
<section class="content-header">
    <h1><i class="fa fa-bullhorn text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open_multipart($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Judul</label>
                <div class="col-md-10">
                    <input required autofocus type="text" class="form-control" name="post_title" value="<?=(set_value('post_title')) ? set_value('post_title') : $query['post_title']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Pengumuman</label>
                <div class="col-md-10">
                    <textarea name="post_content" class="ckeditor" id="ckeditor">
                        <?=(set_value('post_content')) ? set_value('post_content') : $query['post_content']?>
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <?php if ($this->uri->segment(2) == 'update' && $query['post_image'] != NULL && file_exists('./assets/post/thumb/'.$query['post_image'])) { ?>
                    <img src="<?=base_url('assets/post/thumb/'.$query['post_image']);?>">
                    <br><br>
                    <?php } else { ?>
                    <img src="<?=base_url('assets/190x190.gif');?>">
                    <?php } ?>
                    <input type="file" name="file">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button id="submit" type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('pengumuman');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>