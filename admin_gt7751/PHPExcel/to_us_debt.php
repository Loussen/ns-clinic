<?php
error_reporting(E_ALL);
include "../pages/__includes/config.php";
require_once 'Classes/PHPExcel/IOFactory.php';
require_once 'Classes/PHPExcel.php';
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

$table='tickets';
$file_name='to_us_debt';
$sql=safe(encrypt_decrypt('decrypt',$_GET["sql"]));
if(substr_($sql,0,14+strlen($table))!='select * from '.$table) exit();
$sql=str_replace('&single_quot;',"'",$sql);
$sql=mysqli_query($db,$sql.' order by datetime desc');

$excel2 = PHPExcel_IOFactory::createReader('Excel2007');
$excel2 = $excel2->load($file_name.'.xlsx'); // Empty Sheet
$sheet=0;
$excel2->setActiveSheetIndex($sheet);
$emptySheet = clone $excel2->getActiveSheet();

$price_converted=0;
$payed_amount=0;
$not_payed_amount=0;

$sirasi=2;
while($row=mysqli_fetch_assoc($sql))
{
	if($sheet>0) { $emptySheet->setTitle($file_name.'_'.$sheet+1); $excel2->addSheet($emptySheet); $excel2->setActiveSheetIndex($sheet); $emptySheet = clone $excel2->getActiveSheet(); }
	else $excel2->getActiveSheet()->setTitle($file_name);
	
	if($row["payer_id"]>0){
		$payer_info=mysqli_fetch_assoc(mysqli_query($db,"select name from payers where id='$row[payer_id]' "));
		$payer=$payer_info["name"];
	}
	else{
		$payer_info=mysqli_fetch_assoc(mysqli_query($db,"select name,surname from clients where id='$row[client_id]' "));
		$payer=$payer_info["name"].' '.$payer_info["surname"];
	}
	$section_info=mysqli_fetch_assoc(mysqli_query($db,"select name from sections where id='$row[section_id]' "));
	$worker_info=mysqli_fetch_assoc(mysqli_query($db,"select name from user_programs where id='$row[worker_id]' "));
	$partner_info=mysqli_fetch_assoc(mysqli_query($db,"select name from partners where id='$row[partner_id]' "));
	$c_info=mysqli_fetch_assoc(mysqli_query($db,"select name from currencies where id='$row[currency_id]' "));
	if($row["currency_id"]!=1) $converted=' ('.$row["price_converted"].' AZN)'; else $converted='';
	
	
	$excel2->getActiveSheet()
	->setCellValue('A'.$sirasi, $payer )
	->setCellValue('B'.$sirasi, $worker_info["name"].' ('.$section_info["name"].')' )
	->setCellValue('C'.$sirasi, $partner_info["name"] )
	->setCellValue('D'.$sirasi, $row["direction"] )
	->setCellValue('E'.$sirasi, $row["yeast_price_main"].' '.$c_info["name"].' '.$converted )
	->setCellValue('F'.$sirasi, $row["yeast_payed_amount"].' AZN' )
	->setCellValue('G'.$sirasi, $row["yeast_not_payed_amount"].' AZN' )
	->setCellValue('H'.$sirasi, $row["notes"] );
	
	$price_converted+=$row["price_converted"];
	$payed_amount+=$row["payed_amount"];
	$not_payed_amount+=$row["not_payed_amount"];
	
	$sirasi++;
}

$sirasi++;
$excel2->getActiveSheet()
	->setCellValue('A'.$sirasi, 'Cəmi' )
	->setCellValue('B'.$sirasi, '' )
	->setCellValue('C'.$sirasi, '' )
	->setCellValue('D'.$sirasi, '' )
	->setCellValue('E'.$sirasi, $price_converted.' AZN' )
	->setCellValue('F'.$sirasi, $payed_amount.' AZN' )
	->setCellValue('G'.$sirasi, $not_payed_amount.' AZN' )
	->setCellValue('H'.$sirasi, '');

$excel2->setActiveSheetIndex(0);
$objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');
//$objWriter->save('test2.xlsx');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$file_name.'_'.$time.'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter->save('php://output');

exit;
?>