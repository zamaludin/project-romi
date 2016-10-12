<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-user text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <div class="row">
        <?=form_open($action);?>
        <input type="hidden" name="url" value="<?=current_url();?>">
        <div class="col-md-12">
            <?=$alert;?>       
            <div class="btn-group" style="margin-bottom:10px;">
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
                            echo '<a href="'.site_url('ppdb/seleksi/index/'.$tahun->tahun).'">Tahun ';
                            echo $tahun->tahun;
                            echo '</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
                <?php } ?>
            </div>

            <div class="form-group" style="margin-left:-15px; margin-bottom:50px;">
                <div class="col-md-6" style="margin-right:-15px;">
                    <select required class="form-control" name="hasil_seleksi">
                        <option value="">Pilih Hasil Seleksi :</option>
                        <?php
                        if ($this->setting['jenjang'] == 'SMK')
                        {
                            echo '<option value="tidak_diterima">Tidak Diterima</option>';
                            foreach ($q_jurusan->result() as $jurusan)
                            {
                                echo '<option value="'.$jurusan->jurusan_id.'">Diterima di jurusan '.$jurusan->jurusan.'</option>';
                            }
                        }
                        else
                        {
                            echo '<option value="diterima">Diterima</option>';
                            echo '<option value="tidak_diterima">Tidak Diterima</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <button type="submit" name="simpan" class="btn btn-success btn-flat"><i class="fa fa-save"></i> SIMPAN HASIL SELEKSI</button>
                </div>
            </div>

            <div class="box-body">
                <?php if ($query->num_rows() > 0 ) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th style="width:10px"><input type="checkbox" id="check-all"/></th>
                        <th style="width:10px;">NO</th>
                        <th>NAMA</th>
                        <th width="15%">NO. PENDAFTARAN</th>
                        <th>TANGGAL PENDAFTARAN</th>
                        <th>TK ASAL</th>
                        <th>JENIS KELAMIN</th>
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
                        <td><?=$row->sekolah_asal;?></td>
                        <td><?=$row->jenis_kelamin;?></td>
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