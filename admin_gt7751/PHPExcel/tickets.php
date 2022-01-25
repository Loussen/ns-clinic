<?php
error_reporting(E_ALL);
include "../pages/__includes/config.php";
require_once 'Classes/PHPExcel/IOFactory.php';
require_once 'Classes/PHPExcel.php';
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

$table='tickets';
$file_name='tickets';
$sql=safe(encrypt_decrypt('decrypt',$_GET["sql"]));
if(substr_($sql,0,14+strlen($table))!='select * from '.$table) exit();
$sql=str_replace('&single_quot;',"'",$sql);
$sql=mysqli_query($db,$sql.' order by datetime desc');

$excel2 = PHPExcel_IOFactory::createReader('Excel2007');
$excel2 = $excel2->load($file_name.'.xlsx'); // Empty Sheet
$sheet=0;
$excel2->setActiveSheetIndex($sheet);
$emptySheet = clone $excel2->getActiveSheet();

$total_amount=0;	$total_profit=0;

$sirasi=2;
while($row=mysqli_fetch_assoc($sql))
{
	if($sheet>0) { $emptySheet->setTitle($file_name.'_'.$sheet+1); $excel2->addSheet($emptySheet); $excel2->setActiveSheetIndex($sheet); $emptySheet = clone $excel2->getActiveSheet(); }
	else $excel2->getActiveSheet()->setTitle($file_name);
	
	$currency_info=mysqli_fetch_assoc(mysqli_query($db,"select name from currencies where id='$row[currency_id]' "));
	$payment_method_info=mysqli_fetch_assoc(mysqli_query($db,"select name from payment_methods where id='$row[payment_method_id]' "));
	$client_info=mysqli_fetch_assoc(mysqli_query($db,"select surname,name,father_name from clients where id='$row[client_id]' "));
	$partner_info=mysqli_fetch_assoc(mysqli_query($db,"select name from partners where id='$row[partner_id]' "));
	$user_info=mysqli_fetch_assoc(mysqli_query($db,"select login from user_programs where id='$row[worker_id]' "));
	
	if($row["payer_id"]>0) $payer_info=mysqli_fetch_assoc(mysqli_query($db,"select name from payers where id='$row[payer_id]' ")); else $payer_info["name"]="Fərdi";
	
	$c_info=mysqli_fetch_assoc(mysqli_query($db,"select name from currencies where id='$row[currency_id]' "));
	if($row["currency_id"]!=1) $converted='<br />'.$row["price_converted"].' AZN'; else $converted='';
	
	
	$excel2->getActiveSheet()
	->setCellValue('A'.$sirasi, date("d.m.Y H:i",$row["datetime"]) )
	->setCellValue('B'.$sirasi, $client_info["surname"].' '.$client_info["name"].' '.$client_info["father_name"] )
	->setCellValue('C'.$sirasi, $user_info["login"] )
	->setCellValue('D'.$sirasi, $row["direction"] )
	->setCellValue('E'.$sirasi, $row["start_date"] )
	->setCellValue('F'.$sirasi, $row["end_date"] )
	->setCellValue('G'.$sirasi, $row["avia_company"] )
	->setCellValue('H'.$sirasi, $partner_info["name"] )
	->setCellValue('I'.$sirasi, $payer_info["name"] )
	->setCellValue('J'.$sirasi, $payment_method_info["name"] )
	->setCellValue('K'.$sirasi, $currency_info["name"] )
	->setCellValue('L'.$sirasi, $row["currency_rate"] )
	->setCellValue('M'.$sirasi, $row["price_converted"] )
	->setCellValue('N'.$sirasi, $row["payed_amount"] )
	->setCellValue('O'.$sirasi, $row["not_payed_amount"] )
	->setCellValue('P'.$sirasi, $row["yeast_price_converted"] )
	->setCellValue('Q'.$sirasi, $row["profit"] )
	->setCellValue('R'.$sirasi, $row["notes"] )
	;
	
	$total_amount=bcround(bcadd($total_amount,$row["price_converted"]),2);
	$total_profit=bcround(bcadd($total_profit,$row["profit"]),2);
	
	$sirasi++;
}

$sirasi++;
$excel2->getActiveSheet()
	->setCellValue('A'.$sirasi, '' )
	->setCellValue('B'.$sirasi, '' )
	->setCellValue('C'.$sirasi, '' )
	->setCellValue('D'.$sirasi, '' )
	->setCellValue('E'.$sirasi, '' )
	->setCellValue('F'.$sirasi, '' )
	->setCellValue('G'.$sirasi, '' )
	->setCellValue('H'.$sirasi, '' )
	->setCellValue('I'.$sirasi, '' )
	->setCellValue('J'.$sirasi, '' )
	->setCellValue('K'.$sirasi, '' )
	->setCellValue('L'.$sirasi, 'Cəmi:' )
	->setCellValue('M'.$sirasi, $total_amount )
	->setCellValue('N'.$sirasi, '' )
	->setCellValue('O'.$sirasi, '' )
	->setCellValue('P'.$sirasi, '' )
	->setCellValue('Q'.$sirasi, $total_profit )
	->setCellValue('R'.$sirasi, '' )
	;

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