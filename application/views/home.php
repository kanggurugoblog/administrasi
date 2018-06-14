<?php include "head.php" ?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url(); ?>">Home</a>
				</li>
				<li class="active">Dashboard</li>
			</ul><!-- /.breadcrumb -->

		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					Dashboard
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						overview &amp; stats
					</small>
				</h1>
			</div><!-- /.page-header -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<div class="alert alert-block alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>

						<i class="ace-icon fa fa-check green"></i>
						Selamat datang di
						<strong class="green">
							SISTEM ADMINISTRASI <?php echo $ini['sekolah']; ?>
							<small>(v1.0)</small>
						</strong>,
	Aplikasi digunakan melakukan pendataan administrasi siswa.<br/> <a href="https://facebook.com/kanggurugoblog/" target="_blank">My Facebook</a>....!!
					</div>

								
<?php include "footer.php" ?>