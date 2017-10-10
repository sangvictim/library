<?php
require_once FCPATH . '/assets/phpexcel/Classes/PHPExcel.php';
PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '_' . date('dmY_his') . '.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$excel = new PHPExcel();
// Set document properties
$excel->getProperties()
      ->setTitle($filename . '_' . date('d_m_Y'));

$sheet = $excel->setActiveSheetIndex(0);

// Formating
$headerStyle = new PHPExcel_Style();
$bodyStyle   = new PHPExcel_Style();

$headerStyle->applyFromArray(
    array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
        'font'      => array(
            'bold' => true,
        ),
        'borders'   => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        ),
    ));

$bodyStyle->applyFromArray(
    array(
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        ),
    ));

// Set Value

// Set header
$x = 1;
$sheet->setCellValue('A1', $header);

// Set SubHeader
if (isset($subheader)) {
    ++$x;
    foreach ($subheader as $key => $value) {
        ++$x;
        $sheet->setCellValue('A' . $x, $key);
        $sheet->setCellValue('B' . $x, $value);
    }
}

++$x;

// Set TH
$col   = count($field);
$y     = PHPExcel_Cell::stringFromColumnIndex($col - 1);
$start = ++$x;
$end   = $start + count($data);
$range = sprintf('A%s:%s%s', $start, $y, $end);

// AutoSize Column
foreach (range(0, $col - 1) as $c) {
    $sheet->getColumnDimensionByColumn($c)->setAutoSize(true);
}

$sheet->fromArray($field, null, 'A' . $start);
$sheet->setSharedStyle($headerStyle, $range);

// Set TD
$start = ++$x;
$end   = $start + count($data) - 1;
$range = sprintf('A%s:%s%s', $start, $y, $end);

$sheet->fromArray($data, null, 'A' . $start);
$sheet->setSharedStyle($bodyStyle, $range);

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');
