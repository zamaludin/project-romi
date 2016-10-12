<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-filter text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-3 control-label">Masukan kata yang di filter</label>
                <div class="col-md-9">
                    <textarea placeholder="Filter pesan digunakan untuk mencegah pengiriman pesan dengan kata-kata yang tidak pantas. Silahkan masukan kata-kata tersebut disini dan dipisahkan dengan tanda koma (,)" class="form-control" rows="3" name="word_filter"><?=(set_value('word_filter')) ? set_value('word_filter') : $this->setting['word_filter']?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('kotak_masuk');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>