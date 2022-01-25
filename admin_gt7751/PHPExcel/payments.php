<?php
error_reporting(E_ALL);
include "../pages/__includes/config.php";
require_once 'Classes/PHPExcel/IOFactory.php';
require_once 'Classes/PHPExcel.php';
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

$table='payments';
$file_name='payments';
$sql=safe(encrypt_decrypt('decrypt',$_GET["sql"]));
if(substr_($sql,0,14+strlen($table))!='select * from '.$table) exit();
$sql=str_replace('&single_quot;',"'",$sql);
$sql=mysqli_query($db,$sql.' order by datetime desc');

$excel2 = PHPExcel_IOFactory::createReader('Excel2007');
$excel2 = $excel2->load($file_name.'.xlsx'); // Empty Sheet
$sheet=0;
$excel2->setActiveSheetIndex($sheet);
$emptySheet = clone $excel2->getActiveSheet();

$total_amount=0;

$sirasi=2;
while($row=mysqli_fetch_assoc($sql))
{
	if($sheet>0) { $emptySheet->setTitle($file_name.'_'.$sheet+1); $excel2->addSheet($emptySheet); $excel2->setActiveSheetIndex($sheet); $emptySheet = clone $excel2->getActiveSheet(); }
	else $excel2->getActiveSheet()->setTitle($file_name);
	
	$c_info=mysqli_fetch_assoc(mysqli_query($db,"select name from currencies where id='$row[currency_id]' "));
	if($row["currency_id"]!=1) $converted=' ('.$row["amount_azn"].' AZN)'; else $converted='';
	
	$cash_desk_info=mysqli_fetch_assoc(mysqli_query($db,"select name from cash_desks where id='$row[cash_desk_id]' "));
	if($row["payment_type"]==0) $payment_type_text="Mədaxil"; else $payment_type_text="Məxaric";
	
	
	$excel2->getActiveSheet()
	->setCellValue('A'.$sirasi, date("d.m.Y H:i",$row["datetime"]) )
	->setCellValue('B'.$sirasi, $row["client_name"] )
	->setCellValue('C'.$sirasi, $cash_desk_info["name"] )
	->setCellValue('D'.$sirasi, $payment_type_text )
	->setCellValue('E'.$sirasi, $row["amount"].' '.$c_info["name"].' '.$converted )
	->setCellValue('F'.$sirasi, $row["notes"] );
	
	if($row["payment_type"]==0) $total_amount=bcround(bcadd($total_amount,$row["amount_azn"]),2); else $total_amount=bcround(bcsub($total_amount,$row["amount_azn"]),2);
	
	$sirasi++;
}

$sirasi++;
$excel2->getActiveSheet()
	->setCellValue('A'.$sirasi, '' )
	->setCellValue('B'.$sirasi, '' )
	->setCellValue('C'.$sirasi, '' )
	->setCellValue('D'.$sirasi, 'Cəmi' )
	->setCellValue('E'.$sirasi, $total_amount.' AZN' )
	->setCellValue('F'.$sirasi, '' );

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