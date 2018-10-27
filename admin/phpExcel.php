<?php
    require 'phpexcel/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->getDefaultColumnDimension()->setWidth(15);

    date_default_timezone_set("Asia/Singapore");
    $timestamp = date('y-m-d H:i:s',time());

    $ColumnArray = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ");
            
    $InformationColumn = 0;

    $SheetName = "";
    $SheetSubject = "";
    $InformationName1 = "";
    $InformationName2 = "";
    $InformationName3 = "";
    $InformationName4 = "";
    $InformationName5 = "";
    $InformationName6 = "";
    $InformationName7 = "";
    $InformationName8 = "";
    $InformationName9 = "";
    $InformationName10 = "";
    $isOtherInformation = 0;

    if(!empty($_POST["Id"]) && !empty($_POST["Email"]) && !empty($_POST["CategoryName"]) && !empty($_POST["SheetName"]) && !empty($_POST["SheetSubject"]) && !empty($_POST["InformationName1"])) {
        $Id = $_POST['Id'];
        $Email = $_POST['Email'];
        $CategoryName = $_POST['CategoryName'];
        $SheetName = $_POST['SheetName'];
        $SheetSubject = $_POST['SheetSubject'];
        $InformationName1 = $_POST['InformationName1'];
        $InformationName2 = $_POST['InformationName2'];
        $InformationName3 = $_POST['InformationName3'];
        $InformationName4 = $_POST['InformationName4'];
        $InformationName5 = $_POST['InformationName5'];
        $InformationName6 = $_POST['InformationName6'];
        $InformationName7 = $_POST['InformationName7'];
        $InformationName8 = $_POST['InformationName8'];
        $InformationName9 = $_POST['InformationName9'];
        $InformationName10 = $_POST['InformationName10'];
        $isOtherInformation = $_POST['isOtherInformation'];
        
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

        $sheet->setCellValue('A4', "Verification Code");
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
            $sheet->setCellValue('J3', $InformationName9);
            $InformationColumn++;
        }
        if(!empty($InformationName10)) {
            $sheet->setCellValue('K4', $InformationName10);
            $InformationColumn++;
        }
        
        // 第5行开始
        $InformationRow = 5;
        while(!empty($_POST["Row".$InformationRow."VerificationCode"])) {
            $VerificationCode = $_POST["Row".$InformationRow."VerificationCode"];
            $Information1 = $_POST["Row".$InformationRow."Information1"];
            $Information2 = $_POST["Row".$InformationRow."Information2"];
            $Information3 = $_POST["Row".$InformationRow."Information3"];
            $Information4 = $_POST["Row".$InformationRow."Information4"];
            $Information5 = $_POST["Row".$InformationRow."Information5"];
            $Information6 = $_POST["Row".$InformationRow."Information6"];
            $Information7 = $_POST["Row".$InformationRow."Information7"];
            $Information8 = $_POST["Row".$InformationRow."Information8"];
            $Information9 = $_POST["Row".$InformationRow."Information9"];
            $Information10 = $_POST["Row".$InformationRow."Information10"];
            
            $sheet->setCellValue("A$InformationRow", $VerificationCode);
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
        $sheet->getStyle("A4:".$ColumnArray[$InformationColumn-1]."4")->getFont()->setBold(true);

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
            // 设置值
            $sheet->setCellValue($ColumnArray[$InformationColumn+1]."3", "Other Information");
            // 字体大小
            $sheet->getStyle($ColumnArray[$InformationColumn+1]."3")->getFont()->setSize(15);
            // 加粗
            $sheet->getStyle($ColumnArray[$InformationColumn+1]."3")->getFont()->setBold(true);
            
            if($CategoryName == "Category1Name") {
                $Category1Name = $_POST["Category1Name"];
                $CountCategory1Item = $_POST["CountCategory1Item"];
                $CountCategory1ItemArray = explode(",",$CountCategory1Item);
                
                $k = 0;
                for($i=$CountCategory1ItemArray[0]; $i<=$CountCategory1ItemArray[1]; $i++) {
                    $OtherInformationName = "OtherInformationName".$i;
                    $$OtherInformationName = $_POST["$OtherInformationName"];
                    $sheet->setCellValue($ColumnArray[$InformationColumn+$k+1]."4", $$OtherInformationName);
                    $k++;
                }
                
                // 第5行开始
                $OtherInformationRow = 5;
                while($OtherInformationRow < $InformationRow) {        
                    $l = 0;
                    for($i=$CountCategory1ItemArray[0]; $i<=$CountCategory1ItemArray[1]; $i++) {
                        $OtherInformation = "OtherInformation".$i;
                        $$OtherInformation = $_POST["Row".$OtherInformationRow.$OtherInformation];
                        $sheet->setCellValue($ColumnArray[$InformationColumn+$l+1].$OtherInformationRow, $$OtherInformation);
                        $l++;
                    }
                    $OtherInformationRow++;
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
                $Category2Name = $_POST["Category2Name"];
                $CountCategory2Item = $_POST["CountCategory2Item"];
                $CountCategory2ItemArray = explode(",",$CountCategory2Item);

                $k = 0;
                for($i=$CountCategory2ItemArray[0]; $i<=$CountCategory2ItemArray[1]; $i++) {
                    $OtherInformationName = "OtherInformationName".$i;
                    $$OtherInformationName = $_POST["$OtherInformationName"];
                    $sheet->setCellValue($ColumnArray[$InformationColumn+$k+1]."4", $$OtherInformationName);
                    $k++;
                }
                
                // 第5行开始
                $OtherInformationRow = 5;
                while($OtherInformationRow < $InformationRow) {        
                    $l = 0;
                    for($i=$CountCategory2ItemArray[0]; $i<=$CountCategory2ItemArray[1]; $i++) {
                        $OtherInformation = "OtherInformation".$i;
                        $$OtherInformation = $_POST["Row".$OtherInformationRow.$OtherInformation];
                        $sheet->setCellValue($ColumnArray[$InformationColumn+$l+1].$OtherInformationRow, $$OtherInformation);
                        $l++;
                    }
                    $OtherInformationRow++;
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
                $Category3Name = $_POST["Category3Name"];
                $CountCategory3Item = $_POST["CountCategory3Item"];
                $CountCategory3ItemArray = explode(",",$CountCategory3Item);
                
                $k = 0;
                for($i=$CountCategory3ItemArray[0]; $i<=$CountCategory3ItemArray[1]; $i++) {
                    $OtherInformationName = "OtherInformationName".$i;
                    $$OtherInformationName = $_POST["$OtherInformationName"];
                    $sheet->setCellValue($ColumnArray[$InformationColumn+$k+1]."4", $$OtherInformationName);
                    $k++;
                }
                
                // 第5行开始
                $OtherInformationRow = 5;
                while($OtherInformationRow < $InformationRow) {        
                    $l = 0;
                    for($i=$CountCategory3ItemArray[0]; $i<=$CountCategory3ItemArray[1]; $i++) {
                        $OtherInformation = "OtherInformation".$i;
                        $$OtherInformation = $_POST["Row".$OtherInformationRow.$OtherInformation];
                        $sheet->setCellValue($ColumnArray[$InformationColumn+$l+1].$OtherInformationRow, $$OtherInformation);
                        $l++;
                    }
                    $OtherInformationRow++;
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
                $Category4Name = $_POST["Category4Name"];
                $CountCategory4Item = $_POST["CountCategory4Item"];
                $CountCategory4ItemArray = explode(",",$CountCategory4Item);
                
                $k = 0;
                for($i=$CountCategory4ItemArray[0]; $i<=$CountCategory4ItemArray[1]; $i++) {
                    $OtherInformationName = "OtherInformationName".$i;
                    $$OtherInformationName = $_POST["$OtherInformationName"];
                    $sheet->setCellValue($ColumnArray[$InformationColumn+$k+1]."4", $$OtherInformationName);
                    $k++;
                }
                
                // 第5行开始
                $OtherInformationRow = 5;
                while($OtherInformationRow < $InformationRow) {        
                    $l = 0;
                    for($i=$CountCategory4ItemArray[0]; $i<=$CountCategory4ItemArray[1]; $i++) {
                        $OtherInformation = "OtherInformation".$i;
                        $$OtherInformation = $_POST["Row".$OtherInformationRow.$OtherInformation];
                        $sheet->setCellValue($ColumnArray[$InformationColumn+$l+1].$OtherInformationRow, $$OtherInformation);
                        $l++;
                    }
                    $OtherInformationRow++;
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
                $Category5Name = $_POST["Category5Name"];
                $CountCategory5Item = $_POST["CountCategory5Item"];
                $CountCategory5ItemArray = explode(",",$CountCategory5Item);
                
                $k = 0;
                for($i=$CountCategory5ItemArray[0]; $i<=$CountCategory5ItemArray[1]; $i++) {
                    $OtherInformationName = "OtherInformationName".$i;
                    $$OtherInformationName = $_POST["$OtherInformationName"];
                    $sheet->setCellValue($ColumnArray[$InformationColumn+$k+1]."4", $$OtherInformationName);
                    $k++;
                }
                
                // 第5行开始
                $OtherInformationRow = 5;
                while($OtherInformationRow < $InformationRow) {        
                    $l = 0;
                    for($i=$CountCategory5ItemArray[0]; $i<=$CountCategory5ItemArray[1]; $i++) {
                        $OtherInformation = "OtherInformation".$i;
                        $$OtherInformation = $_POST["Row".$OtherInformationRow.$OtherInformation];
                        $sheet->setCellValue($ColumnArray[$InformationColumn+$l+1].$OtherInformationRow, $$OtherInformation);
                        $l++;
                    }
                    $OtherInformationRow++;
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
    } 
    else {
        echo "Error";
    }
?>