<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-folder-open-o text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-3 control-label">Nomor Pendaftaran</label>
                <div class="col-md-9">
                    <input required autofocus type="text" class="form-control input-lg" name="no_daftar">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-check"></i> <?=$button;?></button>
                </div>
            </div>
        </div>
    </form>
</section>