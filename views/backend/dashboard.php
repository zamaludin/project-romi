<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-dashboard text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?=$alert;?>
            <div class="box-body">
                <?php if ($this->session->userdata('level') == 'administrator'|| $this->session->userdata('level') == 'operator') { ?>
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3><?=$count_inbox;?></h3>
                                <p>Pesan Masuk</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <a href="<?=site_url('kotak_masuk');?>" class="small-box-footer">
                                <i class="fa fa-arrow-circle-right"></i> 
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3><?=$count_ptk;?></h3>
                                <p>Pengajar / Trainer</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="<?=site_url('ptk');?>" class="small-box-footer">
                                <i class="fa fa-arrow-circle-right"></i> 
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3><?=$count_ppdb;?></h3>
                                <p>Calon Siswa Baru Tahun <?=$this->setting['ppdb_tahun'];?></p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <?php
                            if ($this->setting['jenjang'] == 'SD') {
                                $link = 'ppdb-sd/siswa';
                            } else if($this->setting['jenjang'] == 'SMP' OR $this->setting['jenjang'] == 'SMA') {
                                $link = 'ppdb/siswa';
                            } else if($this->setting['jenjang'] == 'SMK') {
                                $link = 'ppdb-smk/siswa';
                            }
                            ?>
                            <a href="<?=site_url($link);?>" class="small-box-footer">
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3><?=$count_posts;?></h3>
                                <p>Tulisan</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-thumb-tack"></i>
                            </div>
                            <a href="<?=site_url('posts');?>" class="small-box-footer">
                                <i class="fa fa-arrow-circle-right"></i> 
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3><?=$count_pages;?></h3>
                                <p>Halaman</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-files-o"></i>
                            </div>
                            <a href="<?=site_url('pages');?>" class="small-box-footer">
                                <i class="fa fa-arrow-circle-right"></i> 
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h3><?=$count_file;?></h3>
                                <p>File</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-paperclip"></i>
                            </div>
                            <a href="<?=site_url('file');?>" class="small-box-footer">
                                <i class="fa fa-arrow-circle-right"></i> 
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-teal">
                            <div class="inner">
                                <h3><?=$count_photo;?></h3>
                                <p>Gallery Photo</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-picture-o"></i>
                            </div>
                            <a href="<?=site_url('photo');?>" class="small-box-footer">
                                <i class="fa fa-arrow-circle-right"></i> 
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-maroon">
                            <div class="inner">
                                <h3>&nbsp;</h3>
                                <p>Why Should Be Robotic</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-microphone"></i>
                            </div>
                            <a href="<?=site_url('why_robotic');?>" class="small-box-footer">
                                <i class="fa fa-arrow-circle-right"></i> 
                            </a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="box box-solid box-warning">
                <div class="box-header">
                    <h3 class="box-title">Pesan Baru</h3>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <?php foreach($inbox->result() as $row) { ?>
                            <tr>
                                <td width="2%"><i class="fa fa-envelope-o"></i></td>
                                <td width="20%"><?=$row->nama;?></td>
                                <td width="48%"><?=substr($row->pertanyaan, 0, 100);?><?=strlen($row->pertanyaan) > 100 ? '...' : '';?></td>
                                <td width="30%"><?=$row->tanggal;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>            
        </div>
        <div class="col-md-6">
            <div class="box box-solid box-danger">
                <div class="box-header">
                    <h3 class="box-title">Agenda Kegiatan</h3>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <?php foreach($agenda->result() as $row) { ?>
                            <tr>
                                <td width="2%"><i class="fa fa-calendar"></i></td>
                                <td width="48%"><?=$row->post_title;?></td>
                                <td width="50%"><?=indo_date($row->post_date);?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>