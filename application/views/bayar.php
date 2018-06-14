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
					DATA
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Administrasi Pembayaran
					</small>
				</h1>
			</div><!-- /.page-header -->
			
			<div class="row">
				<div class="col-xs-12">
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
					<a href="<?php echo base_url().'admin/add_tagihan/';?>">
						<button class="btn btn-xs btn-success">
							<i class="ace-icon fa fa-plus bigger-120"><b> Tambah</b></i>
						</button>
					</a>
					<br/>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<table class="table table-striped table-bordered table-hover" style="margin-top: 10px">
	                        <thead>
	                            <tr>
	                                <th width="4%">No.</th>
	                                <th width="20%">Jenis Tagihan</th>
	                                <th width="10%">Jumlah</th>
	                                <th width="15%">Untuk Kelas</th>
	                                <th width="25%">Keterangan</th>
	                                <th width="15%">Tanggal Terahir Bayar</th>
	                                <th width="10%">Hapus Data</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <?php 
	                            $no = 1;
	                            foreach ($tagihan as $a) { ?>
	                            <tr>
	                                <td><?php echo $no; ?></td>
	                                <td><?php echo $a->jenis; ?></td>
	                                <td>Rp. <?php echo number_format($a->nominal, "0", ",", ".").",-"; ?></td>
	                                <td>
	                                	<?php 
	                                		//echo $a->kelas; 
	                                		if ($a->kelas=='0') {
	                                			echo "Semua Kelas";
	                                		}else{
	                                			$kls = explode(', ', $a->kelas);
												$dk = count($kls);
												for ($x = 0; $x <$dk; $x++){
													foreach ($kelas as $b) {
														if (intval($kls[$x]) == intval($b->id)) {
															echo $b->kelas.'-'.$b->jurusan.'<br>';
														}
													}
												}
											}
	                                	?>		
	                                </td>
	                                <td><?php echo $a->keterangan; ?></td>
	                                <td><?php echo $a->jatuh_tempo; ?></td>
	                                <td >
										<a href="<?php echo base_url().'admin/edit_tagihan/'.$a->id;?>"><button class="btn btn-xs btn-info">
											<i class="ace-icon fa fa-pencil bigger-120"></i>
										</button></a> &nbsp &nbsp
	                                	<a href="<?php echo base_url().'admin/hapus_tagihan/'.$a->id;?>" onclick="return hapus_data()"><button class="btn btn-xs btn-danger">
											<i class="ace-icon fa fa-trash-o bigger-120"></i>
										</button></a>
	                                </td>

	                            </tr>
	                            <?php $no=$no+1;} ?>
	                        </tbody>
	                    </table>
	                </div>
					
<script>
function hapus_data()
{
    job=confirm("Yakin akan menghapus data?");
    if(job!=true)
    {
        return false;
    }
}
</script>

<?php include "footer.php" ?>