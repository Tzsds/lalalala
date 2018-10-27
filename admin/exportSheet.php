<?php
    require 'phpexcel/autoload.php';
    require_once 'config.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->getDefaultColumnDimension()->setWidth(17);

    date_default_timezone_set("Asia/Singapore");
    $timestamp = date('y-m-d H:i:s',time());

    session_start();

    if (isset($_SESSION['Email'])) {
        $Email = $_SESSION['Email'];
        
        if (isset($_GET['Id']) && isset($_GET['CategoryName'])) {
            $Id = $_GET['Id'];
            $CategoryName = $_GET['CategoryName'];

            $conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect...');

            $search_column_sql = "SELECT * FROM spreadsheetcolumn WHERE Id = $Id";
            $search_column_result = mysqli_query($conn, $search_column_sql);
            
            $ColumnArray = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ");
            
            $InformationColumn = 0;

            if (!$search_column_result || mysqli_num_rows($search_column_result) == 0){
                mysqli_close($conn);
                header("Location:../404.php");
            }
            else {
                $one_search_column_result = mysqli_fetch_assoc($search_column_result);
                $SheetName = $one_search_column_result['SheetName'];
                $SheetSubject = $one_search_column_result['SheetSubject'];
                $InformationName1 = $one_search_column_result['InformationName1'];
                $InformationName2 = $one_search_column_result['InformationName2'];
                $InformationName3 = $one_search_column_result['InformationName3'];
                $InformationName4 = $one_search_column_result['InformationName4'];
                $InformationName5 = $one_search_column_result['InformationName5'];
                $InformationName6 = $one_search_column_result['InformationName6'];
                $InformationName7 = $one_search_column_result['InformationName7'];
                $InformationName8 = $one_search_column_result['InformationName8'];
                $InformationName9 = $one_search_column_result['InformationName9'];
                $InformationName10 = $one_search_column_result['InformationName10'];
                $isOtherInformation = $one_search_column_result['isOtherInformation'];
                
                // 第一行标题
                // 设置值
                $sheet->setCellValue("A1", $SheetName);
                // 字体大小
                $sheet->getStyle("A1")->getFont()->setSize(25);
                // 加粗
                $sheet->getStyle("A1")->getFont()->setBold(true);

                // 第二行标题
                // 设置值
                $sheet->setCellValue("A2", $SheetSubject);
                // 字体大小
                $sheet->getStyle("A2")->getFont()->setSize(20);
                // 加粗
                $sheet->getStyle("A2")->getFont()->setBold(true);
     
                $sheet->setCellValue('A4', "Time Stamp");
                
                $InformationColumn++;

                if(!empty($InformationName1)) {
                    $sheet->setCellValue('B4', $InformationName1);
                    $InformationColumn++;
                }
                if(!empty($InformationName2)) {
                    $sheet->setCellValue('C4', $InformationName2);
                    $InformationColumn++;
                }
                if(!empty($InformationName3)) {
                    $sheet->setCellValue('D4', $InformationName3);
                    $InformationColumn++;
                }
                if(!empty($InformationName4)) {
                    $sheet->setCellValue('E4', $InformationName4);
                    $InformationColumn++;
                }
                if(!empty($InformationName5)) {
                    $sheet->setCellValue('F4', $InformationName5);
                    $InformationColumn++;
                }
                if(!empty($InformationName6)) {
                    $sheet->setCellValue('G4', $InformationName6);
                    $InformationColumn++;
                }
                if(!empty($InformationName7)) {
                    $sheet->setCellValue('H4', $InformationName7);
                    $InformationColumn++;
                }
                if(!empty($InformationName8)) {
                    $sheet->setCellValue('I4', $InformationName8);
                    $InformationColumn++;
                }
                if(!empty($InformationName9)) {
                    $sheet->setCellValue('J4', $InformationName9);
                    $InformationColumn++;
                }
                if(!empty($InformationName10)) {
                    $sheet->setCellValue('K4', $InformationName10);
                    $InformationColumn++;
                }
                
                // 第5行开始
                $InformationRow = 5;
                
                $search_content_sql = "SELECT * FROM spreadsheetcontent WHERE SpreadSheetColumnId = $Id";
                $search_content_result = mysqli_query($conn, $search_content_sql);

                if (!$search_content_result || mysqli_num_rows($search_content_result) == 0){

                }
                else {
                    while ($one_search_content_result = mysqli_fetch_assoc($search_content_result)) {
                        $VerificationCode = $one_search_content_result["VerificationCode"];
                        $Information1 = $one_search_content_result["Information1"];
                        $Information2 = $one_search_content_result["Information2"];
                        $Information3 = $one_search_content_result["Information3"];
                        $Information4 = $one_search_content_result["Information4"];
                        $Information5 = $one_search_content_result["Information5"];
                        $Information6 = $one_search_content_result["Information6"];
                        $Information7 = $one_search_content_result["Information7"];
                        $Information8 = $one_search_content_result["Information8"];
                        $Information9 = $one_search_content_result["Information9"];
                        $Information10 = $one_search_content_result["Information10"];
                        $TimeStamp = $one_search_content_result["TimeStamp"];

                        $sheet->setCellValue("A$InformationRow", $TimeStamp);
                        $sheet->setCellValue("B$InformationRow", $Information1);
                        $sheet->setCellValue("C$InformationRow", $Information2);
                        $sheet->setCellValue("D$InformationRow", $Information3);
                        $sheet->setCellValue("E$InformationRow", $Information4);
                        $sheet->setCellValue("F$InformationRow", $Information5);
                        $sheet->setCellValue("G$InformationRow", $Information6);
                        $sheet->setCellValue("H$InformationRow", $Information7);
                        $sheet->setCellValue("I$InformationRow", $Information8);
                        $sheet->setCellValue("J$InformationRow", $Information9);
                        $sheet->setCellValue("K$InformationRow", $Information10);

                        $InformationRow++;
                    }
                }
                
                // 第三行Information
                // 合并单元格
                $sheet->mergeCells("A3:".$ColumnArray[$InformationColumn-1]."3");
                // 设置值
                $sheet->setCellValue("A3", "Information");
                // 字体大小
                $sheet->getStyle('A3')->getFont()->setSize(15);
                // 加粗
                $sheet->getStyle('A3')->getFont()->setBold(true);
                
                // 第四行Column
                $sheet->getStyle("A4:".$ColumnArray[$InformationColumn]."4")->getFont()->setBold(true);
                
                // Information边框
                $InformationBorder = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => '00FF00'],
                        ],
                    ],
                ];
                $sheet->getStyle("A3:".$ColumnArray[$InformationColumn-1].($InformationRow-1))->applyFromArray($InformationBorder);
 
                if($isOtherInformation == 1 && $CategoryName != "Null") {
                    
                    // Information和OtherInformation之间的间距
                    $sheet->getColumnDimension($ColumnArray[$InformationColumn])->setWidth(2);
                    
                    // 第三行Other Information
                    
                    if($CategoryName == "Category1Name") {
                        $Category1Name = $one_search_column_result["Category1Name"];
                        $CountCategory1Item = $one_search_column_result["CountCategory1Item"];
                        $CountCategory1ItemArray = explode(",",$CountCategory1Item);
                        
                        // 设置值
                        $sheet->setCellValue($ColumnArray[$InformationColumn+1]."3", "$Category1Name");
                        // 字体大小
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."3")->getFont()->setSize(15);
                        // 加粗
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."3")->getFont()->setBold(true);
                        
                        $k = 0;
                        for($i=$CountCategory1ItemArray[0]; $i<=$CountCategory1ItemArray[1]; $i++) {
                            $OtherInformationName = "OtherInformationName".$i;
                            $$OtherInformationName = $one_search_column_result["$OtherInformationName"];
                            $sheet->setCellValue($ColumnArray[$InformationColumn+$k+1]."4", $$OtherInformationName);
                            $k++;
                        }
                        
                        $search_otherinfo_sql = "SELECT * FROM spreadsheetcontent WHERE SpreadSheetColumnId = $Id";
                        $search_otherinfo_result = mysqli_query($conn, $search_otherinfo_sql);
                        
                        // 第5行开始
                        $OtherInformationRow = 5;
                        
                        if (!$search_otherinfo_result || mysqli_num_rows($search_otherinfo_result) == 0){
                            
                        }
                        else {
                            while ($one_search_otherinfo_result = mysqli_fetch_assoc($search_otherinfo_result)) {
                                $l = 0;
                                for($i=$CountCategory1ItemArray[0]; $i<=$CountCategory1ItemArray[1]; $i++) {
                                    $OtherInformation = "OtherInformation".$i;
                                    $$OtherInformation = $one_search_otherinfo_result["$OtherInformation"];
                                    $sheet->setCellValue($ColumnArray[$InformationColumn+$l+1].$OtherInformationRow, $$OtherInformation);
                                    $l++;
                                }
                                $OtherInformationRow++;
                            }
                        }  
                        
                        // 第三行Other Information
                        // 合并单元格
                        $sheet->mergeCells($ColumnArray[$InformationColumn+1]."3:".$ColumnArray[$InformationColumn+$CountCategory1ItemArray[1]]."3");
                        
                        // 第四行Column
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."4:".$ColumnArray[$InformationColumn+$CountCategory1ItemArray[1]]."4")->getFont()->setBold(true);

                        // OtherInformation边框
                        $OtherInformationBorder = [
                            'borders' => [
                                'outline' => [
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                    'color' => ['argb' => '0000FF'],
                                ],
                            ],
                        ];
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."3:".$ColumnArray[$InformationColumn+$CountCategory1ItemArray[1]].($OtherInformationRow-1))->applyFromArray($OtherInformationBorder);
                        
                        // 全体居中
                        $sheet->getStyle("A1:".$ColumnArray[$InformationColumn+$CountCategory1ItemArray[1]].($OtherInformationRow-1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        
                        // 第一行标题
                        // 合并单元格
                        $sheet->mergeCells("A1:".$ColumnArray[$InformationColumn+$CountCategory1ItemArray[1]]."1");
                        
                        // 第二行标题
                        // 合并单元格
                        $sheet->mergeCells("A2:".$ColumnArray[$InformationColumn+$CountCategory1ItemArray[1]]."2");
                    }
                    if($CategoryName == "Category2Name") {
                        $Category2Name = $one_search_column_result["Category2Name"];
                        $CountCategory2Item = $one_search_column_result["CountCategory2Item"];
                        $CountCategory2ItemArray = explode(",",$CountCategory2Item);
                        
                        // 设置值
                        $sheet->setCellValue($ColumnArray[$InformationColumn+1]."3", $Category2Name);
                        // 字体大小
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."3")->getFont()->setSize(15);
                        // 加粗
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."3")->getFont()->setBold(true);
                        
                        $k = 0;
                        for($i=$CountCategory2ItemArray[0]; $i<=$CountCategory2ItemArray[1]; $i++) {
                            $OtherInformationName = "OtherInformationName".$i;
                            $$OtherInformationName = $one_search_column_result["$OtherInformationName"];
                            $sheet->setCellValue($ColumnArray[$InformationColumn+$k+1]."4", $$OtherInformationName);
                            $k++;
                        }
                        
                        $search_otherinfo_sql = "SELECT * FROM spreadsheetcontent WHERE SpreadSheetColumnId = $Id";
                        $search_otherinfo_result = mysqli_query($conn, $search_otherinfo_sql);
                        
                        // 第5行开始
                        $OtherInformationRow = 5;
                        
                        if (!$search_otherinfo_result || mysqli_num_rows($search_otherinfo_result) == 0){
                            
                        }
                        else {
                            while ($one_search_otherinfo_result = mysqli_fetch_assoc($search_otherinfo_result)) {
                                $l = 0;
                                for($i=$CountCategory2ItemArray[0]; $i<=$CountCategory2ItemArray[1]; $i++) {
                                    $OtherInformation = "OtherInformation".$i;
                                    $$OtherInformation = $one_search_otherinfo_result["$OtherInformation"];
                                    $sheet->setCellValue($ColumnArray[$InformationColumn+$l+1].$OtherInformationRow, $$OtherInformation);
                                    $l++;
                                }
                                $OtherInformationRow++;
                            }
                        }  
                        
                        // 第三行Information
                        // 合并单元格
                        $sheet->mergeCells($ColumnArray[$InformationColumn+1]."3:".$ColumnArray[$InformationColumn+$CountCategory2ItemArray[1]-$CountCategory2ItemArray[0]+1]."3");
                        
                        // 第四行Column
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."4:".$ColumnArray[$InformationColumn+$CountCategory2ItemArray[1]-$CountCategory2ItemArray[0]+1]."4")->getFont()->setBold(true);

                        // OtherInformation边框
                        $OtherInformationBorder = [
                            'borders' => [
                                'outline' => [
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                    'color' => ['argb' => '0000FF'],
                                ],
                            ],
                        ];
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."3:".$ColumnArray[$InformationColumn+$CountCategory2ItemArray[1]-$CountCategory2ItemArray[0]+1].($OtherInformationRow-1))->applyFromArray($OtherInformationBorder);
                        
                        // 全体居中
                        $sheet->getStyle("A1:".$ColumnArray[$InformationColumn+$CountCategory2ItemArray[1]].($OtherInformationRow-1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        
                        // 第一行标题
                        // 合并单元格
                        $sheet->mergeCells("A1:".$ColumnArray[$InformationColumn+$CountCategory2ItemArray[1]-$CountCategory2ItemArray[0]+1]."1");
                        
                        // 第二行标题
                        // 合并单元格
                        $sheet->mergeCells("A2:".$ColumnArray[$InformationColumn+$CountCategory2ItemArray[1]-$CountCategory2ItemArray[0]+1]."2");
                    }
                    if($CategoryName == "Category3Name") {
                        $Category3Name = $one_search_column_result["Category3Name"];
                        $CountCategory3Item = $one_search_column_result["CountCategory3Item"];
                        $CountCategory3ItemArray = explode(",",$CountCategory3Item);
                        
                        // 设置值
                        $sheet->setCellValue($ColumnArray[$InformationColumn+1]."3", $Category3Name);
                        // 字体大小
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."3")->getFont()->setSize(15);
                        // 加粗
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."3")->getFont()->setBold(true);
                        
                        $k = 0;
                        for($i=$CountCategory3ItemArray[0]; $i<=$CountCategory3ItemArray[1]; $i++) {
                            $OtherInformationName = "OtherInformationName".$i;
                            $$OtherInformationName = $one_search_column_result["$OtherInformationName"];
                            $sheet->setCellValue($ColumnArray[$InformationColumn+$k+1]."4", $$OtherInformationName);
                            $k++;
                        }
                        
                        $search_otherinfo_sql = "SELECT * FROM spreadsheetcontent WHERE SpreadSheetColumnId = $Id";
                        $search_otherinfo_result = mysqli_query($conn, $search_otherinfo_sql);
                        
                        // 第5行开始
                        $OtherInformationRow = 5;
                        
                        if (!$search_otherinfo_result || mysqli_num_rows($search_otherinfo_result) == 0){
                            
                        }
                        else {
                            while ($one_search_otherinfo_result = mysqli_fetch_assoc($search_otherinfo_result)) {
                                $l = 0;
                                for($i=$CountCategory3ItemArray[0]; $i<=$CountCategory3ItemArray[1]; $i++) {
                                    $OtherInformation = "OtherInformation".$i;
                                    $$OtherInformation = $one_search_otherinfo_result["$OtherInformation"];
                                    $sheet->setCellValue($ColumnArray[$InformationColumn+$l+1].$OtherInformationRow, $$OtherInformation);
                                    $l++;
                                }
                                $OtherInformationRow++;
                            }
                        }  
                        
                        // 第三行Information
                        // 合并单元格
                        $sheet->mergeCells($ColumnArray[$InformationColumn+1]."3:".$ColumnArray[$InformationColumn+$CountCategory3ItemArray[1]-$CountCategory3ItemArray[0]+1]."3");
                        
                        // 第四行Column
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."4:".$ColumnArray[$InformationColumn+$CountCategory3ItemArray[1]-$CountCategory3ItemArray[0]+1]."4")->getFont()->setBold(true);

                        // OtherInformation边框
                        $OtherInformationBorder = [
                            'borders' => [
                                'outline' => [
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                    'color' => ['argb' => '0000FF'],
                                ],
                            ],
                        ];
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."3:".$ColumnArray[$InformationColumn+$CountCategory3ItemArray[1]-$CountCategory3ItemArray[0]+1].($OtherInformationRow-1))->applyFromArray($OtherInformationBorder);
                        
                        // 全体居中
                        $sheet->getStyle("A1:".$ColumnArray[$InformationColumn+$CountCategory3ItemArray[1]].($OtherInformationRow-1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        
                        // 第一行标题
                        // 合并单元格
                        $sheet->mergeCells("A1:".$ColumnArray[$InformationColumn+$CountCategory3ItemArray[1]-$CountCategory3ItemArray[0]+1]."1");
                        
                        // 第二行标题
                        // 合并单元格
                        $sheet->mergeCells("A2:".$ColumnArray[$InformationColumn+$CountCategory3ItemArray[1]-$CountCategory3ItemArray[0]+1]."2");
                    }
                    if($CategoryName == "Category4Name") {
                        $Category4Name = $one_search_column_result["Category4Name"];
                        $CountCategory4Item = $one_search_column_result["CountCategory4Item"];
                        $CountCategory4ItemArray = explode(",",$CountCategory4Item);
                        
                        // 设置值
                        $sheet->setCellValue($ColumnArray[$InformationColumn+1]."3", $Category4Name);
                        // 字体大小
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."3")->getFont()->setSize(15);
                        // 加粗
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."3")->getFont()->setBold(true);
                        
                        $k = 0;
                        for($i=$CountCategory4ItemArray[0]; $i<=$CountCategory4ItemArray[1]; $i++) {
                            $OtherInformationName = "OtherInformationName".$i;
                            $$OtherInformationName = $one_search_column_result["$OtherInformationName"];
                            $sheet->setCellValue($ColumnArray[$InformationColumn+$k+1]."4", $$OtherInformationName);
                            $k++;
                        }
                        
                        $search_otherinfo_sql = "SELECT * FROM spreadsheetcontent WHERE SpreadSheetColumnId = $Id";
                        $search_otherinfo_result = mysqli_query($conn, $search_otherinfo_sql);
                        
                        // 第5行开始
                        $OtherInformationRow = 5;
                        
                        if (!$search_otherinfo_result || mysqli_num_rows($search_otherinfo_result) == 0){
                            
                        }
                        else {
                            while ($one_search_otherinfo_result = mysqli_fetch_assoc($search_otherinfo_result)) {
                                $l = 0;
                                for($i=$CountCategory4ItemArray[0]; $i<=$CountCategory4ItemArray[1]; $i++) {
                                    $OtherInformation = "OtherInformation".$i;
                                    $$OtherInformation = $one_search_otherinfo_result["$OtherInformation"];
                                    $sheet->setCellValue($ColumnArray[$InformationColumn+$l+1].$OtherInformationRow, $$OtherInformation);
                                    $l++;
                                }
                                $OtherInformationRow++;
                            }
                        }  
                        
                        // 第三行Information
                        // 合并单元格
                        $sheet->mergeCells($ColumnArray[$InformationColumn+1]."3:".$ColumnArray[$InformationColumn+$CountCategory4ItemArray[1]-$CountCategory4ItemArray[0]+1]."3");
                        
                        // 第四行Column
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."4:".$ColumnArray[$InformationColumn+$CountCategory4ItemArray[1]-$CountCategory4ItemArray[0]+1]."4")->getFont()->setBold(true);

                        // OtherInformation边框
                        $OtherInformationBorder = [
                            'borders' => [
                                'outline' => [
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                    'color' => ['argb' => '0000FF'],
                                ],
                            ],
                        ];
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."3:".$ColumnArray[$InformationColumn+$CountCategory4ItemArray[1]-$CountCategory4ItemArray[0]+1].($OtherInformationRow-1))->applyFromArray($OtherInformationBorder);
                        
                        // 全体居中
                        $sheet->getStyle("A1:".$ColumnArray[$InformationColumn+$CountCategory4ItemArray[1]].($OtherInformationRow-1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        
                        // 第一行标题
                        // 合并单元格
                        $sheet->mergeCells("A1:".$ColumnArray[$InformationColumn+$CountCategory4ItemArray[1]-$CountCategory4ItemArray[0]+1]."1");
                        
                        // 第二行标题
                        // 合并单元格
                        $sheet->mergeCells("A2:".$ColumnArray[$InformationColumn+$CountCategory4ItemArray[1]-$CountCategory4ItemArray[0]+1]."2");
                    }
                    if($CategoryName == "Category5Name") {
                        $Category5Name = $one_search_column_result["Category5Name"];
                        $CountCategory5Item = $one_search_column_result["CountCategory5Item"];
                        $CountCategory5ItemArray = explode(",",$CountCategory5Item);
                        
                        // 设置值
                        $sheet->setCellValue($ColumnArray[$InformationColumn+1]."3", $Category5Name);
                        // 字体大小
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."3")->getFont()->setSize(15);
                        // 加粗
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."3")->getFont()->setBold(true);
                        
                        $k = 0;
                        for($i=$CountCategory5ItemArray[0]; $i<=$CountCategory5ItemArray[1]; $i++) {
                            $OtherInformationName = "OtherInformationName".$i;
                            $$OtherInformationName = $one_search_column_result["$OtherInformationName"];
                            $sheet->setCellValue($ColumnArray[$InformationColumn+$k+1]."4", $$OtherInformationName);
                            $k++;
                        }

                        $search_otherinfo_sql = "SELECT * FROM spreadsheetcontent WHERE SpreadSheetColumnId = $Id";
                        $search_otherinfo_result = mysqli_query($conn, $search_otherinfo_sql);
                        
                        // 第5行开始
                        $OtherInformationRow = 5;
                        
                        if (!$search_otherinfo_result || mysqli_num_rows($search_otherinfo_result) == 0){
                            
                        }
                        else {
                            while ($one_search_otherinfo_result = mysqli_fetch_assoc($search_otherinfo_result)) {
                                $l = 0;
                                for($i=$CountCategory5ItemArray[0]; $i<=$CountCategory5ItemArray[1]; $i++) {
                                    $OtherInformation = "OtherInformation".$i;
                                    $$OtherInformation = $one_search_otherinfo_result["$OtherInformation"];
                                    $sheet->setCellValue($ColumnArray[$InformationColumn+$l+1].$OtherInformationRow, $$OtherInformation);
                                    $l++;
                                }
                                $OtherInformationRow++;
                            }
                        }  
                        
                        // 第三行Information
                        // 合并单元格
                        $sheet->mergeCells($ColumnArray[$InformationColumn+1]."3:".$ColumnArray[$InformationColumn+$CountCategory5ItemArray[1]-$CountCategory5ItemArray[0]+1]."3");
                        
                        // 第四行Column
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."4:".$ColumnArray[$InformationColumn+$CountCategory5ItemArray[1]-$CountCategory5ItemArray[0]+1]."4")->getFont()->setBold(true);

                        // OtherInformation边框
                        $OtherInformationBorder = [
                            'borders' => [
                                'outline' => [
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                    'color' => ['argb' => '0000FF'],
                                ],
                            ],
                        ];
                        $sheet->getStyle($ColumnArray[$InformationColumn+1]."3:".$ColumnArray[$InformationColumn+$CountCategory5ItemArray[1]-$CountCategory5ItemArray[0]+1].($OtherInformationRow-1))->applyFromArray($OtherInformationBorder);
                        
                        // 全体居中
                        $sheet->getStyle("A1:".$ColumnArray[$InformationColumn+$CountCategory5ItemArray[1]].($OtherInformationRow-1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        
                        // 第一行标题
                        // 合并单元格
                        $sheet->mergeCells("A1:".$ColumnArray[$InformationColumn+$CountCategory5ItemArray[1]-$CountCategory5ItemArray[0]+1]."1");
                        
                        // 第二行标题
                        // 合并单元格
                        $sheet->mergeCells("A2:".$ColumnArray[$InformationColumn+$CountCategory5ItemArray[1]-$CountCategory5ItemArray[0]+1]."2");
                    }
                }
                else {
                    // 全体居中
                    $sheet->getStyle("A1:".$ColumnArray[$InformationColumn-1].($InformationRow-1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                    // 第一行标题
                    // 合并单元格
                    $sheet->mergeCells("A1:".$ColumnArray[$InformationColumn-1]."1");

                    // 第二行标题
                    // 合并单元格
                    $sheet->mergeCells("A2:".$ColumnArray[$InformationColumn-1]."2");
                }

                $writer = new Xlsx($spreadsheet);
                $writer->save("excel/".$Email."_".$Id.".xlsx");

                mysqli_close($conn);
                header("Location:downloadSheet.php?Email=$Email&&Id=$Id");
            }
        }
    }
    else {
        header("Location:../404.php");
    }
?>
