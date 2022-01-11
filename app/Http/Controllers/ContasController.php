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
        $tabela->tipo = $request->tipo;

        if ($request->valor > 0 && is_numeric($request->valor)) {
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

    public function executarSaque(Request $request)
    {
        $tabela = new transacoe();
        $tabela->cpf_usuario_remetente = $request->cpf;
        $tabela->cpf_usuario_destinatario = $request->cpf;
        $tabela->valor_transacao = $request->valor;
        $tabela->tipo = $request->tipo;
        @session_start();
        $contas = conta::where('cpf_usuario', '=', $request->cpf)->first();

        if ($request->valor <= $contas->saldo && is_numeric($request->valor)) {
            $tabela->save();

            $usuarios = conta::where('cpf_usuario', '=', $request->cpf)->first();
            $usuarios->saldo = $usuarios->saldo - $request->valor;

            $usuarios->save();

            $usuario = $request->cpf;
            $usuarios = usuario::where('cpf', '=', $usuario)->first();

            if (@$usuarios->id != null) {

                $_SESSION['id_usuario'] = $usuarios->id;
                $_SESSION['cpf_usuario'] = $usuarios->cpf;
                $_SESSION['nome_usuario'] = $usuarios->nome;
                $_SESSION['email_usuario'] = $usuarios->email;
                $_SESSION['numero_conta_usuario'] = $usuarios->numero_conta;
                $contas = conta::where('cpf_usuario', '=', $usuarios->cpf)->first();
                $_SESSION['saldo_usuario'] = 'R$' . number_format((float)$contas->saldo, 2, ',', '');
            }

            return view('painel-usuario.sacar');
        } else {
            echo "<script language='javascript'> window.alert('Você não possui saldo suficiente!!') </script>";
            return view('painel-usuario.sacar');
        }
    }

    public function executarTransferencia(Request $request)
    {
        $tabela = new transacoe();
        $tabela->cpf_usuario_remetente = $request->cpf_remetente;
        $tabela->cpf_usuario_destinatario = $request->cpf_destinatario;
        $tabela->valor_transacao = $request->valor;
        $tabela->tipo = $request->tipo;

        //Verifica se o usuário destinatário existe no banco
        $usuarios = conta::where('cpf_usuario', '=', $request->cpf_destinatario)->count();
        if ($usuarios <= 0) {
            echo "<script language='javascript'> window.alert('O CPF digitado é inválido !!') </script>";
            return view('painel-usuario.transferir');
        }

        @session_start();
        $contas = conta::where('cpf_usuario', '=', $request->cpf_remetente)->first();

        if (($request->valor <= $contas->saldo) && is_numeric($request->valor)) {
            $tabela->save();

            //Atualizando o usuário que faz o depósito
            $usuarios = conta::where('cpf_usuario', '=', $request->cpf_remetente)->first();
            $usuarios->saldo = $usuarios->saldo - $request->valor;
            $usuarios->save();

            //Atualizando o usuário que realiza o depósito
            $usuarios = conta::where('cpf_usuario', '=', $request->cpf_destinatario)->first();
            $usuarios->saldo = $usuarios->saldo + $request->valor;
            $usuarios->save();

            $usuario = $request->cpf_remetente;
            $usuarios = usuario::where('cpf', '=', $usuario)->first();

            if (@$usuarios->id != null) {

                $_SESSION['id_usuario'] = $usuarios->id;
                $_SESSION['cpf_usuario'] = $usuarios->cpf;
                $_SESSION['nome_usuario'] = $usuarios->nome;
                $_SESSION['email_usuario'] = $usuarios->email;
                $_SESSION['numero_conta_usuario'] = $usuarios->numero_conta;
                $contas = conta::where('cpf_usuario', '=', $usuarios->cpf)->first();
                $_SESSION['saldo_usuario'] = 'R$' . number_format((float)$contas->saldo, 2, ',', '');
            }

            return view('painel-usuario.transferir');
        } else {
            echo "<script language='javascript'> window.alert('Você não possui saldo suficiente!!') </script>";
            return view('painel-usuario.transferir');
        }
    }


    public function exibirTransacoes()
    {
        @session_start();
        $tabela = transacoe::orderby('id', 'desc')->where('cpf_usuario_destinatario', '=', $_SESSION['cpf_usuario'])->orwhere('cpf_usuario_remetente', '=', $_SESSION['cpf_usuario'])->paginate();
        return view('painel-usuario.transacoes', ['itens' => $tabela]);
    }


    public function exibirGrafico()
    {
        @session_start();
        $tabela = transacoe::orderby('id', 'desc')->where('cpf_usuario_destinatario', '=', $_SESSION['cpf_usuario'])->orwhere('cpf_usuario_remetente', '=', $_SESSION['cpf_usuario'])->paginate();

        return view('painel-usuario.grafico', ['itens' => $tabela]);
    }

    public function filtrarTransacoes(Request $request)
    {
        $data_inicio  = $request->data_inicio;
        $data_fim = $request->data_fim;
        @session_start();
        $tabela = transacoe::orderby('id', 'desc')->where(function ($query) {
            $query->where('cpf_usuario_destinatario', '=', $_SESSION['cpf_usuario'])
                ->orWhere('cpf_usuario_remetente', '=', $_SESSION['cpf_usuario']);
        })->where('created_at', '>=', $data_inicio)->where('created_at', '<=', $data_fim)->paginate();


        return view('painel-usuario.transacoes', ['itens' => $tabela]);
    }
}
