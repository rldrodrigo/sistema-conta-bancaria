<?php

namespace App\Http\Controllers;

use App\Models\conta;
use App\Models\usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{


    public function login(Request $request)
    {

        $usuario = $request->usuario;
        $senha = $request->senha;

        $usuarios = usuario::where('email', '=', $usuario)->orwhere('cpf', '=', $usuario)->where('senha', '=', $senha)->first();

        if (@$usuarios->id != null) {
            @session_start();
            $_SESSION['id_usuario'] = $usuarios->id;
            $_SESSION['cpf_usuario'] = $usuarios->cpf;
            $_SESSION['nome_usuario'] = $usuarios->nome;
            $_SESSION['email_usuario'] = $usuarios->email;
            $_SESSION['numero_conta_usuario'] = $usuarios->numero_conta;
            $contas = conta::where('cpf_usuario', '=', $usuarios->cpf)->first();
            $_SESSION['saldo_usuario'] = 'R$' . number_format((float)$contas->saldo, 2, ',', '');


            return view('painel-usuario.index');
        } else {
            echo "<script language='javascript'> window.alert('Dados Incorretos!') </script>";
            return view('index');
        }
    }

    public function logout()
    {
        @session_start();
        @session_destroy();
        return view('index');
    }


    public function insert(Request $request)
    {

        $itens = 1;

        while ($itens > 0) {
            $numero_conta = rand(10000, 99999);
            $itens = usuario::where('numero_conta', '=', $numero_conta)->count();
        }

        $tabela = new usuario();
        $tabela->nome = $request->nome;
        $tabela->email = $request->email;
        $tabela->cpf = $request->cpf;
        $tabela->telefone = $request->telefone;
        $tabela->endereco = $request->endereco;
        $tabela->data_nascimento = $request->data_nascimento;
        $tabela->sexo = $request->sexo;
        $tabela->senha = $request->senha;
        $tabela->numero_conta = $numero_conta;



        $tabela2 = new conta();
        $tabela2->cpf_usuario = $tabela->cpf;
        $tabela2->numero_conta = $numero_conta;
        $tabela2->saldo = 0;




        /* Validar o CPF */
        $cpf = $tabela->cpf;
        $teste = true;
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            $teste = false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $teste = false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $teste = false;
            }
        }

        // Verifica o CPF
        if ($teste) {

            $itens = usuario::where('cpf', '=', $request->cpf)->orwhere('email', '=', $request->email)->count();
            if ($itens > 0) {
                echo "<script language='javascript'> window.alert('Registro já cadastrado!!') </script>";
                return view('registrar');
            } else {
                $tabela->save();
                $tabela2->save();
                echo "<script language='javascript'> window.alert('Usuário Cadastrado com Sucesso!!') </script>";
                return view('index');
            }
        } else {
            echo "<script language='javascript'> window.alert('CPF inválido!!') </script>";
            return view('registrar');
        }
    }
}
