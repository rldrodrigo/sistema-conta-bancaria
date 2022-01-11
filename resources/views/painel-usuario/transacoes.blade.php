@extends('template.painel-principal')
@section('content')
@section('title', 'Transações ')
<?php

use App\Models\transacoe;
use App\Models\usuario;

@session_start();

?>
<style>
    .status.saque {

        padding: 2px 4px;
        background: #f00;
        color: var(--white);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
    }

    .status.transferencia {

        padding: 2px 4px;
        background: #1795ce;
        color: var(--white);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
    }

    .status.deposito {

        padding: 2px 4px;
        background: #8de02c;
        color: var(--white);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
    }
</style>

<?php if (count($itens) > 0) { ?>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
            <tr>
                <td>Nome</td>
                <td>Valor</td>
                <td>Data</td>
                <td>Tipo</td>
            </tr>
            </tr>
        </thead>

        <tbody>
            @foreach($itens as $item)
            <?php
            $data = implode('/', array_reverse(explode('-', $item->created_at)));

            $usuario_remetente = usuario::where('id', '=', $item->instrutor)->first();
            $usuario_destinatario = usuario::where('id', '=', $item->instrutor)->first();


            ?>
            <tr>
                <td>{{$_SESSION['nome_usuario']}}</td>
                <td>{{'R$' . number_format((float)$item->valor_transacao, 2, ',', '')}}</td>
                <td>{{$item->created_at}}</td>
                <?php if ($item->tipo == 'saque') { ?>
                    <td><span class="status saque">Saque</span></td>
                <?php } ?>
                <?php if ($item->tipo == 'deposito') { ?>
                    <td><span class="status deposito">Depósito</span></td>
                <?php } ?>
                <?php if ($item->tipo == 'transferencia') { ?>
                    <td><span class="status transferencia">Transferência</span></td>
                <?php } ?>

            </tr>
            @endforeach
        </tbody>
    </table>
<?php } else { ?>
    <td>Nenhuma Transação Encontrada</td>
<?php } ?>

@endsection