<?php

namespace Moobi\Avaliacao\FPDF;
use FPDF;

class GerarPdfFiliados {

	public static function gerarPDFFiliados(array $aFiliados) : void {
		if(!empty($aFiliados)) {

			//Gerando pdf
			$oPdf = new FPDF();
			$oPdf->AddPage();
			$oPdf->SetFont('Arial', 'B', 16);

			//Titulo
			$oPdf->Cell(0, 10, 'Lista De Filiados',0,1,'C');
			$oPdf->Ln(10);

			//Cabecalho
			$oPdf->SetFont('Arial', 'B', 12);
			$oPdf->Cell(30, 10, 'Nome',1,0,'C');
			$oPdf->Cell(30,10, 'CPF',1,0,'C');
			$oPdf->Cell(30,10,'RG',1,0,'C');
			$oPdf->Cell(35,10,'Data Nascimento',1,0,'C');
			$oPdf->Cell(30,10,'Idade',1,0,'C');
			$oPdf->Ln();

			//Dados
			$oPdf->SetFont('Arial', '', 12);
			foreach($aFiliados as $aFiliado) {
				$oPdf->Cell(30, 10, $aFiliado->getNome(),1,0,'C');
				$oPdf->Cell(30,10, $aFiliado->getCpf(),1,0,'C');
				$oPdf->Cell(30,10, $aFiliado->getRg(),1,0,'C');
				$oPdf->Cell(35,10, $aFiliado->getDataNascimento(),1,0,'C');
				$oPdf->Cell(30,10, $aFiliado->getIdade(),1,0,'C');
				$oPdf->Ln();
			}

			$oPdf->Output('I','Filiados.pdf');
		}
	}
}