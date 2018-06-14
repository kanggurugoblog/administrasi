
<?php include "head.php" ?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url(); ?>">Home</a>
				</li>
				<li class="active">Dashboard</li>
			</ul><!-- /.breadcrumb -->

		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					Dashboard
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						overview &amp; stats
					</small>
				</h1>
			</div><!-- /.page-header -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					Silahkan Pilih Printer :
					        <?php
					        echo form_open(base_url().'admin/set_pr');
					        $getprt = printer_list(PRINTER_ENUM_LOCAL);
					        $printers = serialize($getprt);
					        $printers = unserialize($printers);
					        //Menampilkan List Printer
					        echo '<select name="printers" id="printer">';
					        foreach ($printers as $PrintDest)
					            echo "<option value='" . $PrintDest["NAME"] . "'>" . $PrintDest["NAME"] . "</option>";
					        echo '</select>';
					        ?>
					        <br>
					        <button type="submit">Simpan</button>
					    	</form>
								
<?php include "footer.php" ?>