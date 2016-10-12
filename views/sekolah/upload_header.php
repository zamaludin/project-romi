<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-image text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open_multipart($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <div class="col-md-12">
                    <?php if (file_exists('./assets/images/'.$this->setting['header_image'])) { ?>
                    <img width="960" src="<?=base_url('assets/images/'.$this->setting['header_image']);?>">
                    <br><br>
                    <?php } ?>
                    <input required type="file" name="file">
                    <p class="help-block">Ukuran File <?=$pixel;?> dengan format JPG, PNG, atau GIF</p>
                </div>
                <div></div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input value="<?=$button;?>" name="submit" type="submit" class="btn btn-success btn-sm btn-flat">
                </div>
            </div>
        </div>
    </form>
</section>