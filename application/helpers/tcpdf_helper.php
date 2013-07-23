<?php
	
	
	function headerPDF($pCabecera,$pSubCabecera)
	{
		$CI = &get_instance();
        $CI->tcpdf->SetSubject('Reporte Intranet IETI');
        $CI->tcpdf->SetAuthor('IETI SANTA ROSA DE LIMA');
        $CI->tcpdf->SetHeaderData('', 0, $pCabecera,$pSubCabecera);
		//$CI->tcpdf->SetHeaderData('UNJFSC.png', 100, $pCabecera,$pSubCabecera);
		$CI->tcpdf->setHeaderFont(Array('courier', '', '16'));
		$CI->tcpdf->SetHeaderMargin(25);
		$CI->tcpdf->SetMargins(15, 40, 10);
	}
	
	function footerPDF($pPie)
	{
		$CI = &get_instance();
		$CI->tcpdf->SetY(-15);
	    date_default_timezone_set('Etc/GMT+5');
		$CI->tcpdf->SetFooterData('','',$pPie);
	}
	
?>