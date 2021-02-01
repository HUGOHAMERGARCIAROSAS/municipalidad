@extends('layouts.login')
@section('content')
<div class="app-container">
    <div class="h-100">
        <div class="h-100 no-gutters row">
            <div class="d-none d-lg-block col-lg-4">
                <div class="slider-light">
                    <div class="slick-slider">
                        <div>
                            <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
                                <div class="slide-img-bg" style="background-image: url('admin/images/originals/city.jpg');"></div>
                                <div class="slider-content">
                                    <h3>ADMINISTRADOR</h3>
                                    <p>Sistema de la municipalidad de Victor Larco Herrera.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                                <div class="slide-img-bg" style="background-image: url('admin/images/originals/citynights.jpg');"></div>
                                <div class="slider-content">
                                    <h3>ADMINISTRADOR</h3>
                                    <p>Sistema de la municipalidad de Victor Larco Herrera.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning" tabindex="-1">
                                <div class="slide-img-bg" style="background-image: url('admin/images/originals/citydark.jpg');"></div>
                                <div class="slider-content">
                                    <h3>ADMINISTRADOR</h3>
                                    <p>Sistema de la municipalidad de Victor Larco Herrera.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                    <div>
                        <img src="{{asset('admin/images/Escudo_Victor_Larco_Herrera.png')}}" alt="" style="height: 120px; width:auto; padding-bottom:20px">
                    </div>
                    <h4 class="mb-0">
                        <span class="d-block">Bienvenido,</span>
                        <span>Por favor, ingrese sus datos:</span>
                    </h4>
                    <div class="divider row"></div>
                    <div>
                        <form action="{{ url('login') }}" method="post">
                            {{csrf_field()}}
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail" class="">Usuario</label>
                                        <input name="per_login" id="exampleEmail"
                                        placeholder="Ingrese su usuario aquí..."
                                        type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword" class="">Contraseña</label>
                                        <input name="password" id="examplePassword"
                                        placeholder="Ingrese su contraseña aquí.."
                                        type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="divider row"></div>
                            <div class="d-flex align-items-center">
                                <div class="ml-auto">
                                    <button class="btn btn-primary btn-lg" type="submit">Iniciar Sesión</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
