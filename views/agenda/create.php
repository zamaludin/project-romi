<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.date.extensions.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/backend/js/plugins/input-mask/jquery.inputmask.extensions.js');?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $("#post_date").inputmask("yyyy-mm-dd", {"placeholder": "YYYY-MM-DD"});
        $("#selesai").inputmask("yyyy-mm-dd", {"placeholder": "YYYY-MM-DD"});
    });
</script>
<section class="content-header">
    <h1><i class="fa fa-calendar-o text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Kegiatan</label>
                <div class="col-md-10">
                    <input required autofocus type="text" class="form-control" name="post_title" value="<?=(set_value('post_title')) ? set_value('post_title') : $query['post_title']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Tanggal Pelaksanaan</label>
                <div class="col-md-10">
                    <input type="text" id="post_date" name="post_date" required class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="<?=(set_value('post_date')) ? set_value('post_date') : $query['post_date']?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('agenda');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>