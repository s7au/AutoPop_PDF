<?php

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');
require_once('fpdi/fpdi.php');
require_once('pageText.php');

$pathToFile = '/var/www/subdoc2.pdf';
$pathToTemplate = '/var/www/html/AutoPop_PDF/InputTemplateTest.txt';
$pathToInput = array(
    "Name" => "Shawn Au",
    "Address" => "46 WestBrook Drive",
    "Phone" => "7809053448",
    );

class concat_pdf extends FPDI {
    var $files;

    function setFiles($files) {
        $this->files = $files;
    }

    var $input;

    function setInput($input, $template) {
        $this->input = createArray($input,$template);
    }

    function concat() {
        $this->setPrintFooter(false);
        $this->setPrintHeader(false);
        $pagecount = $this->setSourceFile($this->files);
        for($i = 1; $i <= $pagecount; $i++) {
            $this->AddPage('P');
            $tplidx = $this->ImportPage($i);
            $this->useTemplate($tplidx);
            if (is_array($this->input[$i]) || is_object($this->input[$i])) {
                foreach($this->input[$i] as $text) {
                    $this->Text($text->x,$text->y,$text->info);
                }
            }
        }
    }
}

function pageToPDF($page, $template, $text) {
    $pdf = new concat_pdf('P','mm','Letter');
    $pdf->setFiles($page); //$files is an array with existing PDF files.
    $pdf->setInput($text,$template);
    $pdf->concat();
    $pdf->Output();
}

pageToPDF($pathToFile, $pathToTemplate, $pathToInput);

?>