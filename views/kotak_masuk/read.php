<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-envelope text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <div class="row">
        <?=form_open('kotak_masuk/delete');?>
        <div class="col-md-12">
            <?=$alert;?>       
            <div class="btn-group" style="margin-bottom:10px;">
                <?php if($query->num_rows() > 0) { ?>
                    <button onClick="return confirm('Apakah anda yakin data akan dihapus ?')" type="submit" name="delete" class="btn btn-sm bg-red btn-flat"><i class="glyphicon glyphicon-trash"></i> HAPUS ITEM TERPILIH</button>
                <?php } ?>
                <a href="<?=site_url('word_filter');?>" class="btn btn-warning btn-sm btn-flat"><i class="fa fa-filter"></i> FILTER PESAN</a>
            </div>            
            <div class="box-body">
                <?php if ($query->num_rows() > 0 ) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th style="width:10px"><input type="checkbox" id="check-all"/></th>
                        <th style="width:10px;">NO</th>
                        <th width="15%">NAMA</th>
                        <th width="15%">EMAIL</th>
                        <th width="15%">URL</th>
                        <th>PESAN</th>
                        <th width="15%">DIKIRIM</th>
                        <th width="10%">IP ADDRESS</th>
                        <th style="width:25px;">&nbsp;</th>
                    </tr>
                    <?php 
                    $no = $this->uri->segment(3) == FALSE ? 1 : $this->uri->segment(3) + 1;
                    foreach ($query->result() as $row) { ?>
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="id[]" value="<?=$row->id;?>" /></td>
                        <td><?=$no;?></td>
                        <td><?=$row->nama;?></td>
                        <td><?=$row->email;?></td>
                        <td><?=$row->url;?></td>
                        <td><?=substr($row->pertanyaan, 0, 70);?>...</td>
                        <td><?=$row->tanggal;?></td>
                        <td><?=$row->ip_address;?></td>
                        <td>
                            <div class="btn-group">
                                <a onClick="return confirm('Apakah anda yakin data akan dihapus ?')" href="<?=site_url('kotak_masuk/delete/'.$row->id);?>" class="btn btn-sm bg-red btn-flat" data-toggle="tooltip" data-original-title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>
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