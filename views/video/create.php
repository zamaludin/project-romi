<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-film text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="callout callout-warning">
            <h4>Petunjuk Singkat</h4>
            <p>Masukan Unique ID video youtube yang ada di URL video ketika diputar.</p>
            <p>Contoh : dari URL yang terlihat pada gambar berikut ini, maka yang harus dicopy yaitu kode : <strong>GK4sS7u0IYQ</strong></p>
            <img src="<?=base_url('assets/images/youtube.png');?>"> 
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Title</label>
                <div class="col-md-10">
                    <input required autofocus type="text" class="form-control" name="title" value="<?=(set_value('title')) ? set_value('title') : $query['title']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Unique ID</label>
                <div class="col-md-10">
                    <input required type="text" class="form-control" name="unique_id" value="<?=(set_value('unique_id')) ? set_value('unique_id') : $query['unique_id']?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('video');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>