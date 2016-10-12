<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
    <h1><i class="fa fa-user text-green"></i> <?=$title;?></h1>
</section>
<section class="content">
    <?=$alert;?> 
    <?=form_open($action, array('role' => 'form', 'class'=>'form-horizontal form-bordered'));?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-2 control-label">Email</label>
                <div class="col-md-10">
                    <input autofocus required type="text" class="form-control" name="email" value="<?=(set_value('email')) ? set_value('email') : $query['email']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama lengkap</label>
                <div class="col-md-10">
                    <input required type="text" class="form-control" name="display_name" value="<?=(set_value('display_name')) ? set_value('display_name') : $query['display_name']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Nama Akun</label>
                <div class="col-md-10">
                    <input required type="text" class="form-control" name="username" value="<?=(set_value('username')) ? set_value('username') : $query['username']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Kata Sandi</label>
                <div class="col-md-10">
                    <input type="password" class="form-control" name="password">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Ulangi Kata Sandi</label>
                <div class="col-md-10">
                    <input type="password" class="form-control" name="c_password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-success btn-sm btn-flat"><i class="fa fa-save"></i> <?=$button;?></button>
                    <a href="<?=site_url('users');?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-angle-double-left"></i> KEMBALI</a>
                </div>
            </div>
        </div>
    </form>
</section>