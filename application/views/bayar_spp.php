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
						<!-- <?php echo form_open(base_url().'admin/cari2'); ?>
						<select name="bulan">
							<?php
								$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
								$jlh_bln=count($bulan);
								$sk = intval(date('m'))-1;
								for($c=0; $c<$jlh_bln; $c+=1){ ?>
								    <option value="<?php echo $bulan[$c]; ?>" <?php if ($c == $sk ) { echo "selected";} ?> > <?php echo $bulan[$c]; ?> </option>
							<?php	}
							?>
							
						</select>

						<?php
							$now=date('Y');
							echo "<select name=’tahun’>";
							for ($a=2012;$a<=$now;$a++)
							{?>
								<option value="<?php echo $a; ?>" <?php if ($a == intval($now)) {echo "selected";} ?>><?php echo $a; ?></option>";
							<?php }
							echo "</select>";
						?>

						<select name="kelas">
							<option value="0">Semua Kelas</option>
							<?php foreach ($kelas as $k) {
								echo "<option value='".$k->id."'>".$k->kelas.'-'.$k->jurusan."</option>";	
							} ?>
						</select>

						<select name="kategori">
							<option value="0">Sudah Bayar</option>
							<option value="1">Belum Bayar</option>
							<option value="2">Semua</option>
						</select>

						<a href="<?php echo base_url().'admin/lihat_spp/';?>">
							<button class="btn btn-xs btn-danger">
								<i class="ace-icon fa fa-search bigger-120"> Tampilkan</i>
							</button>
						</a>
						<?php echo form_close(); ?>
						&nbsp &nbsp*/ 
					</div>
					<div class="col-xs-4">-->
						<?php echo form_open(base_url().'admin/cari/'); ?>
						<input  type="text" name="nani" placeholder="NIS / NAMA">
						&nbsp
							<button class="btn btn-xs btn-danger" type="submit">
							<i class="ace-icon fa fa-search bigger-120"> Cari</i>
							</button>
						<?php echo form_close(); ?>
					<hr>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
						<!--<?php
							foreach ($kelas as $s) { ?>
								<div class="col-xs-3">
									<h4><?php echo $s->kelas.'-'.$s->jurusan;?></h4>

									<select name="nama" size='5' multiple>
										<?php
											foreach ($dkelas as $z) { 
												if ($z->id_kelas == $s->id ) {
													foreach ($siswa as $y) {
														if ($z->id_siswa == $y->nis) { ?>
															<option><b><?php echo $y->nama; ?></b></option>
										<?php			}
													}
												}
											}
										?>
									</select>
								</div>
						<?php 	}
						?>-->
					<table id="table" class="table  table-bordered table-hover" style="margin-top: 5px">
                    <thead>
                        <tr>
                            <th width="10%">Nis</th>
                            <th width="25%">Nama</th>
                            <th width="10%">Kelas</th>
                            <th width="15%"><i class="ace-icon fa fa-money bigger-110 hidden-480"></i>Bayar</th>
                        </tr>
                    </thead>

                    <tbody>
                    	<?php
                    		foreach ($siswa as $a) {
                    	?>
                        <tr>
                        	<td ><?php echo $a->nis; ?></td>
                            <td ><?php echo $a->nama; ?></td>
                            <td ><?php echo $a->kelas."-".$a->jurusan; ?></td>
                            <td >
								<a href="<?php echo base_url().'admin/add_spp/'.$a->nis;?>"><button class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-money bigger-120"></i> SPP
								</button></a>&nbsp
								<a href="<?php echo base_url().'admin/lain/'.$a->id.'/'.$a->nis;?>"><button class="btn btn-danger btn-xs btn-info">
									<i class="ace-icon fa fa-dollar bigger-120"></i> Lain-lain
								</button></a> 
                            </td>
                        </tr>
                    	<?php } ?>
                    </tbody>
                </table>
                 <?php 
					echo $this->pagination->create_links();
				?>

<?php include "footer.php" ?>