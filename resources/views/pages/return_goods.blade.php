@extends('layouts.app')
@section('content')
    <div class="container" style="padding-top: 15%; padding-bottom: 5%;">
        <div class="row justify-content-center">
            <div class="col-9">
                <h2 class="font-weight-bold mb-3">Возврат</h2>
                <p>
                    Купленный товар возврату не подлежит.
                </p>
                <p>Возврат осуществляется только в том случае, если товар окажется бракованным.</p>
                <p>Обмен купленного товара возможен, в случае предоставления чека. В чеках указаны филиалы откуда Вам доставили книгу.</p>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-9">
                <h2>Контакты</h2>
            </div>
            <div class="col-9">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="tel:+996 501 433 433" class="nav-link">
                            <i class="fas fa-phone"></i>&nbsp;+996 501 433 433
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="mailto:erudit.shop@mail.ru" class="nav-link">
                            <i class="fas fa-envelope"></i>&nbsp;erudit.shop@mail.ru
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://api.whatsapp.com/send?phone=996551433433" class="nav-link text-capitalize">
                            <i class="fab fa-whatsapp"></i>&nbsp;whatsapp
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.instagram.com/erudit_kg/?hl=ru" class="nav-link text-capitalize">
                            <i class="fab fa-instagram"></i>&nbsp;instagram
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
