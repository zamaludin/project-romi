<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-wrench text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <div class="row">
        <?=form_open('set_kelas/create');?>
        <input type="hidden" name="url" value="<?=current_url();?>">
        <div class="col-md-12">
            <?=$alert;?>       
            <div class="btn-group" style="margin-bottom:10px;">
                <select name="kelas_tujuan" class="btn" style="border-top:1px solid #e7e7e7;">
                    <?php foreach($q_kelas->result() as $kelas) { ?>
                    <option value="<?=$kelas->kelas_id;?>">
                        Kelas <?=$kelas->kelas;?>
                    </option>
                    <?php } ?>
                </select>
                <button type="submit" name="submit" class="btn btn-sm btn-warning btn-flat"><i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;SIMPAN PENGATURAN</button>
            </div>
            <div class="box-body">
                <?php if ($query->num_rows() > 0 ) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th style="width:10px"><input type="checkbox" id="check-all"/></th>
                        <th style="width:10px;">NO</th>
                        <th>NO DAFTAR</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>NAMA</th>
                        <th>JENIS KELAMIN</th>
                    </tr>
                    <?php 
                    $no = 1;
                    foreach ($query->result() as $row) { ?>
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="id[]" value="<?=$row->id;?>" /></td>
                        <td><?=$no;?></td>
                        <td><?=$row->no_daftar;?></td>
                        <td><?=$row->nis;?></td>
                        <td><?=$row->nisn;?></td>
                        <td><?=$row->nama;?></td>
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
        </div>
        </form>
    </div>
</section>