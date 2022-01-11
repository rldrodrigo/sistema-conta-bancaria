@extends('template.painel-principal')
@section('content')
@section('title', 'Transações ')
<?php

use App\Models\transacoe;
use App\Models\usuario;

@session_start();
?>

<img src="{{ URL::asset('img/grafico1.php') }}" alt="teste">

@endsection