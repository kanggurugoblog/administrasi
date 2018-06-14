<?php
/* contoh text */  
$text = '
		<p>
			<h2>SMK. THORIQUL ULUM PACET</h2>
			<br>
			<h3>Tahun Pelajaran 2018/2019</h3>
			<br>
			<br>
			<h4>BUKTI PEMBAYARAN SPP</h4>
			<hr>
			<br>
			<br>
			Bulan : xxx
			<br>
			Tgl. Bayar : xxx
			<br>
			<br>
			Bendahara,<br><br>
			xxx
		</p>';     
/* tulis dan buka koneksi ke printer */    
$printer = printer_open("EPSON L120 Series");  
/* write the text to the print job */  
printer_write($printer, $text);   
/* close the connection */ 
printer_close($printer);
?>