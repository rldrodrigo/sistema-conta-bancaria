@extends('template.painel-principal')
@section('content')
@section('title', 'Bem Vindo! ')
<?php

@session_start();

?>
<h6 class="mb-4"><i>SACAR DINHEIRO</i></h6>
<hr>
<form method="POST">
    @csrf
    <div class="col-md-12">
        <h1>SALDO DISPONÍVEL: {{$_SESSION['saldo_usuario']}}</h1>
    </div>
    <div class="row" action="{{route('executar.saque')}}">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Digite o Valor do Saque</label>
                <input type="text" class="form-control" id="" name="valor" required>
            </div>
        </div>
    </div>
    <p align="right">
        <input value="{{$_SESSION['cpf_usuario']}}" type="hidden" name="cpf">
        <input value="saque" type="hidden" name="tipo">
        <button type="submit" class="btn btn-primary">Sacar</button>
    </p>
    <img src="{{ URL::asset('img/depositar.png') }}" width="300px">

</form>

@endsection