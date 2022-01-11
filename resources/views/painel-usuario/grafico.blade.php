@extends('template.painel-principal')
@section('content')
@section('title', 'Transações ')
<?php

use App\Models\transacoe;
use App\Models\usuario;

@session_start();
?>
<?php /*
Get_include_path();
require_once "{{ URL::asset('script/phplot.php')}}";
function graficoBarra($data, $archivo = "", $meta_data = array('titulo' => 'Sin Título', 'tituloX' => 'Eje X', 'tituloY' => 'Eje Y', 'color' => 'SkyBlue', 'width' => 800, 'height' => 600, 'angle' => 45), $legend = array("Datos"))
{
    # Objeto que crea el gráfico y su tama?o
    $plot = new PHPlot($meta_data['width'], $meta_data['height']);
    $plot->SetImageBorderType('plain');
    # Setea el archivo donde se guarda la imagen generada y no permite la visualización inmediata
    $plot->SetPrintImage(false);
    $plot->SetFileFormat("jpg");
    $plot->SetOutputFile($archivo);
    $plot->SetIsInline(true);
    # Envio de datos
    $plot->SetDataValues($data);
    # Tipo de gráfico y datos
    $plot->SetDataType("text-data");
    $plot->SetPlotType("bars");
    # Setiando el True type font
    //$plot->SetTTFPath(TTFPath);
    //$plot->SetUseTTF(TRUE);
    $plot->SetAxisFontSize(2);
    $plot->SetVertTickIncrement(7);
    //$plot->SetXTickLength(7);
    //$plot->SetDataColors($meta_data['color']);
    $plot->SetDataColors(array($meta_data['color'], 'red', 'white'));
    $plot->SetLegendPixels(1, 1);
    $plot->SetLegend($legend);
    # Etiquetas del eje Y:
    $plot->SetYTitle($meta_data['tituloY']);
    $plot->SetYDataLabelPos('plotin');
    # Título principal del gráfico:
    $plot->SetTitle($meta_data['titulo']);
    # Etiquetas eje X:
    $plot->SetXTitle($meta_data['tituloX']);
    if (isset($meta_data['angle'])) {
        $plot->SetXLabelAngle($meta_data['angle']);
    } else {
        $plot->SetXLabelAngle(45);
    }
    $plot->SetXTickLabelPos('none');
    $plot->SetXTickPos('none');
    # Método que dibuja el gráfico
    $plot->DrawGraph();
    $plot->PrintImage();
}*/
?>


@endsection