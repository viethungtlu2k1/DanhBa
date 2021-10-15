<?php
include("./config/constants.php");
require 'Excel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

if (isset($_POST['submit'])) {
    //$ext = $_POST['export_file_type'];
    //$fileName = "DBNV" . time();
    $sql = "SELECT * FROM db_nhanvien";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Số thứ tự');
        $sheet->setCellValue('B1', 'Mã nhân viên');
        $sheet->setCellValue('C1', 'Tên nhân viên');
        $sheet->setCellValue('D1', 'Chức vụ');
        $sheet->setCellValue('E1', 'Máy bàn');
        $sheet->setCellValue('F1', 'Email');
        $sheet->setCellValue('G1', 'Số di động');
        $sheet->setCellValue('H1', 'Thuộc Đơn vị');

        $count = 2;
        $stt = 1;
        foreach ($res as $data) {
            $sheet->setCellValue('A' . $count, $stt);
            $sheet->setCellValue('B' . $count, $data['manv']);
            $sheet->setCellValue('C' . $count, $data['tennv']);
            $sheet->setCellValue('D' . $count, $data['chucvu']);
            $sheet->setCellValue('E' . $count, $data['mayban']);
            $sheet->setCellValue('F' . $count, $data['email']);
            $sheet->setCellValue('G' . $count, $data['sodidong']);
            $madv = $data['madv'];
            // select tendv
            $sql2 = "SELECT tendv FROM db_donvi WHERE madv = $madv";
            $res2 = mysqli_query($conn, $sql2);
            $row = mysqli_fetch_assoc($res2);
            $sheet->setCellValue('H' . $count, $row['tendv']);

            $count++;
            $stt++;
        }
        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
        ];
        $spreadsheet->getActiveSheet()->getStyle('A:H')->applyFromArray($styleArray);
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true); // đặt độ rộng của cột tự động
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="DanhSachNhanVien.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    } else {
        $_SESSION['noti'] = "Không có dữ liệu";
        header("location:" . $siteurl . 'index.php');
    }
} else {
    header("location:" . $siteurl . 'index.php');
}
