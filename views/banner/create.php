<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-puzzle-piece text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open_multipart($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
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
                    <textarea required class="form-control" rows="3" name="keterangan"><?=(set_value('keterangan')) ? set_value('keterangan') : $query['keterangan']?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <?php if ($this->uri->segment(2) == 'update' && file_exists('./assets/banner/'.$query['gambar'])) { ?>
                    <img src="<?=base_url('assets/banner/'.$query['gambar']);?>">
                    <br><br>
                    <?php } ?>
                    <input type="file" name="file" <?=$this->uri->segment(2)=='create'?'required':'';?>>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('banner');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>