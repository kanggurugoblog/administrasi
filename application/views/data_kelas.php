<?php include "head.php"; ?>
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
						Kelas
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
					<a href="<?php echo base_url().'admin/add_master_kelas/';?>">
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
					<table id="simple-table" class="table  table-bordered table-hover" style="margin-top: 5px">
						<thead>
							<tr>
								<th width="10%">Kelas</th>
								<th width="20%">Jurusan</th>
								<th width="25%">Wali Kelas</th>
								<th width="30%">Keterangan</th>
								<th width="15%">
									<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
									Update
								</th>
							</tr>
						</thead>

						<tbody>
							<?php 
								foreach ($kelas as $a) {
							?>
							<tr>
								<td class="hidden-480"><?php echo $a->kelas; ?></td>
								<td><?php echo $a->jurusan; ?></td>
								<td>
									<?php 										
										foreach ($guru as $b) {
										 	if ($b->id == $a->id_guru) {
										 		echo $b->nama;
										 	}
										 } 
									?>
								</td>
								<td><?php echo $a->ket; ?></td>
								<td>
									<div class="hidden-sm hidden-xs btn-group">
										<a href="<?php echo base_url().'admin/edit_master_kelas/'.$a->id;?>"><button class="btn btn-xs btn-info">
											<i class="ace-icon fa fa-pencil bigger-120"></i>
										</button></a>

										<a href="<?php echo base_url().'admin/hapus_master_kelas/'.$a->id;?>" onclick="return hapus_data()"><button class="btn btn-xs btn-danger">
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

<?php include "footer.php"; ?>