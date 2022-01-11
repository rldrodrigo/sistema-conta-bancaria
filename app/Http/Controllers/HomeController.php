<?php

namespace App\Http\Controllers;

use App\Models\transacoe;
use Illuminate\Http\Request;
use Mockery\Undefined;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('index');
    }

    public function registrar()
    {
        return view('registrar');
    }

    public function voltar()
    {
        //Implementar lógica para não ter acesso direto
        @session_start();
        if (isset($_SESSION['cpf_usuario'])) {

            $tabela = transacoe::orderby('id', 'desc')->where('cpf_usuario_destinatario', '=', $_SESSION['cpf_usuario'])->orwhere('cpf_usuario_remetente', '=', $_SESSION['cpf_usuario'])->paginate();

            return view('painel-usuario.index', ['itens' => $tabela]);
        }
        return view('index');
    }
}
