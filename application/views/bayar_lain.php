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
						LAIN-LAIN
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
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<div class="col-sm-6 col-xs-6">
					<!-- PAGE CONTENT BEGINS -->
					<?php 
						$attr = array('class' => 'form-horizontal', 'role' =>'form' );
						echo form_open_multipart(base_url().'admin/tambah_lain', $attr); 
						echo form_hidden('nis', $siswa['nis']);
						echo form_hidden('nama', $siswa['nama']);
						echo form_hidden('id', $id);
					?>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nama"> Nama :</label>
							<div class="col-sm-4" style="align-content: left">
								<label class="control-label no-padding-right" for="nama"><b><?php echo $siswa['nama']." (".$siswa['nis'].")" ?></b></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="kelas"> Kelas :</label>
							<div class="col-sm-4" style="align-content: left">
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
							<div class="col-sm-6">
								<input type="date" id="tgl" name="tgl" placeholder="Tanggal Bayar" class="col-xs-10 col-sm-10" <?php echo 'value='.$skr; ?> />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="jenis"> Pembayaran :</label>
							<div class="col-sm-4">
								<select name="jenis">
									<?php 
										foreach ($tagihan as $b) {
										$harga = number_format($b->nominal, "0", ",", ".");
											if (isset($bayar)) {
												foreach ($bayar as $k) {
													if ($k->id_tagihan == $b->id) {
														//echo "<option>------------------</i></option>";
														//break;
													}else{
														echo "<option value='".$b->id."/".$b->nominal."'>".$b->jenis." <i>(Rp.".$harga.".-)</i></option>";
														//break;			
													}
												}
											}else{
												echo "<option value='".$b->id."/".$b->nominal."'>".$b->jenis." <i>(Rp.".$harga.".-)</i></option>";
											}									
										} 
									?> 
									<option value=""></option>	
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="oleh"> Dibayar :</label>
							<div class="col-sm-4">
								<select id="oleh" name="oleh">
									<option value="0">Siswa</option>
									<option value="1">Wali</option>
									<option value="2">Lain</option>
								</select>
							</div>
						</div>

						<div class="space-1"></div>

						<div class="clearfix form-actions">
							<div class="col-md-offset-1 col-md-9">
								<button class="btn btn-sm btn-success" type="submit">
									<i class="ace-icon fa fa-money bigger-100"></i>
									Tambah
								</button>
								&nbsp;
								<button class="btn btn btn-sm" type="reset">
									<i class="ace-icon fa fa-refresh bigger-100"></i>
									Reset
								</button>
								&nbsp; 
								<a href="<?php echo base_url().'admin/spp'; ?>">
									<button class="btn btn btn-sm btn-danger" type="button">
										<i class="ace-icon glyphicon glyphicon-arrow-left bigger-100"></i>Kembali
									</button>
								</a>
							</div>
						</div>
					</form>
					</div>
					<div class="col-sm-6 col-xs-6">
						<label>Tagihan.</label>
						<table id="table" class="table  table-bordered table-hover" style="margin-top: 5px">
		                    <thead>
		                        <tr>
		                            <th width="50%">Jenis</th>
		                            <th width="25%">Jumlah</th>
		                            <th width="25%">Tgl. Bayar</th>
		                        </tr>
		                    </thead>

		                    <tbody>
		                    	<?php
		                    		foreach ($bayar as $t) {
		                    	?>
		                        <tr ">
		                        	<td ><?php echo $t->jenis; ?></td>
		                            <td ><?php echo "Rp. ".number_format($t->nominal, '0', ',', '.').",-"; ?></td>
		                            <td ><?php echo $t->tgl_bayar; ?></td>
		                        </tr>
		                    	<?php } ?>
		                    </tbody>
		                </table>
		                <hr/>
		                <?php
		                	if ($bayar) { ?>
		                		<a href="<?php echo base_url().'admin/cetak'; ?>">
									<button class="btn btn btn-sm btn-info " type="button">
										<i class="ace-icon glyphicon glyphicon-print bigger-100"></i> Simpan & Cetak
									</button>
								</a>
		                <?php	}
		                ?>
					</div>
<?php include "footer.php" ?>