<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-user text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <div class="row">
        <?=form_open('ptk/delete');?>
        <div class="col-md-12">
            <?=$alert;?>       
            <div class="btn-group" style="margin-bottom:10px;">
                <?php if($query->num_rows() > 0) { ?>
                    <button onClick="return confirm('Apakah anda yakin data akan dihapus ?')" type="submit" name="delete" class="btn btn-sm bg-red btn-flat"><i class="glyphicon glyphicon-trash"></i> HAPUS ITEM TERPILIH</button>
                <?php } ?>
                <a href="<?=site_url('ptk/export_excel');?>" class="btn btn-sm btn-warning btn-flat">SAVE AS EXCEL</a>
            </div>
            <div class="box-body">
                <?php if ($query->num_rows() > 0 ) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th style="width:10px"><input type="checkbox" id="check-all"/></th>
                        <th style="width:10px;">NO</th>
                        <th>NIK</th>
                        <th>NIP</th>
                        <th>NUPTK</th>
                        <th>NAMA</th>
                        <th>STATUS KEPEGAWAIAN</th>
                        <th>JENIS PTK</th>
                        <th>TELP</th>
                        <th style="width:145px;">&nbsp;</th>
                    </tr>
                    <?php 
                    $no = $this->uri->segment(3) == FALSE ? 1 : $this->uri->segment(3) + 1;
                    foreach ($query->result() as $row) { ?>
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="id[]" value="<?=$row->id;?>" /></td>
                        <td><?=$no;?></td>
                        <td><?=$row->nik;?></td>
                        <td><?=$row->nip;?></td>
                        <td><?=$row->nuptk;?></td>
                        <td><?=$row->nama;?></td>
                        <td><?=status_kepegawaian($row->status_kepegawaian);?></td>
                        <td><?=jenis_ptk($row->jenis_ptk);?></td>
                        <td><?=$row->telp;?></td>
                        <td>
                            <div class="btn-group">
                                <a href="#" data-toggle="modal" data-target="#<?=$row->id;?>" class="btn btn-sm bg-orange btn-flat" data-toggle="tooltip" data-original-title="Preview"><i class="glyphicon glyphicon-zoom-in"></i></a>
                                <a href="<?=site_url('ptk/update/'.$row->id);?>" class="btn btn-sm bg-teal btn-flat" data-toggle="tooltip" data-original-title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                                <a onClick="return confirm('Apakah anda yakin data akan dihapus ?')" href="<?=site_url('ptk/delete/'.$row->id);?>" class="btn btn-sm bg-red btn-flat" data-toggle="tooltip" data-original-title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="<?=$row->id;?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 style="padding-left:10px;font-weight:bold;">BIODATA PENDIDIK DAN TENAGA KEPENDIDIKAN</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?php if ($row->photo != NULL && file_exists('./assets/ptk/'.$row->photo)) { ?>
                                            <img src="<?=base_url('assets/ptk/'.$row->photo);?>">
                                            <?php } else { ?>
                                            <img src="<?=base_url('assets/user.jpg');?>">
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-9">
                                            <dl class="dl-horizontal">
                                                <dt>NIK</dt>
                                                <dd><?=$row->nik;?></dd>
                                                <dt>NIP</dt>
                                                <dd><?=$row->nip;?></dd>
                                                <dt>NUPTK</dt>
                                                <dd><?=$row->nuptk;?></dd>
                                                <dt>Nama</dt>
                                                <dd><?=$row->nama;?></dd>
                                                <dt>Status Kepegawaian</dt>
                                                <dd><?=status_kepegawaian($row->status_kepegawaian);?></dd>
                                                <dt>Jenis PTK</dt>
                                                <dd><?=jenis_ptk($row->jenis_ptk);?></dd>
                                                <dt>Jenis Kelamin</dt>
                                                <dd><?=$row->jenis_kelamin;?></dd>
                                                <dt>Alamat</dt>
                                                <dd><?=$row->alamat;?></dd>
                                                <dt>Telepon</dt>
                                                <dd><?=$row->telp;?></dd>
                                                <dt>Email</dt>
                                                <dd><?=$row->email;?></dd>
                                                <dt>Tempat, Tanggal Lahir</dt>
                                                <dd><?=$row->tempat_lahir;?><?=$row->tanggal_lahir != '0000-00-00' ? ', '.indo_date($row->tanggal_lahir) : '';?></dd>
                                                <dt>Pendidikan Terakhir</dt>
                                                <dd><?=pendidikan($row->pendidikan);?></dd>
                                                <dt>Jurusan</dt>
                                                <dd><?=$row->jurusan;?></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="text-align:center;">
                                    <a href="<?=site_url('ptk/update/'.$row->id);?>" class="btn btn-success"><i class="fa fa-edit"></i> PERBAHARUI DATA</a>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $no++; } ?>
                </table>
                <?php } else { ?>
                <br>
                <div class="alert alert-info">
                    <i class="fa fa-info"></i>
                    Data Pendidik dan Tenaga Kependidikan tidak ditemukan !
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