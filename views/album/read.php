<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-folder-open-o text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <div class="row">
        <?=form_open('album/delete');?>
        <div class="col-md-12">
            <?=$alert;?>       
            <div class="btn-group" style="margin-bottom:10px;">
                <?php if($query->num_rows() > 0) { ?>
                    <button onClick="return confirm('Apakah anda yakin data akan dihapus ?')" type="submit" name="delete" class="btn btn-sm bg-red btn-flat"><i class="glyphicon glyphicon-trash"></i> HAPUS ITEM TERPILIH</button>
                <?php } ?>
                <a href="<?=site_url('album/create');?>" class="btn btn-sm bg-green btn-flat"><i class="glyphicon glyphicon-plus"></i> TAMBAH ALBUM</a>
            </div>            
            <div class="box-body">
                <?php if ($query->num_rows() > 0 ) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th style="width:10px"><input type="checkbox" id="check-all"/></th>
                        <th style="width:10px;">NO</th>
                        <th>ALBUM</th>
                        <th style="width:115px;">&nbsp;</th>
                    </tr>
                    <?php 
                    $no = $this->uri->segment(3) == FALSE ? 1 : $this->uri->segment(3) + 1;
                    foreach ($query->result() as $row) { ?>
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="album_id[]" value="<?=$row->album_id;?>" /></td>
                        <td><?=$no;?></td>
                        <td><?=$row->album;?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?=site_url('album/update/'.$row->album_id);?>" class="btn btn-sm bg-teal btn-flat" data-toggle="tooltip" data-original-title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="<?=site_url('photo/upload/'.$row->album_id);?>" class="btn btn-sm bg-orange btn-flat" data-toggle="tooltip" data-original-title="Upload Photo"><i class="glyphicon glyphicon-picture"></i></a>
                                <a onClick="return confirm('Apakah anda yakin data akan dihapus ?')" href="<?=site_url('album/delete/'.$row->album_id);?>" class="btn btn-sm bg-red btn-flat" data-toggle="tooltip" data-original-title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php $no++; } ?>
                </table>
                <?php } else { ?>
                <br>
                <div class="alert alert-info">
                    <i class="fa fa-info"></i>
                    Data tidak ditemukan !
                </div>
                <?php } ?>
            </div>
            <?php if ($total_rows > 10) { ?>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <?=$pagination;?>
                </ul>
            </div>
            <?php } ?>
        </div>
        </form>
    </div>
</section>