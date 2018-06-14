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
						Edit Data Tagihan
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
						echo form_open_multipart(base_url().'admin/update_tagihan', $attr); 
						echo form_hidden('id', $detail['id']);
					?>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="jenis"> Jenis  </label>
							<div class="col-sm-9">
								<input type="text" id="jenis" name="jenis" placeholder="Jenis Tagihan" value="<?php echo $detail['jenis']; ?>" class="col-xs-10 col-sm-6" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="ket"> Keterangan </label>
							<div class="col-sm-9">
								<input type="text" id="ket" name="ket" placeholder="Keterangan" value="<?php echo $detail['keterangan']; ?>"class="col-xs-10 col-sm-6" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="jml"> Nominal  </label>
							<div class="col-sm-9">
								<input type="number" step="500" id="jml" name="jml" value="<?php echo $detail['nominal']; ?>" placeholder="Jumlah Tagihan" class="col-xs-10 col-sm-6" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="tempo"> Jatuh Tempo  </label>
							<div class="col-sm-9">
								<input type="date" id="tempo" name="tempo" placeholder="Jatuh Tempo" value="<?php echo $detail['jatuh_tempo']; ?>" class="col-xs-10 col-sm-6" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 col-xs-9 control-label no-padding-right" for="kelas"> Kelas  </label>
							<div class="col-sm-7 col-xs-12">
								<span class="col-sm-3 col-xs-12"><input  type="checkbox" name="kl" value="0" <?php if ($detail['kelas']=='0') {echo "checked";}?>> Semua Kelas</span>
								<?php
									$kls = explode(', ', $detail['kelas']);
									$dk = count($kls);
									foreach ($kelas as $a) { ?>
										<span class="col-sm-3 col-xs-12">
											<input  type="checkbox" name="kelas[]" value="<?php echo $a->id; ?>" <?php	for ($x = 0; $x <$dk; $x++){ if (intval($a->id)==intval($kls[$x])) { echo 'checked';}else{echo '';}} 
											?>  >	<?php echo $a->kelas.'-'.$a->jurusan; ?>
										</span>
								<?php	};
								?>
							</div>
						</div>

						<div class="space-4"></div>

						<div class="clearfix form-actions">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn btn-info" type="submit">
									<i class="ace-icon fa fa-check bigger-100"></i>
									Submit
								</button>
								&nbsp;
								<button class="btn" type="reset">
									<i class="ace-icon fa fa-refresh bigger-100"></i>
									Reset
								</button>
								&nbsp; 
								<a href="<?php echo base_url().'admin/administrasi'; ?>">
									<button class="btn" type="button">
										<i class="ace-icon fa fa-undo bigger-100"></i>Kembali
									</button>
								</a>
							</div>
						</div>

						<div class="hr hr-24"></div>

						
					</form>

<?php include "footer.php" ?>