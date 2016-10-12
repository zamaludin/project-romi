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
    $("#btn-reset").click(function(){
        var action = $("#reset").attr('action');
        var postData = {
            email: $("#email").val()
        };

        if ($("#email").val() == "") {
            $("#warning").show('fast').delay(2000).hide('fast');
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: action,
                data: postData,
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(result) {
                    if(result == '1') {
                        $('#loading').hide('fast');
                        $("#success").show('fast');
                        setTimeout(function() {
                            $("#success").hide('fast');
                            $("#email").val('');
                        }, 7000);
                    } else if(result == '2') {
                        $('#loading').hide('fast');
                        $("#failed").show('fast');
                        setTimeout(function() {
                            $("#failed").hide('fast');
                            $("#email").val('');
                        }, 7000);
                    } else if(result == '0') {
                        $('#loading').hide('fast');
                        $("#warning").show('fast');
                        setTimeout(function() {
                            $("#warning").hide('fast');
                            $("#email").val('');
                        }, 7000);
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
				<h3 class="text-center">RESET PASSWORD</h3>
			</div>
			<div>
				<form id="reset" action="<?=$action;?>" style="margin-bottom: 0px !important;" class="form-horizontal" method="post">
					<div class="content">
                        <img id="loading" style="display:none;" src="<?=base_url();?>assets/loading.gif">
                        <div id="success" class="alert alert-success alert-white rounded" style="display:none;">
                            <div class="icon"><i class="fa fa-check"></i></div>
                            <strong>Reset password sukses !</strong>
                            <br>Periksa email anda, link untuk mengganti kata sandi kami kirimkan melalui email.
                         </div>
                        <div id="warning" class="alert alert-warning alert-white rounded" style="display:none;">
                            <div class="icon"><i class="fa fa-warning"></i></div>
                            <strong>Peringatan !</strong>
                            <br>Email tidak boleh kosong!
                        </div>
                        <div id="failed" class="alert alert-danger alert-white rounded"style="display:none;">
                            <div class="icon"><i class="fa fa-times-circle"></i></div>
                            <strong>Reset password gagal !</strong>
                            <br>Email yang anda masukan salah!
                        </div>
                        <div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input autofocus id="email" name="email" type="text" placeholder="Masukan email anda" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="foot">
                        <a href="<?=site_url('login');?>" class="btn btn-default">Log In</a>
						<button id="btn-reset" class="btn btn-primary" type="submit">Send new password</button>
					</div>
				</form>
			</div>
		</div>
		<div class="text-center out-links" style="color:white;">
			<?=copyright();?> <?=base_url()?>. All Rights Reserved
            <br>
            <?=$nama_sekolah?>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?=base_url();?>assets/login/js/behaviour/general.js"></script>
<script src="<?=base_url();?>assets/login/js/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>