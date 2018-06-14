<?php 
	$ini = $this->session->userdata('datalog'); 
	$user = $this->session->userdata('log');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
 	<title>Log in | <?php echo $ini['sekolah']; ?></title>
 	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
 	<!-- Bootstrap 3.3.2 -->
 	<link href="<?php echo base_url('assets/admin/assets/css/bootstrap.min.css'); ?>" rel="stylesheet" >
 	<!-- Font Awesome Icons -->
 	<link href="<?php echo base_url('assets/admin/assets/css/font-awesome.min.css'); ?>" rel="stylesheet">
 	<!-- Theme style -->
 	<link href="<?php echo base_url('assets/admin/assets/css/AdminLTE.min.css'); ?>" rel="stylesheet">
 	<!-- iCheck -->
 	<link href="<?php echo base_url('assets/admin/assets/css/blue.css'); ?>" rel="stylesheet">
</head>

<body class="login-page">
	<div class="login-box">
 		<div class="login-logo">
 			<!--<a href="#" ><b><?php echo $ini['sekolah']; ?></b></a>-->
 			<img src="<?php echo base_url('assets/admin/assets/images/logo.png'); ?>" width="50%">
 		</div><!-- /.login-logo -->
 		
 		<div class="login-box-body">
 			<p class="login-box-msg">Silahkan Login....!!!!</p>
				<?php 
						if ($this->session->flashdata('sukses')) {?>
							<div class="alert alert-success alert-dismissible fade in">
  								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  								<strong>Sukses : </strong> <?php echo $this->session->flashdata('sukses'); ?>
							</div>
					<?php	
						}
						if ($this->session->flashdata('error')) {?>
							<div class="alert alert-danger alert-dismissible fade in">
  								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  								<strong>Perhatian : </strong> <?php echo $this->session->flashdata('error'); ?>
							</div>
					<?php	}
					?>
 			<!--<form action="<?php echo site_url('login/proses'); ?>" method="post">-->
 				<?php
 					echo form_open(base_url().'login/proses_login');	
 					if (validation_errors() || $this->session->flashdata('result_login')) {
 				?>
 				
 				<div class="alert alert-error">
 					<button type="button" class="close" data-dismiss="alert">&times;</button>
 					<strong>Warning!</strong>
 					<?php echo validation_errors(); ?>
 					<?php echo $this->session->flashdata('result_login'); ?>
 				</div>
 				<?php } ?>
 				
 				<div class="form-group has-feedback">
 					<input type="text" name="uname" class="form-control" placeholder="Username"/>
 					<span class="glyphicon glyphicon-user form-control-feedback"></span>
 				</div>
 				
 				<div class="form-group has-feedback">
 					<input type="password" name="pwd" class="form-control" placeholder="Password"/>
 					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
 				</div>
 				
 				<div class="row">
 					<div class="col-xs-8">
 						<!--<div class="checkbox icheck">
 							<label>
 								<input type="checkbox"> Remember Me
 							</label>
 						</div>-->
 					</div><!-- /.col -->
 					
 					<div class="col-xs-4">
		 				<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
 					</div><!-- /.col -->
 				</div>
 			</form>
 	
 			<div class="social-auth-links text-center">
 				<!--<p>- OR -</p>
 				<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
 				<a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>-->
			</div><!-- /.social-auth-links -->
 			<!--<a href="#">I forgot my password</a><br>
 			<a href="register.html" class="text-center">Register a new membership</a>-->
 		</div><!-- /.login-box-body -->
 	</div><!-- /.login-box -->
 	<!-- jQuery 2.1.3 -->
 	<script src="<?php echo base_url('assets/admin/assets/js/jQuery-2.1.4.min.js'); ?>"></script>
 	<!-- Bootstrap 3.3.2 JS -->
 	<script src="<?php echo base_url('assets/admin/assets/js/bootstrap.min.js'); ?>"></script>
 	<!-- iCheck -->
 	<script src="<?php echo base_url('assets/admin/assets/js/icheck.min.js'); ?>"></script>
 	<script>
 		$(function () {
 			$('input').iCheck({
 				checkboxClass: 'icheckbox_square-blue',
 				radioClass: 'iradio_square-blue',
 				increaseArea: '20%' // optional
 			});
 		});
 	</script>
 </body>
 </html>