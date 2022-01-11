<?php

namespace App\Http\Controllers;

use App\Models\conta;
use App\Models\transacoe;
use App\Models\usuario;
use Illuminate\Http\Request;

class ContasController extends Controller
{
    public function depositar()
    {
        return view('painel-usuario.depositar');
    }
    public function sacar()
    {
        return view('painel-usuario.sacar');
    }
    public function transferir()
    {
        return view('painel-usuario.transferir');
    }

    public function executarDeposito(Request $request)
    {
        $tabela = new transacoe();
        $tabela->cpf_usuario_remetente = $request->cpf;
        $tabela->cpf_usuario_destinatario = $request->cpf;
        $tabela->valor_transacao = $request->valor;

        if ($request->valor > 0) {
            $tabela->save();

            $usuarios = conta::where('cpf_usuario', '=', $request->cpf)->first();
            $usuarios->saldo = $usuarios->saldo + $request->valor;

            $usuarios->save();

            $usuario = $request->cpf;
            $usuarios = usuario::where('cpf', '=', $usuario)->first();

            if (@$usuarios->id != null) {
                @session_start();
                $_SESSION['id_usuario'] = $usuarios->id;
                $_SESSION['cpf_usuario'] = $usuarios->cpf;
                $_SESSION['nome_usuario'] = $usuarios->nome;
                $_SESSION['email_usuario'] = $usuarios->email;
                $_SESSION['numero_conta_usuario'] = $usuarios->numero_conta;
                $contas = conta::where('cpf_usuario', '=', $usuarios->cpf)->first();
                $_SESSION['saldo_usuario'] = 'R$' . number_format((float)$contas->saldo, 2, ',', '');
            }

            return view('painel-usuario.depositar');
        } else {
            echo "<script language='javascript'> window.alert('Valor incorreto!!') </script>";
            return view('painel-usuario.depositar');
        }
    }
}
