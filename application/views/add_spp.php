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
					Pembayaran
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Perawatan Lab
					</small>
				</h1>
			</div><!-- /.page-header -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
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
					<!-- PAGE CONTENT BEGINS -->
					<?php 
						$attr = array('class' => 'form-horizontal', 'role' =>'form' );
						echo form_open_multipart(base_url().'admin/simpan_spp', $attr); 
						echo form_hidden('nis', $siswa['nis']);
						echo form_hidden('nama', $siswa['nama']);
					?>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nama"> Nama :</label>
							<div class="col-sm-9" style="align-content: left">
								<label class="control-label no-padding-right" for="nama"><b><?php echo $siswa['nama']." (".$siswa['nis'].")" ?></b></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="kelas"> Kelas :</label>
							<div class="col-sm-9" style="align-content: left">
								<label class="control-label no-padding-right" for="kelas"><b>
									<?php 
										foreach ($kelas as $kl) {
											if ($dkelas['id_kelas']==$kl->id) {
												echo $kl->kelas."-".$kl->jurusan;
											}
										} 
									?></b></label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="tgl"> Tanggal Bayar :</label>
							<div class="col-sm-9">
								<input type="date" id="tgl" name="tgl" placeholder="Tanggal Bayar" class="col-xs-10 col-sm-6" <?php echo 'value='.$skr; ?> />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 col-xs-9 control-label no-padding-right" for="tipe"> Bulan :<br/> Sudah bayar : <?php echo $jml_spp; ?> bulan.</label>
							<div class="col-sm-6 col-xs-12">
								<?php
								$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
								$jlh_bln=count($bulan);
								$sk = intval(date('m'))-1;
								$nam = "";
								for($c=0; $c<$jlh_bln; $c+=1){
									echo "<div class='col-sm-4'>";
									$nam=$nam;
										if ($c == $sk ) { $sel = "checked";}else{ $sel="";} 
								?>
								    	<input type="checkbox" <?php echo $sel; ?> 
								    	<?php  
								    		if ($nam=='name="by_l"') {

								    		}else{ 
								    			foreach ($spp as $ss) { 
								    				if ($ss->bulan == $c) {
								    					$nam='name="by_l"';
								    				}else{ 
								    					echo 'name="by_b[]"';
								    				}
								    			}
								    		} sini: 
								    		echo $nam;  ?> value="<?php echo $c; ?>" <?php echo $sel; ?> 
								    		<?php 
								    		foreach ($spp as $ss) { 
								    			if ($ss->bulan == $c) {
								    				echo "checked disabled";
								    			}else{ 
								    				echo "";
								    			}
								    		} 
								    		?>> 
								    		<?php echo $bulan[$c]; ?> 
								    		<?php 
								    		foreach ($spp as $ss) { 
								    			if ($ss->bulan == $c) {
								    				echo "<i>(lunas)</i>";
								    			}
								    		} ?></option>
								<?php
									$nam="";
									echo "</div>";
								}
								?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="oleh"> Dibayar :</label>
							<div class="col-sm-9">
								<select id="oleh" name="oleh">
									<option value="0">Siswa</option>
									<option value="1">Wali</option>
									<option value="2">Lain</option>
								</select>
							</div>
						</div>

						<div class="space-4"></div>

						<div class="clearfix form-actions">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn btn-success" type="submit">
									<i class="ace-icon fa fa-money bigger-100"></i>
									Bayar
								</button>
								&nbsp;
								<button class="btn" type="reset">
									<i class="ace-icon fa fa-refresh bigger-100"></i>
									Reset
								</button>
								&nbsp; 
								<a href="<?php echo base_url().'admin/spp'; ?>">
									<button class="btn btn-danger" type="button">
										<i class="ace-icon fa fa-undo bigger-100"></i>Batal
									</button>
								</a>
							</div>
						</div>

						<div class="hr hr-24"></div>

						
					</form>
 
								
<?php include "footer.php" ?>