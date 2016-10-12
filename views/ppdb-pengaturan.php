<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-wrench text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open_multipart($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-3 control-label">Tahun</label>
                <div class="col-md-9">
                    <input required type="text" maxlength="4" class="form-control" name="ppdb_tahun" value="<?=(set_value('ppdb_tahun')) ? set_value('ppdb_tahun') : $this->setting['ppdb_tahun']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Status Pendaftaran</label>
                <div class="col-md-9">
                    <?=form_dropdown('ppdb_status', ['open' => 'Dibuka', 'close' => 'Ditutup'], $this->setting['ppdb_status'], "class='form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                </div>
            </div>
        </div>
    </form>
</section>