@extends('template.painel-principal')
@section('content')
@section('title', 'Bem Vindo! ')
<?php

@session_start();

?>
<h6 class="mb-4"><i>TRANSFERIR PARA OUTRA CONTA</i></h6>
<hr>
<form method="POST" action="{{route('executar.transferencia')}}">
    @csrf

    <div class="row">
        <div class="col-md-12">
            <h1>SALDO DISPONIVEL: {{$_SESSION['saldo_usuario']}}</h1>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Digite o Valor da Transferência</label>
                <input type="text" class="form-control" id="" name="valor" required>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Digite o CPF do destinatário:</label>
                <input type="text" class="form-control" id="cpf" name="cpf_destinatario" required id="cpf">
            </div>
        </div>
    </div>
    <p align="right">
        <input value="transferencia" type="hidden" name="tipo">
        <input value="{{$_SESSION['cpf_usuario']}}" type="hidden" name="cpf_remetente">
        <button type="submit" class="btn btn-primary">Depositar</button>
    </p>
    <img src="{{ URL::asset('img/transferir.png') }}" width="300px">

</form>

@endsection