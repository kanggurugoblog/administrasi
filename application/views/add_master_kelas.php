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
						Tambah Kelas
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
						echo form_open(base_url().'admin/simpan_master_kelas', $attr); ?>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="kelas"> Kelas </label>
							<div class="col-sm-4">
								<input type="text" id="kelas" name="kelas" placeholder="Kelas" class="col-xs-10 col-sm-5" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="jurusan"> Jurusan </label>
							<div class="col-sm-6">
								<input type="text" id="jurusan" name="jurusan" placeholder="Jurusan" class="col-xs-10 col-sm-5" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="ket"> Keterangan </label>
							<div class="col-sm-9">
								<input type="text" id="ket" name="ket" placeholder="Keterangan" class="col-xs-10 col-sm-5" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="walas"> Wali Kelas </label>
							<div class="col-sm-6">
								<select id="walas" name="walas" class="col-xs-10 col-sm-5">
									<?php
										foreach ($guru as $a) {?>
											<option value="<?php echo $a->id; ?>"><?php echo $a->nama; ?></option>
											
									<?php	} ?>
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
								<a href="<?php echo base_url().'admin/kelas'; ?>"><button class="btn" type="button">
									<i class="ace-icon fa fa-undo bigger-110"></i>
									Kembali
								</button></a>
							</div>
						</div>

						</form>



								
<?php include "footer.php" ?>