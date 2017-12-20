<?php 

	$mi_pdf = fopen ("conectados.pdf", "r");
	if (!$mi_pdf) {
	    echo "<p>No puedo abrir el archivo para lectura</p>";
	    exit;
	}
	header('Content-type: application/pdf');
	fpassthru($mi_pdf); // Esto hace la magia
	fclose ($archivo);

?>