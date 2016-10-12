<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-user text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <div class="row">
        <?=form_open('ppdb/hasil_seleksi/clear');?>
        <input type="hidden" name="url" value="<?=current_url();?>">
        <div class="col-md-12">
            <?=$alert;?>       
            <div class="btn-group" style="margin-bottom:10px;">
                <?php if($query->num_rows() > 0) { ?>
                    <button onClick="return confirm('Apakah anda yakin data akan dihapus ?')"s type="submit" name="clear" class="btn btn-sm bg-yellow btn-flat"><i class="glyphicon glyphicon-trash"></i> HAPUS DARI HASIL SELEKSI</button>
                <?php } ?>

                <?php if ($q_tahun->num_rows() > 0) { ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary btn-flat">PILIH TAHUN</button>
                    <button type="button" class="btn btn-sm btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                        foreach($q_tahun->result() as $tahun)
                        {
                            echo '<li>';
                            echo '<a href="'.site_url('ppdb/hasil_seleksi/'.$this->uri->segment(3).'/'.$tahun->tahun).'">Tahun ';
                            echo $tahun->tahun;
                            echo '</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
                <?php } ?>

                <?php if($query->num_rows() > 0) { ?>
                    <a href="<?=site_url('ppdb/hasil_seleksi/export_excel/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>" class="btn btn-sm bg-green btn-flat"><i class="fa fa-save"></i>&nbsp;&nbsp;SAVE AS EXCEL</a>                
                <?php } ?>
            </div>
            <div class="box-body">
                <?php if ($query->num_rows() > 0 ) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th style="width:10px"><input type="checkbox" id="check-all"/></th>
                        <th style="width:10px;">NO</th>
                        <th>NAMA</th>
                        <th width="15%">NO. DAFTAR</th>
                        <th>TANGGAL DAFTAR</th>
                        <th>JALUR PENDAFTARAN</th>
                        <th>SEKOLAH ASAL</th>
                        <th style="width:80px;">&nbsp;</th>
                    </tr>
                    <?php 
                    $no = $this->uri->segment(5) == FALSE ? 1 : $this->uri->segment(5) + 1;
                    foreach ($query->result() as $row) { ?>
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="id[]" value="<?=$row->id;?>" /></td>
                        <td><?=$no;?></td>
                        <td><?=$row->nama;?></td>
                        <td><?=$row->no_daftar;?></td>
                        <td><?=indo_date($row->tanggal_daftar);?></td>
                        <td><?=$row->jalur_pendaftaran;?></td>
                        <td><?=$row->sekolah_asal;?></td>
                        <td>
                            <div class="btn-group">
                                <a href="#" data-toggle="modal" data-target="#<?=$row->id;?>" class="btn btn-sm bg-orange btn-flat" data-toggle="tooltip" data-original-title="Preview"><i class="glyphicon glyphicon-zoom-in"></i></a>
                                <a href="<?=site_url('ppdb/cetak/index/'.encode_url($row->id));?>" class="btn btn-sm bg-navy btn-flat" data-toggle="tooltip" data-original-title="Cetak" target="_blank"><i class="glyphicon glyphicon-print"></i></a>
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="<?=$row->id;?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 style="padding-left:10px;font-weight:bold;">BIODATA CALON PESERTA DIDIK BARU</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?php if ($row->photo != NULL && file_exists('./assets/siswa/'.$row->photo)) { ?>
                                            <img src="<?=base_url('assets/siswa/'.$row->photo);?>">
                                            <?php } else { ?>
                                            <img src="<?=base_url('assets/images/3X4.jpg');?>">
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-9">
                                            <dl class="dl-horizontal">
                                                <dt>No. Pendaftaran</dt>
                                                <dd><?=$row->no_daftar;?></dd>
                                                <dt>Tanggal Pendaftaran</dt>
                                                <dd><?=indo_date($row->tanggal_daftar);?></dd>
                                                <dt>Jalur Pendaftaran</dt>
                                                <dd><?=$row->jalur_pendaftaran;?></dd>
                                                <dt>Sekolah Asal</dt>
                                                <dd><?=$row->sekolah_asal;?></dd>
                                                <dt>NISN</dt>
                                                <dt>Nama</dt>
                                                <dd><?=$row->nama;?></dd>
                                                <dt>Tempat, Tanggal Lahir</dt>
                                                <dd><?=$row->tempat_lahir;?><?=$row->tanggal_lahir != '0000-00-00' ? ', '.indo_date($row->tanggal_lahir) : '';?></dd>
                                                <dt>Jenis Kelamin</dt>
                                                <dd><?=$row->jenis_kelamin;?></dd>
                                                <dt>Agama</dt>
                                                <dd><?=$row->agama;?></dd>
                                                <dt>Status Anak</dt>
                                                <dd><?=$row->status_anak;?></dd>
                                                <dt>Anak Ke</dt>
                                                <dd><?=$row->anak_ke;?></dd>
                                                <dt>Alamat</dt>
                                                <dd><?=$row->alamat;?></dd>
                                                <dt>Telepon Rumah</dt>
                                                <dd><?=$row->telp_rumah;?></dd>                                                
                                                <dd><?=$row->nisn;?></dd>
                                                <dt>Nama Ayah</dt>
                                                <dd><?=$row->ayah;?></dd>
                                                <dt>Nama Ibu</dt>
                                                <dd><?=$row->ibu;?></dd>
                                                <dt>Alamat Orang Tua</dt>
                                                <dd><?=$row->alamat_ortu;?></dd>
                                                <dt>Telepon Orang Tua</dt>
                                                <dd><?=$row->telp_ortu;?></dd>
                                                <dt>Pekerjaan Ayah</dt>
                                                <dd><?=$row->pekerjaan_ayah;?></dd>
                                                <dt>Pekerjaan Ibu</dt>
                                                <dd><?=$row->pekerjaan_ibu;?></dd>
                                                <dt>Nama Wali</dt>
                                                <dd><?=$row->nama_wali;?></dd>
                                                <dt>Alamat Wali</dt>
                                                <dd><?=$row->alamat_wali;?></dd>
                                                <dt>Telp Wali</dt>
                                                <dd><?=$row->telp_wali;?></dd>
                                                <dt>Pekerjaan Wali</dt>
                                                <dd><?=$row->pekerjaan_wali;?></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="text-align:center;">
                                    <a href="<?=site_url('ppdb/siswa/update/'.$row->id);?>" class="btn btn-success"><i class="fa fa-edit"></i> PERBAHARUI DATA</a>
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
                    Data tidak ditemukan !
                </div>
                <?php } ?>
            </div>
            <?php if ($total_rows > 1) { ?>
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