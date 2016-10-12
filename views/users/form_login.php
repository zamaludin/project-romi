<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="http://inorobo.com">
    <meta name="keywords" content="<?=$nama_sekolah?>">
    <meta name="description" content="<?=$nama_sekolah?>">
    <link rel="shortcut icon" href="<?=base_url();?>assets/icon.png">
    <title><?=$nama_sekolah?></title>
    <link rel="stylesheet" href="<?=base_url();?>assets/login/js/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/login/fonts/font-awesome-4/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/login/css/style.css"/>
    <script src="<?=base_url();?>assets/login/js/jquery.js"></script>
</head>
<body class="texture">
<script type="text/javascript">
$(document).ready(function(){
    $("#btn-login").click(function(){
        var formAction = $("#login").attr('action');
        var datalogin = {
            username: $("#username").val(),
            password: $("#password").val()
        };

        if (!$("#username").val() || !$("#password").val()) {
            $("#warning").show('fast').delay(2000).hide('fast');
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: formAction,
                data: datalogin,
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(result) {
                    if(result == 1) {
                        $('#loading').hide('fast');
                        $("#success").show('fast');
                        setTimeout(function() {
                            window.location = '<?=base_url();?>dashboard';
                        }, 1000);
                    } else {
                        $('#loading').hide('fast');
                        $("#failed").show('fast').delay(2000).hide('fast');
                        $('#username').val('');
                        $('#password').val('');
                        return false;
                    }
                }
            });
            return false;
        }
    });    
});
</script>

<div id="cl-wrapper" class="login-container">
	<div class="middle-login">
		<div class="block-flat">
			<div class="header">							
				<h3 class="text-center"><?=strtoupper($nama_sekolah)?></h3>
			</div>
			<div>
				<form id="login" action="<?=$action;?>" style="margin-bottom: 0px !important;" class="form-horizontal" method="post">
					<div class="content">
                        <img id="loading" style="display:none;" src="<?=base_url();?>assets/loading.gif">
                        <div id="success" class="alert alert-success alert-white rounded" style="display:none;">
                            <div class="icon"><i class="fa fa-check"></i></div>
                            <strong>Login Success !</strong>
                            <br>Halaman akan dialihkan dalam waktu 3 detik! 
                            <br>Tidak diarahkan otomatis ? klik <?=anchor(site_url('dashboard'), 'disini');?>
                         </div>
                        <div id="warning" class="alert alert-warning alert-white rounded" style="display:none;">
                            <div class="icon"><i class="fa fa-warning"></i></div>
                            <strong>Peringatan !</strong>
                            <br>Nama akun dan/atau kata sandi tidak boleh kosong!
                        </div>
                        <div id="failed" class="alert alert-danger alert-white rounded"style="display:none;">
                            <div class="icon"><i class="fa fa-times-circle"></i></div>
                            <strong>Login gagal !</strong>
                            <br>Nama akun dan/atau kata sandi salah!
                        </div>						
                        <div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input autofocus id="username" name="username" type="text" placeholder="Nama Akun" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input id="password" name="password" type="password" placeholder="Kata Sandi" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="foot">
                        <a href="<?=site_url('lost_password');?>" class="btn btn-default">Lost your account ???</a>
						<button id="btn-login" class="btn btn-primary" type="submit">Log in</button>
					</div>
				</form>
			</div>
		</div>
		<div class="text-center out-links" style="color:white;">
			<?=copyright();?> <?=str_replace('http://', '', rtrim(base_url(), '/'));?>. All Rights Reserved
            <br>
            Back to <a href="<?=base_url()?>"><?=$nama_sekolah?></a>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?=base_url();?>assets/login/js/behaviour/general.js"></script>
<script src="<?=base_url();?>assets/login/js/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>