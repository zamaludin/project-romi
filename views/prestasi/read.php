<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-trophy text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <div class="row">
        <?=form_open('prestasi/delete');?>
        <div class="col-md-12">
            <?=$alert;?>       
            <div class="btn-group" style="margin-bottom:10px;">
                <?php if($query->num_rows() > 0) { ?>
                    <button onClick="return confirm('Apakah anda yakin data akan dihapus ?')" type="submit" name="delete" class="btn btn-sm bg-red btn-flat"><i class="glyphicon glyphicon-trash"></i> HAPUS ITEM TERPILIH</button>
                <?php } ?>
                <a href="<?=site_url('prestasi/create');?>" class="btn btn-sm bg-green btn-flat"><i class="glyphicon glyphicon-plus"></i> TAMBAH DATA</a>
            </div>            
            <div class="box-body">
                <?php if ($query->num_rows() > 0 ) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th style="width:10px"><input type="checkbox" id="check-all"/></th>
                        <th style="width:10px;">NO</th>
                        <th width="15%">KATEGORI</th>
                        <th width="40%">PRESTASI</th>
                        <th>KETERANGAN</th>
                        <th style="width:85px;">&nbsp;</th>
                    </tr>
                    <?php 
                    $no = $this->uri->segment(3) == FALSE ? 1 : $this->uri->segment(3) + 1;
                    foreach ($query->result() as $row) { ?>
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="post_id[]" value="<?=$row->post_id;?>" /></td>
                        <td><?=$no;?></td>
                        <td>
                            <?php
                            $type = explode('_', $row->post_type);
                            echo ucwords($type[0].' '.$type[1]);
                            ?>
                        </td>
                        <td><?=$row->post_title;?></td>
                        <td><?=substr($row->post_content, 0, 100);?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?=site_url('prestasi/update/'.$row->post_id);?>" class="btn btn-sm bg-teal btn-flat" data-toggle="tooltip" data-original-title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                                <a onClick="return confirm('Apakah anda yakin data akan dihapus ?')" href="<?=site_url('prestasi/delete/'.$row->post_id);?>" class="btn btn-sm bg-red btn-flat" data-toggle="tooltip" data-original-title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php $no++; } ?>
                </table>
                <?php } else { ?>
                <br>
                <div class="alert alert-info">
                    <i class="fa fa-info"></i>
                    Data prestasi tidak ditemukan !
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