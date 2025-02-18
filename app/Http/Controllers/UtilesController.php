<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use SoapClient;

// use Mpdf\Mpdf;

class UtilesController extends Controller
{
    public function utiles_inicio(){
        return view('utiles.home');
    }
    public function utiles_pdf(){
        $mpdf = new Mpdf();
        $mpdf->WriteHTML('<h1>¡Hola Mundo!</h1>');
        $mpdf->Output();
           
    }

    public function utiles_excel(){
        $helper = new Sample();
        if($helper->isCli()){
            @$helper->log('This example should only be run from a Web Browser' . PHP_EOL);
            return;
        }
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()->setCreator('Guillermo Plisich')
        ->setLastModifiedBy('Plisich.uy')
        ->setTitle('Office 2007 XLSX Test Document')
        ->setSubject('Office 2007 XLSX Test Document')
        ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Test result file');

        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'ID')
        ->setCellValue('B1','Categoria')
        ->setCellValue('C1','Nombre')
        ->setCellValue('D1','Precio')
        ->setCellValue('E1','Stock')
        ->setCellValue('F1','Descripcion')
        ->setCellValue('G1','Fecha');

        $productos = Productos::orderBy('id','DESC')->get();
        $i=2;
        foreach($productos as $producto){
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $producto->id)
            ->setCellValue('B'.$i, $producto->categorias->nombre)
            ->setCellValue('C'.$i, $producto->nombre)
            ->setCellValue('D'.$i, $producto->precio)
            ->setCellValue('E'.$i, $producto->stock)
            ->setCellValue('F'.$i, $producto->descripcion)
            ->setCellValue('G'.$i, date('d-m-Y',strtotime($producto->fecha)));
            $i++;
        }

        $spreadsheet->getActiveSheet()->setTitle('Productos');

        $spreadsheet->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="productos_'.time().'.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expire: Mont, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $write = IOFactory::createWriter($spreadsheet,'Xlsx');
        $write->save('php://output');
        exit;

    }

    public function utiles_client_rest(){
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = $response->json();
        return view('utiles.client_rest',compact('posts'));
    }

    public function utiles_client_soap(){
        $client = new SoapClient('http://www.dneonline.com/calculator.asmx?WSDL');
        $datos = $client->Add(['intA'=>10,'intB'=>20]);
        // dd($datos);
        return view('utiles.client_soap',compact('datos'));
    }

}
