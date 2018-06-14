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
						Guru
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
					<a href="<?php echo base_url().'admin/add_guru/';?>">
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
	                <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover" style="margin-top: 10px">
	                        <thead>
	                            <tr>
	                                <th>No.</th>
	                                <th>Nama</th>
	                                <th>Username</th>
	                                <th>Hak Akses</th>
	                                <th>Login Terahir</th>
	                                <th>Hapus Data</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <?php 
	                            $no = 1;
	                            foreach ($admin as $a) { ?>
	                            <tr>
	                                <td><?php echo $no; ?></td>
	                                <td>
	                                	<span >
	                                		<strong><?php 
	                                			foreach ($data_guru as $b) {
	                                				if ($b->id == $a->id_guru) {
	                                					echo $b->nama; 
	                                				}
	                                			}
	                                			?>
	                                		</strong>
	                                	</span>
	                                </td>
	                                <td><?php echo $a->username; ?></td>
	                                <td><?php 
	                                    if ($a->login_type=="1") {
	                                        echo "Admin";
	                                    }elseif ($a->login_type=="2") {
	                                        echo "Guru";
	                                    }elseif ($a->login_type=="3") {
	                                        echo "Wali";
	                                    }
	                                    // $a->login_type; ?></td>
	                                <td><?php echo $a->last_login; ?></td>
	                                <td >
										<a href="<?php echo base_url().'admin/edit_guru/'.$a->id_guru;?>"><button class="btn btn-xs btn-info">
											<i class="ace-icon fa fa-pencil bigger-120"></i>
										</button></a> &nbsp &nbsp
	                                	<a href="<?php echo base_url().'admin/hapus_guru/'.$a->id_guru;?>" onclick="return hapus_data()"><button class="btn btn-xs btn-danger">
											<i class="ace-icon fa fa-trash-o bigger-120"></i>
										</button></a>
	                                </td>

	                            </tr>
	                            <?php $no=$no+1;} ?>
	                        </tbody>
	                    </table>
	                </div>
     
		            <div class=" col-md-8 col-sm-8">
		                <div class="list-group">
		                    <a href="#" class="list-group-item active">
		                        <h4 class="list-group-item-heading">Keterangan :</h4>
		                        <p class="list-group-item-text" style="line-height: 30px;">
		                            Login Type :<br>
		                            1. ADMIN = Bisa melakukan akses sesuai jabatan<br>
		                            2. GURU = Bisa melihat dan melakukan pemambahan transaksi<br>
		                            3. WALI = Hanya bisa melihat laporan<br>
		                        </p>
		                    </a>
		                </div>
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