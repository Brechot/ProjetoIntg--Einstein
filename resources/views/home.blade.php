@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        Home
    </div>
</div>

<div class="main-content" id="maincard">
    <div class="row flex-wrap" id="maincard">
        <!-- CARD 1 -->
        <div class="col-auto card-wrapper">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">RESERVA 11/04 - 16/04</h4>
                    <div class="linha-abaixo" style="border-top: 2px solid white"></div>
                    <div class="d-flex justify-content-between align-items-center" style="margin: 20px;">
                        <div>
                            <div class="text-center"> <h4 class="card-title" style="font-size: xx-large;">LAB 1 - 19:00</h4></div>
                        </div>

                        <div class="ms-auto d-flex flex-column justify-content-center" id="remov-edit">
                            <button type="button" class="btn btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                                <span>REMOVER</span>
                            </button>
                            <br>
                            <button type="button" class="btn btn-outline-primary">
                                <i class="fa-solid fa-square-plus"></i>
                                <span>EDITAR</span>
                            </button>
                        </div>
                    </div>
                    <div id="card-visu">
                        <a href="#" class="btn btn-light">
                            <i class="fa-solid fa-eye"></i>
                            <span>VISUALIZAR</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD 2 -->
        <div class="col-auto card-wrapper">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">RESERVA 11/04 - 14/04</h4>
                    <div class="linha-abaixo" style="border-top: 2px solid white"></div>
                    <div class="d-flex justify-content-between align-items-center" style="margin: 20px;">
                        <div>
                            <div class="text-center"> <h4 class="card-title">LAB 2 - 19:00</h4></div>
                        </div>

                        <div class="ms-auto d-flex flex-column justify-content-center" id="remov-edit">
                            <button type="button" class="btn btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                                <span>REMOVER</span>
                            </button>
                            <br>
                            <button type="button" class="btn btn-outline-primary">
                                <i class="fa-solid fa-square-plus"></i>
                                <span>EDITAR</span>
                            </button>
                        </div>
                    </div>
                    <div id="card-visu">
                        <a href="#" class="btn btn-light">
                            <i class="fa-solid fa-eye"></i>
                            <span>VISUALIZAR</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD 3 -->
        <div class="col-auto card-wrapper">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">RESERVA 14/04 - 18/04</h4>
                    <div class="linha-abaixo" style="border-top: 2px solid white"></div>
                    <div class="d-flex justify-content-between align-items-center" style="margin: 20px;">
                        <div>
                            <div class="text-center"> <h4 class="card-title">LAB 3 - 19:00</h4></div>
                        </div>

                        <div class="ms-auto d-flex flex-column justify-content-center" id="remov-edit">
                            <button type="button" class="btn btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                                <span>REMOVER</span>
                            </button>
                            <br>
                            <button type="button" class="btn btn-outline-primary">
                                <i class="fa-solid fa-square-plus"></i>
                                <span>EDITAR</span>
                            </button>
                        </div>
                    </div>
                    <div id="card-visu">
                        <a href="#" class="btn btn-light">
                            <i class="fa-solid fa-eye"></i>
                            <span>VISUALIZAR</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD 4 -->
        <div class="col-auto card-wrapper">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">RESERVA 11/04 - 16/04</h4>
                    <div class="linha-abaixo" style="border-top: 2px solid white"></div>
                    <div class="d-flex justify-content-between align-items-center" style="margin: 20px;">
                        <div>
                            <div class="text-center"> <h4 class="card-title" style="font-size: xx-large;">LAB 1 - 19:00</h4></div>
                        </div>

                        <div class="ms-auto d-flex flex-column justify-content-center" id="remov-edit">
                            <button type="button" class="btn btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                                <span>REMOVER</span>
                            </button>
                            <br>
                            <button type="button" class="btn btn-outline-primary">
                                <i class="fa-solid fa-square-plus"></i>
                                <span>EDITAR</span>
                            </button>
                        </div>
                    </div>
                    <div id="card-visu">
                        <a href="#" class="btn btn-light">
                            <i class="fa-solid fa-eye"></i>
                            <span>VISUALIZAR</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD 5 -->
        <div class="col-auto card-wrapper">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">RESERVA 11/04 - 14/04</h4>
                    <div class="linha-abaixo" style="border-top: 2px solid white"></div>
                    <div class="d-flex justify-content-between align-items-center" style="margin: 20px;">
                        <div>
                            <div class="text-center"> <h4 class="card-title">LAB 2 - 19:00</h4></div>
                        </div>

                        <div class="ms-auto d-flex flex-column justify-content-center" id="remov-edit">
                            <button type="button" class="btn btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                                <span>REMOVER</span>
                            </button>
                            <br>
                            <button type="button" class="btn btn-outline-primary">
                                <i class="fa-solid fa-square-plus"></i>
                                <span>EDITAR</span>
                            </button>
                        </div>
                    </div>
                    <div id="card-visu">
                        <a href="#" class="btn btn-light">
                            <i class="fa-solid fa-eye"></i>
                            <span>VISUALIZAR</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD 6 -->
        <div class="col-auto card-wrapper">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">RESERVA 14/04 - 18/04</h4>
                    <div class="linha-abaixo" style="border-top: 2px solid white"></div>
                    <div class="d-flex justify-content-between align-items-center" style="margin: 20px;">
                        <div>
                            <div class="text-center"> <h4 class="card-title">LAB 3 - 19:00</h4></div>
                        </div>

                        <div class="ms-auto d-flex flex-column justify-content-center" id="remov-edit">
                            <button type="button" class="btn btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                                <span>REMOVER</span>
                            </button>
                            <br>
                            <button type="button" class="btn btn-outline-primary">
                                <i class="fa-solid fa-square-plus"></i>
                                <span>EDITAR</span>
                            </button>
                        </div>
                    </div>
                    <div id="card-visu">
                        <a href="#" class="btn btn-light">
                            <i class="fa-solid fa-eye"></i>
                            <span>VISUALIZAR</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
