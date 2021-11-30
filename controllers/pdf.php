<?php
class Pdf_Controller
{
	public $baseName = 'pdf';
	public function main(array $vars)
	{
        $pdfModel = new pdf_Model;
		$pdfModel->pdf();	
		$view = new View_Loader($this->baseName."_main");
	}
}
?>