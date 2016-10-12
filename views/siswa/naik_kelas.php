<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-level-up text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <div class="row">
        <?=form_open('naik_kelas/create');?>
        <input type="hidden" name="url" value="<?=current_url();?>">
        <div class="col-md-12">
            <?=$alert;?>       
            <div class="btn-group" style="margin-bottom:10px;">
                <?php if ($q_kelas->num_rows() > 0) { ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-flat">PILIH KELAS ASAL</button>
                    <button type="button" class="btn btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                        foreach($q_kelas->result() as $kelas) {
                            echo '<li>';
                            echo '<a href="'.site_url('naik_kelas/index/'.$kelas->kelas_id).'">Kelas ';
                            echo $kelas->kelas;                            
                            echo '</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
                <?php } ?>
                <select name="kelas_tujuan" class="btn" style="border-top:1px solid #e7e7e7;">
                    <?php foreach($q_kelas->result() as $kelas) { ?>
                    <option value="<?=$kelas->kelas_id;?>">
                        Naik ke kelas <?=$kelas->kelas;?>
                    </option>
                    <?php } ?>
                    <option value="lulus">Lulus</option>
                </select>
                <button type="submit" name="submit" class="btn btn-sm btn-primary btn-flat"><i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;&nbsp;PROSES</button>
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
                    </tr>
                    <?php 
                    $no = 1;
                    foreach ($query->result() as $row) { ?>
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="id[]" value="<?=$row->id;?>" /></td>
                        <td><?=$no;?></td>
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