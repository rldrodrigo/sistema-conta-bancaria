<?php

namespace App\Http\Controllers;

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

    public function index()
    {
        $tabela = usuario::orderby('id', 'desc')->paginate();
        return view('painel-admin.usuarios.index', ['itens' => $tabela]);
    }

    public function delete(usuario $item)
    {
        $item->delete();
        return redirect()->route('usuarios.index');
    }

    public function modal($id)
    {
        $item = usuario::orderby('id', 'desc')->paginate();
        return view('painel-admin.usuarios.index', ['itens' => $item, 'id' => $id]);
    }
}
