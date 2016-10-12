<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?=$site_title;?> | <?=$version;?></title>
        <meta name="description" content="<?=$meta_description;?>">
        <meta name="keywords" content="<?=$meta_keywords;?>">
        <meta name="author" content="<?=$author;?>">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="<?=base_url('assets/icon.png');?>">
        <link href="<?=base_url('assets/backend/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets/backend/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets/backend/css/ionicons.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets/backend/css/AdminLTE.css');?>" rel="stylesheet" type="text/css" />
        <script src="<?=base_url('assets/backend/js/jquery.min.js');?>"></script>
        <script src="<?=base_url('assets/ckeditor/ckeditor.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/backend/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/backend/js/AdminLTE/app.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/backend/js/plugins/iCheck/icheck.min.js');?>" type="text/javascript"></script>
    </head>
    <body class="skin-black">
        <header class="header">
            <a href="<?=site_url('dashboard');?>" class="logo">CONTROL PANEL</a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?=$this->session->userdata('display_name');?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <img src="<?=base_url('assets/images/' . $this->setting['logo']);?>" alt="<?=$this->setting['nama_sekolah'];?>" />
                                    <p>
                                        <?=$this->session->userdata('display_name');?>
                                        <small><?=$this->setting['nama_sekolah'];?></small>
                                        <small><?=$this->config->item('apps');?> <?=$this->config->item('version');?></small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?=site_url('users/update');?>" class="btn btn-default btn-flat">Profil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?=site_url('logout');?>" class="btn btn-default btn-flat">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <?php $this->load->view('backend/sidebar');?>
                </section>
            </aside>
            <aside class="right-side">
                <?php $this->load->view($content);?>
            </aside>
        </div>
    </body>
</html>