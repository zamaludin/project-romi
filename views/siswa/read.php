<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1>
        <?php 
        if ($this->uri->segment(3) == 'aktif' OR $this->uri->segment(2) == 'kelas')
        {
            echo '<i class="fa fa-check-square-o text-green"></i>';
        }
        else if ($this->uri->segment(3) == 'dropout')
        {
            echo '<i class="fa fa-external-link text-green"></i>';
        }
        else if ($this->uri->segment(3) == 'pindah')
        {
            echo '<i class="fa fa-mail-forward text-green"></i>';
        }
        else if ($this->uri->segment(3) == 'lulus')
        {
            echo '<i class="fa fa-user text-green"></i>';
        }
        ?>
        <?=$title;?>
    </h1>
</section>
<section class="content">
    <div class="row">
        <?=form_open('siswa/delete');?>
        <input type="hidden" name="url" value="<?=current_url();?>">
        <div class="col-md-12">
            <?=$alert;?>       
            <div class="btn-group" style="margin-bottom:10px;">
                <?php if($query->num_rows() > 0) { ?>
                    <button onClick="return confirm('Apakah anda yakin data akan dihapus ?')" type="submit" name="delete" class="btn btn-sm bg-red btn-flat"><i class="fa fa-trash"></i> HAPUS</button>
                <?php } ?>

                <?php if ($this->uri->segment(3) == 'aktif' OR $this->uri->segment(2) == 'kelas') { ?>
                <a href="<?=site_url('siswa/create');?>" class="btn btn-sm bg-green btn-flat"><i class="fa fa-plus"></i> TAMBAH</a>
                <?php } ?>

                <a href="<?=site_url('siswa/export_excel/'.$this->uri->segment(2).'/'.$this->uri->segment(3));?>" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-save"></i> SAVE AS EXCEL</a>

                <?php if ($q_kelas->num_rows() > 0 && $this->uri->segment(3) == 'aktif' OR $this->uri->segment(2) == 'kelas') { ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-warning btn-flat">PILIH KELAS</button>
                    <button type="button" class="btn btn-sm btn-warning btn-flat dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                        foreach($q_kelas->result() as $kelas) {
                            echo '<li>';
                            echo '<a href="'.site_url('siswa/kelas/'.$kelas->kelas_id).'">Kelas ';
                            echo $kelas->kelas;                            
                            echo '</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
                <?php } ?>
            </div>
            <div class="box-body">
                <?php if ($query->num_rows() > 0 ) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th style="width:10px"><input type="checkbox" id="check-all"/></th>
                        <th style="width:10px;">NO</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>NAMA</th>
                        <th>JENIS KELAMIN</th>
                        <th width="20%">ALAMAT</th>
                        <th>TELP</th>
                        <th style="width:112px;">&nbsp;</th>
                    </tr>
                    <?php 
                    $no = $this->uri->segment(4) == FALSE ? 1 : $this->uri->segment(4) + 1;
                    foreach ($query->result() as $row) { ?>
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="id[]" value="<?=$row->id;?>" /></td>
                        <td><?=$no;?></td>
                        <td><?=$row->nis;?></td>
                        <td><?=$row->nisn;?></td>
                        <td><?=$row->nama;?></td>
                        <td><?=$row->jenis_kelamin;?></td>
                        <td><?=$row->alamat;?></td>
                        <td><?=$row->telp_rumah;?></td>
                        <td>
                            <div class="btn-group">
                                <a href="#" data-toggle="modal" data-target="#<?=$row->id;?>" class="btn btn-sm bg-orange btn-flat" data-toggle="tooltip" data-original-title="Preview"><i class="glyphicon glyphicon-zoom-in"></i></a>
                                <a href="<?=site_url('siswa/update/'.$row->id);?>" class="btn btn-sm bg-teal btn-flat" data-toggle="tooltip" data-original-title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                                <a onClick="return confirm('Apakah anda yakin data akan dihapus ?')" href="<?=site_url('siswa/delete/'.$row->id);?>" class="btn btn-sm bg-red btn-flat" data-toggle="tooltip" data-original-title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="<?=$row->id;?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 style="padding-left:10px;font-weight:bold;">BIODATA SISWA</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <?php if ($row->photo != NULL && file_exists('./assets/siswa/'.$row->photo)) { ?>
                                            <img src="<?=base_url('assets/siswa/'.$row->photo);?>">
                                            <?php } else { ?>
                                            <img src="<?=base_url('assets/user.jpg');?>">
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-9">
                                            <dl class="dl-horizontal">
                                                <dt>NIS</dt>
                                                <dd><?=$row->nis;?></dd>
                                                <dt>NISN</dt>
                                                <dd><?=$row->nisn;?></dd>
                                                <dt>Nama Siswa</dt>
                                                <dd><?=$row->nama;?></dd>
                                                <dt>Kelas</dt>
                                                <dd><?=$row->kelas;?></dd>
                                                <dt>Status Siswa</dt>
                                                <dd>
                                                    <?php 
                                                    if ($row->status_siswa == 'aktif')
                                                    {
                                                       echo 'Aktif';
                                                    }
                                                    else if ($row->status_siswa == 'pindah')
                                                    {
                                                       echo 'Pindah Sekolah';
                                                    }
                                                    else if ($row->status_siswa == 'dropout')
                                                    {
                                                       echo 'Drop Out / Dikeluarkan';
                                                    }
                                                    else if ($row->status_siswa == 'lulus')
                                                    {
                                                       echo 'Alumni';
                                                    }
                                                    ?>
                                                </dd>
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
                                                <dt>Sekolah Asal</dt>
                                                <dd><?=$row->sekolah_asal;?></dd>
                                                <dt>Diterima dikelas</dt>
                                                <dd><?=$row->dikelas;?></dd>
                                                <dt>Pada Tanggal</dt>
                                                <dd><?=$row->pada_tanggal != '0000-00-00' ? indo_date($row->pada_tanggal) : '';?></dd>
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
                                    <a href="<?=site_url('siswa/update/'.$row->id);?>" class="btn btn-success"><i class="fa fa-edit"></i> PERBAHARUI DATA SISWA</a>
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