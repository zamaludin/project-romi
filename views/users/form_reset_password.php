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
    $("#btn-reset-password").click(function(){
        var formAction = $("#reset-password").attr('action');
        var postData = {
            password: $("#password").val()
        };

        if (!$("#password").val() || !$("#c_password").val()) {
            $("#warning").show('fast').delay(2000).hide('fast');
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: formAction,
                data: postData,
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(result) {
                    if(result == '1') {
                        $('#loading').hide('fast');
                        $("#success").show('fast');
                        setTimeout(function() {
                            window.location = '<?=base_url();?>login';
                        }, 1000);
                    }
                    else
                    {
                        $('#loading').hide('fast');
                        $("#failed").show('fast').delay(2000).hide('fast');
                        $('#password').val('');
                        $('#c_password').val('');
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
				<h3 class="text-center">RESET PASSWORD</h3>
			</div>
			<div>
				<form id="reset-password" action="<?=$action;?>" style="margin-bottom: 0px !important;" class="form-horizontal" method="post">
					<div class="content">
                        <img id="loading" style="display:none;" src="<?=base_url();?>assets/loading.gif">
                        <div id="success" class="alert alert-success alert-white rounded" style="display:none;">
                            <div class="icon"><i class="fa fa-check"></i></div>
                            <strong>Reset Password Success !</strong>
                         </div>
                        <div id="warning" class="alert alert-warning alert-white rounded" style="display:none;">
                            <div class="icon"><i class="fa fa-warning"></i></div>
                            <strong>Peringatan !</strong>
                            <br>Kata sandi tidak boleh kosong!
                        </div>
                        <div id="failed" class="alert alert-danger alert-white rounded"style="display:none;">
                            <div class="icon"><i class="fa fa-times-circle"></i></div>
                            <strong>Reset Password Gagal !</strong>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input id="password" name="password" type="password" placeholder="Masukan kata sandi baru" class="form-control">
                                </div>
                            </div>
                        </div>
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input id="c_password" name="c_password" type="password" placeholder="Ulangi kata sandi baru" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="foot">
                        <a href="<?=site_url('login');?>" class="btn btn-default">Log In</a>
						<button id="btn-reset-password" class="btn btn-primary" type="submit">Reset Password</button>
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