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
						Edit Siswa
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
						if ($detail['foto']) { ?>
							<div align="center">
								<img style="margin-bottom: 15px" src="<?php echo base_url().'foto/'.$detail['foto'];  ?>" width="150px" height="auto" >
							</div>
					<?php	}
					?>
					<!-- PAGE CONTENT BEGINS -->
					<?php 
						$attr = array('class' => 'form-horizontal', 'role' =>'form' );
						echo form_open_multipart(base_url().'admin/simpan_siswa', $attr); 
						echo form_hidden(array('ns'=> $detail['nis'], 'gambar' => $detail['foto'],) );?>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nis"> NIS / NISN  </label>
							<div class="col-sm-9">
								<span>
									<input class="col-sm-2 col-xs-4" type="text" id="nis" name="nis" value="<?php echo $detail['nis'];?>" placeholder="NIS" />
								</span>
								<span >
									<input style="margin-left: 10px" class="col-sm-3 col-xs-4" type="text" id="nisn" name="nisn" placeholder="NISN" value="<?php echo $detail['nisn'];?>"/>
								</span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nama"> Nama Lengkap  </label>
							<div class="col-sm-9">
								<input type="text" id="nama" name="nama" placeholder="Nama Lengkap" value="<?php echo $detail['nama'];?>" class="col-xs-10 col-sm-6" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="jk"> Jenis Kelamin  </label>
							<div class="col-sm-9">
  								<span><input type="radio" name="jk" value="L" <?php if ($detail['jk']=="L") {echo "checked";}?>> Laki-laki</span>
  								<span><input style="margin-left: 10px" type="radio" name="jk" value="P" <?php if ($detail['jk']=="P") {echo "checked";}?>> Perempuan</span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="tp"> Tempat / Tanggal Lahir </label>
							<div class="col-sm-9">
								<span>
									<input class="col-sm-2 col-xs-4" value="<?php echo $detail['tp_lahir'];?>" type="text" id="tp" name="tp_lahir" placeholder="Tempat Lahir" />
								</span>
								<span >
									<input style="margin-left: 10px" class="col-sm-3 col-xs-4" value="<?php echo $detail['tgl_lahir'];?>" type="text" id="tgl" name="tgl_lahir" placeholder="xx-xx-xxxx" />
								</span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="asal"> Sekolah Asal </label>
							<div class="col-sm-9">
								<input type="text" value="<?php echo $detail['sekolah_asal'];?>" id="asal" name="asal" placeholder="Sekolah Asal" class="col-xs-10 col-sm-5" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="masuk"> Tahun Masuk </label>
							<div class="col-sm-9">
								<input type="text" id="masuk" name="th_masuk" value="<?php echo $detail['th_masuk'];?>" placeholder="Tahun Masuk" class="col-xs-10 col-sm-5" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="kelas"> Kelas  </label>
							<div class="col-sm-9">
								<select name="kelas">
									<?php foreach ($kelas as $k) { ?>
										<option <?php if ($k->id == $dkelas['id_kelas']) {
											echo "selected";} ?> value='<?php echo $k->id; ?>'><?php echo $k->kelas.'-'.$k->jurusan; ?></option>";	
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="wali"> Nama Wali </label>
							<div class="col-sm-9">
								<input type="text" id="wali" name="wali" placeholder="Nama Wali" value="<?php echo $detail['wali'];?>" class="col-xs-10 col-sm-5" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="alamat"> Alamat </label>
							<div class="col-sm-9">
								<input type="text" id="alamat" value="<?php echo $detail['alamat'];?>" name="alamat" placeholder="Dusun / Desa" class="col-xs-10 col-sm-5" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="status"> Status Bayar  </label>
							<div class="col-sm-9">
								<select name="status">
									<option value="0" <?php if ($detail['status']=="0") {echo "selected";}?>>Reguler</option>
									<option value="1" <?php if ($detail['status']=="1") {echo "selected";}?>>Santunan</option>
									<option value="2" <?php if ($detail['status']=="2") {echo "selected";}?>>Beasiswa</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="foto"> Foto </label>
							<div class="col-sm-9">
								<input type="file" id="foto" name="foto" placeholder="Foto" class="col-xs-10 col-sm-5" />
							</div>
						</div>

						<div class="space-4"></div>

						<div class="clearfix form-actions">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn btn-info" type="submit">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Submit
								</button>
								&nbsp; 
								<button class="btn" type="reset">
									<i class="ace-icon fa fa-refresh bigger-110"></i>
									Reset
								</button>
								&nbsp; 
								<a href="<?php echo base_url().'admin/siswa'; ?>">
									<button class="btn" type="button">
										<i class="ace-icon fa fa-undo bigger-110"></i>Kembali
									</button>
								</a>
							</div>
						</div>

						<div class="hr hr-24"></div>

						
					</form>

<?php include "footer.php" ?>