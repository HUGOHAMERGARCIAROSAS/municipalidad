<div class="app-header header-shadow">
    <div class="app-header__logo">
        <div><img src="{{asset('admin/images/Escudo_Victor_Larco_Herrera.png')}}" alt="" width="25px" height="34px"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="app-header__content">
        <div class="app-header-left">
            <ul class="header-megamenu nav">
                @if(isset($pagina))
                    <h5 class="m-0" style="color: #3f6ad8">Municipalidad Distrital de Victor Larco - Módulo
                        de {{strtoupper( session('pagina'))}} <span class="fa fa-angle-right"></span> {{strtoupper($pagina)}}
                    </h5>
                @else
                    <h5 class="m-0" style="color: #3f6ad8">Municipalidad Distrital de Victor Larco - Módulo
                        de {{strtoupper( session('pagina'))}}</h5>
                @endif
        </div>
        <div class="app-header-right">
            <div class="header-dots">
                <div class="dropdown">
                    <a href="{{url('home')}}" title="Inicio" aria-haspopup="true">
                        <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                            <span class="icon-wrapper-bg bg-primary"></span>
                            <i class="icon text-primary pe-7s-home"></i>
                        </span>
                    </a>
                </div>
                <div class="dropdown">
                    <a type="button" title="Cambiar Contraseña" data-toggle="modal" data-target="{{"#modal-cambiarpass"}}"
                        class="p-0 mr-2 btn btn-link">
                        <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                            <span class="icon-wrapper-bg bg-danger"></span>
                            <i class="icon text-danger icon-anim-pulse pe-7s-key"></i>
                        </span>
                    </a>
                </div>
                <div class="dropdown">
                    <a href="{{url('logout')}}" title="Cerrar Sesión" class="p-0 btn btn-link dd-chart-btn">
                        <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                            <span class="icon-wrapper-bg bg-success"></span>
                            <i class="fa fa-sign-out-alt"></i>
                        </span>
                    </a>
                </div>
            </div>

            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <img width="42" class="rounded-circle" src="{{asset('admin/images/user1.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading"> {{session('nombre')}}</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="header-btn-lg">
                <button type="button" class="hamburger hamburger--elastic open-right-drawer">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div> --}}
        </div>
    </div>
</div>

