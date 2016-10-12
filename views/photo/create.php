<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-camera text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open_multipart($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Album</label>
                <div class="col-md-10">
                    <?=form_dropdown('album_id', $albums, $query['album_id'], "required class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Keterangan</label>
                <div class="col-md-10">
                    <input required type="text" class="form-control" name="photo_title" value="<?=(set_value('photo_title')) ? set_value('photo_title') : $query['photo_title']?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <?php if ($this->uri->segment(2) == 'update' && file_exists('./assets/gallery/thumb/'.$query['photo_thumb'])) { ?>
                    <img src="<?=base_url('assets/gallery/thumb/'.$query['photo_thumb']);?>">
                    <br><br>
                    <?php } ?>
                    <input type="file" name="file" <?=$this->uri->segment(2)=='create'?'required':'';?>>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('photo');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>