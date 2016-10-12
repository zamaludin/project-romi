<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-trophy text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open_multipart($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Prestasi</label>
                <div class="col-md-10">
                    <input required autofocus placeholder="Masukan prestasi yang diraih disini" type="text" class="form-control" name="post_title" value="<?=(set_value('post_title')) ? set_value('post_title') : $query['post_title']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Kategori</label>
                <div class="col-md-10">
                    <?php
                    $type = array(
                        'prestasi_sekolah' => 'Prestasi Sekolah',
                        'prestasi_ptk' => 'Prestasi PTK',
                        'prestasi_siswa' => 'Prestasi Siswa'
                        );
                    echo form_dropdown('post_type', $type, $query['post_type'], "class='form-control'");?>
                </div>
            </div>
             <div class="form-group">
                <label class="col-md-2 control-label">Keterangan</label>
                <div class="col-md-10">
                    <textarea placeholder="Masukan keterangan tambahan" name="post_content" class="form-control" rows="8"><?=isset($query['post_content']) ? $query['post_content'] : '';?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <?php if ($this->uri->segment(2) == 'update' && $query['post_image'] != '' && file_exists('./assets/post/thumb/'.$query['post_image'])) { ?>
                    <img src="<?=base_url('assets/post/thumb/'.$query['post_image']);?>">
                    <br><br>
                    <?php } else { ?>
                    <img src="<?=base_url('assets/190x190.gif');?>">
                    <?php } ?>
                    <input type="file" name="file">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-share"></i> <?=$button;?></button>
                    <a href="<?=site_url('prestasi');?>" class="btn bg-orange btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> BACK</a>
                </div>
            </div>
        </div>
    </form>
</section>