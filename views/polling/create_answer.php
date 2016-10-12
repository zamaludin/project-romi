<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-question-circle text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label"></label>
                <div class="col-md-10">
                    <strong><?=$pertanyaan['pertanyaan'];?></strong>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Jawaban</label>
                <div class="col-md-10">
                    <input required autofocus type="text" class="form-control" name="jawaban" value="<?=(set_value('jawaban')) ? set_value('jawaban') : $query['jawaban']?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('pertanyaan');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>

    <?php if($jawaban->num_rows() > 0) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box-body">
                <?php if ($jawaban->num_rows() > 0 ) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th style="width:10px;">NO</th>
                        <th>JAWABAN</th>
                        <th style="width:10px;">&nbsp;</th>
                    </tr>
                    <?php 
                    $no = 1;
                    foreach ($jawaban->result() as $row) { ?>
                    <tr>
                        <td><?=$no;?></td>
                        <td><?=$row->jawaban;?></td>
                        <td>
                            <div class="btn-group">
                                <a onClick="return confirm('Apakah anda yakin data akan dihapus ?')" href="<?=site_url('jawaban/delete/'.$this->uri->segment(3).'/'.$row->jawaban_id);?>" class="btn btn-sm bg-red btn-flat" data-toggle="tooltip" data-original-title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php $no++; } ?>
                </table>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
</section>