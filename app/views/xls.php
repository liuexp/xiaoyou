<?php
//$filename="ExportExcel.xls";//定义一个excel文件
//header("Content-Type: application/vnd.ms-execl");
//header("Content-Type: application/vnd.ms-excel;charset=UTF-8");
//header("Content-Disposition: attachment; filename=$filename");
//header("Pragma: no-cache");
//header("Expires: 0");
//echo $this->csv;
//exit();
$xls = new Excel_XML('UTF-8', false, 'user-data');
$xls->addArray($this->data);
$xls->generateXML('userdata');
exit();
