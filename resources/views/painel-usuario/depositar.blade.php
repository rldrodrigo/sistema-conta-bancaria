@extends('template.painel-principal')
@section('content')
@section('title', 'Bem Vindo! ')
<?php

@session_start();

?>
<h6 class="mb-4"><i>DEPOSITAR NA SUA CONTA</i></h6>
<hr>
<form method="POST">
    @csrf
    <div class="col-md-12">
        <h1>SALDO DISPONÍVEL: {{$_SESSION['saldo_usuario']}}</h1>
    </div>
    <div class="row" action="{{route('executar.deposito')}}">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Digite o Valor do Depósito</label>
                <input type="text" class="form-control" id="" name="valor" required>
            </div>
        </div>
    </div>
    <p align="right">
        <input value="{{$_SESSION['cpf_usuario']}}" type="hidden" name="cpf">
        <button type="submit" class="btn btn-primary">Depositar</button>
    </p>
    <img src="{{ URL::asset('img/depositar.png') }}" width="300px">

</form>

@endsection