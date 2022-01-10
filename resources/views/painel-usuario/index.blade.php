@extends('template.painel-principal')
@section('content')
@section('title', 'Bem Vindo! ')
<?php

@session_start();

?>
<!--  Main -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Ubuntu', sans-serif;
    }

    :root {
        --blue: #171717;
        --white: #fff;
        --grey: #f5f5f5;
        --black1: #222;
        --black2: #999;
    }

    body {
        min-height: 100vh;
        overflow-x: hidden;
    }

    .container {
        position: relative;
        width: 100%;
    }

    /*  Main  */

    .main {
        position: absolute;
        width: 100%;
        background: var(--white);
        transition: 0.5s;
        right: 5%;
    }

    .main.active {
        width: calc(100% - 80px);
        left: 0
    }

    .topbar {
        width: 100%;
        height: 60px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 10px;
    }

    .search {
        position: relative;
        width: 400px;
        margin: 0 10px;

    }

    .search label {
        position: relative;
        width: 100%;
    }

    .search label input {
        width: 100%;
        height: 40px;
        border-radius: 40px;
        padding: 5px 20px;
        padding-left: 35px;
        font-size: 18px;
        outline: none;
        border: 1px solid var(--black2);
    }

    .search label ion-icon {
        position: absolute;
        top: 0;
        left: 10px;
        font-size: 1.2em;

    }

    .user {
        position: relative;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
    }

    .user img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cardBox {
        position: relative;
        width: 100%;
        padding: 20px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-gap: 30px;
    }

    .cardBox .card {
        position: relative;
        background: var(--white);
        padding: 30px;
        border-radius: 20px;
        display: flex;
        justify-content: space-between;
        cursor: pointer;
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
    }

    .cardBox .card .numbers {
        position: relative;
        font-weight: 500;
        font-size: 2.5em;
        color: var(--blue);
    }

    .cardBox .card .cardName {
        color: var(--black2);
        font-size: 1.1em;
        margin-top: 5px;
    }

    .cardBox .card .iconBx {
        font-size: 3.5em;
        color: var(--black2);
    }

    .cardBox .card:hover {
        background: var(--blue);
    }

    .cardBox .card:hover .numbers,
    .cardBox .card:hover .cardName,
    .cardBox .card:hover .iconBx {
        color: var(--white);
    }

    .details {
        position: relative;
        width: 100%;
        padding: 20px;
        display: grid;
        grid-template-columns: 2fr 1fr;
        grid-gap: 30px;
        /* margin-top: 10px;*/
    }

    .details .recentOrders {
        position: relative;
        display: grid;
        min-height: 500px;
        background: var(--white);
        padding: 20px;
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
        border-radius: 20px;
    }

    .cardHeader {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .cardHeader h2 {
        font-weight: 600;
        color: var(--blue);
    }

    .btn {
        position: relative;
        padding: 5px 10px;
        background: var(--blue);
        text-decoration: none;
        color: var(--white);
        border-radius: 6px;
    }

    .details table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .details table thead td {
        font-weight: 600;
    }

    .details .recentOrders table tr {
        color: var(--black1);
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .details .recentOrders table tr:last-child {
        border-bottom: none;
    }

    .details .recentOrders table tbody tr:hover {
        background: var(--blue);
        color: var(--white);
    }

    .details .recentOrders table tr td {
        padding: 10px;

    }

    .details .recentOrders table tr td:last-child {
        text-align: end;
    }

    .details .recentOrders table tr td:nth-child(2) {
        text-align: end;
    }

    .details .recentOrders table tr td:nth-child(3) {
        text-align: center;
    }

    .status.delivered {

        padding: 2px 4px;
        background: #8de02c;
        color: var(--white);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
    }

    .status.return {

        padding: 2px 4px;
        background: #f00;
        color: var(--white);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
    }

    .status.pending {

        padding: 2px 4px;
        background: #f9ca3f;
        color: var(--white);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
    }

    .status.inprogress {

        padding: 2px 4px;
        background: #1795ce;
        color: var(--white);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
    }

    .recentCustomers {
        position: relative;
        display: grid;
        min-height: 500px;
        padding: 20px;
        background: var(--white);
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
        border-radius: 20px;
    }

    .recentCustomers .imgBx {
        position: relative;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
    }

    .recentCustomers .imgBx img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }


    .recentCustomers table tr td {
        padding: 12px 10px;
    }

    .recentCustomers table tr td h4 {
        font-size: 16px;
        font-weight: 500;
        line-height: 1.2em;
    }

    .recentCustomers table tr td h4 span {
        font-size: 14px;
        color: var(--black2);
    }

    .recentCustomers table tr:hover {
        background: var(--blue);
        color: var(--white);
    }

    .recentCustomers table tr:hover td h4 span {
        columns: var(--white);
    }


    /*  Design Responsivo */

    @media (max-width: 1600px) {

        .navigation.active {
            width: 300px;

        }

        .cardBox .card .numbers {
            position: relative;
            font-weight: 500;
            font-size: 2.5em;
            color: var(--blue);
        }

        .main {
            width: 100%;
        }


        .cardBox {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 991px) {

        .navigation.active {
            width: 300px;

        }

        .cardBox .card .numbers {
            position: relative;
            font-weight: 500;
            font-size: 2em;
            color: var(--blue);
        }

        .main {
            width: 100%;
        }


        .cardBox {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .details {
            grid-template-columns: repeat(1, 1fr);
        }

        .recentOrders {
            overflow-x: auto;
        }

        .status.inprogress {
            white-space: none;
        }
    }

    @media (max-width: 480px) {
        .cardBox {
            grid-template-columns: repeat(1, 1fr);
        }

        .cardHeader h2 {
            font-size: 20px;
        }

        .cardBox .card .numbers {
            position: relative;
            font-weight: 500;
            font-size: 1em;
            color: var(--blue);
        }

        .user {
            min-width: 40px;
        }

        .toggle {
            z-index: 10001;
        }

    }
</style>
<div class="container">
    <div class="main">
        <div class="topbar">


            <!-- Pesquisa -->
            <div class="search">
                <label>
                    <input type="text" placeholder="Pesquisa">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>

        </div>

        <!-- Cards -->
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="numbers">1,504</div>
                    <div class="cardName">Daily Views</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="eye-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">80</div>
                    <div class="cardName">Operações no dia</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="cart-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">R$500,00</div>
                    <div class="cardName">Limite do Cartão</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="chatbubbles-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">{{$_SESSION['saldo_usuario']}}</div>
                    <div class="cardName">Saldo Disponível</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="cash-outline"></ion-icon>
                </div>
            </div>
        </div>
        <!-- text content  -->

        <div class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2> Transações Recentes</h2>
                    <a href="#" class="btn">Ver Todos</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Nome</td>
                            <td>Valor</td>
                            <td>Data</td>
                            <td>Tipo</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Rodrigo</td>
                            <td>$1200</td>
                            <td>22/01/22</td>
                            <td><span class="status delivered">Depósito</span></td>
                        </tr>

                        <tr>
                            <td>CAixa de ferramenta</td>
                            <td>$1200</td>
                            <td>22/01/22</td>
                            <td><span class="status pending">Débito no Cartão</span></td>
                        </tr>
                        <tr>
                            <td>Pratos</td>
                            <td>$25</td>
                            <td>Due</td>
                            <td><span class="status inprogress">In Progress</span></td>
                        </tr>
                        <tr>
                            <td>Pratos</td>
                            <td>$25</td>
                            <td>Due</td>
                            <td><span class="status delivered">In Progress</span></td>
                        </tr>
                        <tr>
                            <td>Pratos</td>
                            <td>$25</td>
                            <td>Due</td>
                            <td><span class="status return">Return</span></td>
                        </tr>
                        <tr>
                            <td>Pratos</td>
                            <td>$25</td>
                            <td>Due</td>
                            <td><span class="status pending">In Progress</span></td>
                        </tr>
                        <tr>
                            <td>Pratos</td>
                            <td>$25</td>
                            <td>Due</td>
                            <td><span class="status inprogress">In Progress</span></td>
                        </tr>
                        <tr>
                            <td>Pratos</td>
                            <td>$25</td>
                            <td>Due</td>
                            <td><span class="status pending">In Progress</span></td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- New Customers -->
            <div class="recentCustomers">
                <div class="cardHeader">
                    <h2> Contatos Recentes</h2>
                </div>
                <table>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="{{ URL::asset('img/img1.jpg') }}"></div>
                        </td>
                        <td>
                            <h4> David <br><span>Conta: XXXX</span> </h4>
                        </td>
                    </tr>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="{{ URL::asset('img/img2.jpg') }}"></div>
                        </td>
                        <td>
                            <h4> Rodrigo <br><span>Conta: XXXX</span> </h4>
                        </td>
                    </tr>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="{{ URL::asset('img/img3.jpg') }}"></div>
                        </td>
                        <td>
                            <h4> Olivia <br><span>Conta: XXXX</span> </h4>
                        </td>
                    </tr>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="{{ URL::asset('img/img4.jpg') }}"></div>
                        </td>
                        <td>
                            <h4> Amelia <br><span>Conta: XXXX</span> </h4>
                        </td>
                    </tr>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="{{ URL::asset('img/img5.jpg') }}"></div>
                        </td>
                        <td>
                            <h4> Amit <br><span>Conta: XXXX</span> </h4>
                        </td>
                    </tr>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="{{ URL::asset('img/img6.jpg') }}"></div>
                        </td>
                        <td>
                            <h4> Ashraf <br><span>Conta: XXXX</span> </h4>
                        </td>
                    </tr>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="{{ URL::asset('img/img7.jpg') }}"></div>
                        </td>
                        <td>
                            <h4> Diana <br><span>Conta: XXXX</span> </h4>
                        </td>
                    </tr>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="{{ URL::asset('img/img8.jpg') }}"></div>
                        </td>
                        <td>
                            <h4> Amit <br><span>Conta: XXXX</span> </h4>
                        </td>
                    </tr>
                </table>
            </div>


        </div>

    </div>

</div>
</div>
@endsection