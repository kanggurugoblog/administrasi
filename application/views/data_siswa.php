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
						Siswa
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
					<a href="<?php echo base_url().'admin/add_siswa/';?>">
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
                <table id="table" class="table  table-bordered table-hover" style="margin-top: 5px">
                    <thead>
                        <tr>
                            <th width="10%">Nis</th>
                            <th width="25%">Nama</th>
                            <th width="10%">Tahun Masuk</th>
                            <th class="hidden-480" width="28%">Alamat</th>
                            <th class="hidden-480" width="12%">Status</th>
                            <th width="15%"><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>Update Data</th>
                        </tr>
                    </thead>

                    <tbody>
                    	<?php
                    		foreach ($siswa as $a) {
                    	?>
                        <tr ">
                        	<td ><?php echo $a->nis; ?></td>
                            <td ><?php echo $a->nama; ?></td>
                            <td ><?php echo $a->th_masuk; ?></td>
                            <td ><?php echo $a->alamat; ?></td>
                            <td ><?php 
                            		if ($a->status == '0') {
                            			echo "Bayar";
                            		}elseif ($a->status == '1') {
                            			echo "Santunan";
                            		}else{
                            			echo "Beasiswa";
                            		}?>
                            </td>
                            <td >
								<div class="hidden-sm hidden-xs btn-group">
										<a href="<?php echo base_url().'admin/edit_siswa/'.$a->nis;?>"><button class="btn btn-xs btn-info">
											<i class="ace-icon fa fa-pencil bigger-120"></i>
										</button></a> &nbsp &nbsp

										<a href="<?php echo base_url().'admin/hapus_siswa/'.$a->nis;?>" onclick="return hapus_data()"><button class="btn btn-xs btn-danger">
											<i class="ace-icon fa fa-trash-o bigger-120"></i>
										</button></a>
									</div>
                            </td>
                        </tr>
                    	<?php } ?>
                    </tbody>
                </table>
                <?php 
					echo $this->pagination->create_links();
				?>
            </div>
        </div>

<script>
    function hapus_data() {
        return confirm('Apakah anda yakin akan menghapus data siswa ini?')
    }
</script>

								
<?php include "footer.php" ?>