@extends('template.painel-principal')
@section('content')
@section('title', 'Bem Vindo! ')
<?php

@session_start();

?>
<h6 class="mb-4"><i>TRANSFERIR PARA OUTRA CONTA</i></h6>
<hr>
<form method="POST">
    @csrf

    <div class="row">
        <div class="col-md-12">
            <h1>SALDO DISPONIVEL: {{$_SESSION['saldo_usuario']}}</h1>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Digite o Valor da Transferência</label>
                <input type="text" class="form-control" id="" name="nome" required>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Digite o CPF do destinatário:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required id="cpf">
            </div>
        </div>
    </div>
    <p align="right">
        <button type="submit" class="btn btn-primary">Depositar</button>
    </p>
    <img src="{{ URL::asset('img/transferir.png') }}" width="300px">

</form>

@endsection