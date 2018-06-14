<?php include "head.php" ?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url(); ?>">Home</a>
				</li>
				<li class="active"><?php echo $menu; ?></li>
			</ul><!-- /.breadcrumb -->

		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					MASTER
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Tambah Data Guru / Admin
					</small>
				</h1>
			</div><!-- /.page-header -->

			<div class="row">
				<div class="col-xs-12">
					<?php 
						if ($this->session->flashdata('error')) {?>
							<div class="alert alert-danger alert-dismissible fade in">
  								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  								<strong>Perhatian!</strong> <?php echo $this->session->flashdata('error'); ?>
							</div>	
					<?php	}
					?>
					<!-- PAGE CONTENT BEGINS -->
					<?php 
						$attr = array('class' => 'form-horizontal', 'role' =>'form' );
						echo form_open_multipart(base_url().'admin/simpan_guru', $attr); ?>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nama"> Nama Lengkap  </label>
							<div class="col-sm-9">
								<input type="text" id="nama" name="nama" placeholder="Nama Lengkap" class="col-xs-10 col-sm-6" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="uname"> Username </label>
							<div class="col-sm-9">
								<input type="text" id="unae" name="uname" placeholder="Username" class="col-xs-10 col-sm-6" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="pw1"> Password  </label>
							<div class="col-sm-9">
								<input type="text" id="pw1" name="pw1" placeholder="Password" class="col-xs-10 col-sm-6" />
							</div>
						</div>

						<!--<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="jk"> Jenis Kelamin  </label>
							<div class="col-sm-9">
  								<span><input type="radio" name="jk" value="L" checked> Laki-laki</span>
  								<span><input style="margin-left: 10px" type="radio" name="jk" value="P"> Perempuan</span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="tp"> Tempat / Tanggal Lahir </label>
							<div class="col-sm-9">
								<span>
									<input class="col-sm-2 col-xs-4" type="text" id="tp" name="tp_lahir" placeholder="Tempat Lahir" />
								</span>
								<span >
									<input style="margin-left: 10px" class="col-sm-3 col-xs-4" type="text" id="tgl" name="tgl_lahir" placeholder="xx-xx-xxxx" />
								</span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="asal"> Sekolah Asal </label>
							<div class="col-sm-9">
								<input type="text" id="asal" name="asal" placeholder="Sekolah Asal" class="col-xs-10 col-sm-5" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="masuk"> Tahun Masuk </label>
							<div class="col-sm-9">
								<input type="text" id="masuk" name="th_masuk" placeholder="Tahun Masuk" class="col-xs-10 col-sm-5" />
							</div>
						</div>-->

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="alamat"> Alamat </label>
							<div class="col-sm-9">
								<textarea class="col-sm-9 col-xs-5" name="alamat" placeholder="Alamat Lengkap" rows="3"></textarea>		
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="tipe"> Hak Akses  </label>
							<div class="col-sm-9">
								<select name="tipe">
									<option value="1">Admin</option>
									<option value="2">Guru</option>
									<option value="3">Wali</option>								
								</select>
							</div>
						</div>

						<div class="space-4"></div>

						<div class="clearfix form-actions">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn btn-info" type="submit">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Submit
								</button>
								&nbsp; &nbsp; &nbsp;
								<button class="btn" type="reset">
									<i class="ace-icon fa fa-refresh bigger-110"></i>
									Reset
								</button>
								&nbsp; &nbsp; &nbsp;
								<a href="<?php echo base_url().'admin/guru'; ?>">
									<button class="btn" type="button">
										<i class="ace-icon fa fa-undo bigger-110"></i>Kembali
									</button>
								</a>
							</div>
						</div>

						<div class="hr hr-24"></div>

						
					</form>

<?php include "footer.php" ?>