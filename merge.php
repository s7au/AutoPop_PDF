<?php

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');
require_once('fpdi/fpdi.php');
require_once('pageText.php');

//extends FDPI class to allow inputting information from text template
class concat_pdf extends FPDI {
    var $files;

    function setFiles($files) {
        $this->files = $files;
    }

    var $input;

    //an array of pageText - see pageText.php for more information
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

//initializes FDPI variables defined in previous function
function pageToPDF($page, $template, $text) {
    $pdf = new concat_pdf('P','mm','Letter');
    $pdf->setFiles($page); //$files is an array with existing PDF files.
    $pdf->setInput($text,$template);
    $pdf->concat();
    $pdf->Output('boo.pdf','I');
}

// main - too lazy to put on separate file
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //puts submit info into php template. array of personal info
    $pathToInput = array (
        "First_Name" => $_POST['First_Name'],
        "Last_Name" => $_POST['Last_Name'],
        "Street" => $_POST['Street'],
        "City" => $_POST['City'],
        "Province" => $_POST['Province'],
        "Country" => $_POST['Country'],
        "Postal_Code" => $_POST['Postal_Code'],
        "Phone" => $_POST['Phone'],
        "E_Mail" => $_POST['E_Mail'],
        "Day" => $_POST['Day'],
        "Month" => $_POST['Month'],
        "Year" => $_POST['Year'],
        $_POST["CustomField1"] => $_POST['CustomField1_Input'],
        $_POST["CustomField2"] => $_POST['CustomField2_Input'],
        );
    // var_dump($pathToInput);

    $pathToTemplate = $_FILES["input_template"]["tmp_name"];
    $pathToFile = $_FILES["PDF"]["tmp_name"];
    pageToPDF($pathToFile, $pathToTemplate, $pathToInput);
}


?>