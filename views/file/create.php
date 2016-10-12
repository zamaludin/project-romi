<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-paperclip text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open_multipart($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Kategori</label>
                <div class="col-md-10">
                    <?=form_dropdown('category_id', $category, $query['category_id'], "required class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama Berkas</label>
                <div class="col-md-10">
                    <input required autofocus type="text" class="form-control" name="title" value="<?=(set_value('title')) ? set_value('title') : $query['title']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Keterangan</label>
                <div class="col-md-10">
                    <textarea required class="form-control" rows="3" name="description"><?=(set_value('description')) ? set_value('description') : $query['description']?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input type="file" name="file" <?=$this->uri->segment(2)=='create'?'required':'';?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Hak akses</label>
                <div class="col-md-10">
                    <?=form_dropdown('access', array('public' => 'Public', 'private' => 'Private'), $query['access'], "required class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('file');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>