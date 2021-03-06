<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang='pt-br' class=''>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script>
    <script src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script>
    <script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
    <link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
    <link rel="canonical" href="https://codepen.io/frytyler/pen/EGdtg" />

    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js'></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}" />

    <title>Registrar</title>
    <link rel="shortcut icon" href="{{ URL::asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ URL::asset('img/favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <div class="sidenav">
        <div class="login-main-text">
            <img src="{{ URL::asset('img/icone-banco-branco.png') }}" width="200px" alt="">
            <h1>Sistema Banc??rio</h1>
            <h2>Aplica????o criada em PHP</h2>
            <p>P??gina de Login e Registro</p>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="register-form">
                <form method="post" action="{{route('usuarios.insert')}}">
                    @csrf
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" placeholder="Nome" name="nome">
                    </div>
                    <div class="form-group">
                        <label>CPF</label>
                        <input type="text" class="form-control" placeholder="CPF" name="cpf" id="cpf">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Data de Nascimento</label>
                        <input type="date" class="form-control" name="data_nascimento">
                    </div>
                    <div class="form-group">
                        <label>Endere??o</label>
                        <input type="text" class="form-control" placeholder="Endere??o" name="endereco">
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" class="form-control" placeholder="Telefone" name="telefone" id="telefone">
                    </div>
                    <div class="form-group">
                        <label>Sexo</label>
                        <div>
                            <input type="radio" name="sexo" value="f" checked>
                            <label for="huey">Feminino</label>
                        </div>

                        <div>
                            <input type="radio" name="sexo" value="m">
                            <label for="dewey">Masculino</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" class="form-control" placeholder="Senha" name="senha">
                    </div>
                    <button type="submit" class="btn btn-black">Registrar</button>
                    <a href="/"><button type="button" class="btn btn-secondary">Voltar</button> </a>
                </form>
            </div>
        </div>
    </div>
    <script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script src="{{ URL::asset('js/mascaras.js') }}"></script>
</body>

</html>