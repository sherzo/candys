<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Condominio - Candys II</title>

<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/datepicker3.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
<link href="{{ asset('assets/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/bootstrap-table.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
<style>
.ui-datepicker-calendar {
    display: none;
    }
</style>
<!--Icons-->
<script src="{{ asset('assets/js/lumino.glyphs.js') }}"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body id="app-layout">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><span>Condominio</span> Candys II</a>
                <ul class="user-menu">
                @if(!Auth::guest())
                    <li class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked female user"><use xlink:href="#stroked-female-user"/></svg>
                        {{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Perfil</a></li>
                            <li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Configuraciones</a></li>
                            <li><a href="{{ url('logout')}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Salir</a></li>
                        </ul>
                    </li>
                @endif
                </ul>
            </div>

        </div><!-- /.container-fluid -->
    </nav>
@if(!Auth::guest())
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <ul class="nav menu">
            <li class="active">
                <a href="{{ url('/admin') }}">
                    <span class="glyphicon glyphicon-home"></span>Inicio
                </a>
            </li>
            <li>
                <a href="{{ url('admin/propietarios') }}"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>Propietarios
                </a>
            </li>
            <li>
                <a href="{{ url('admin/gastos') }}"><span class="glyphicon glyphicon-usd"></span>Gastos</a>
            </li>
            <li><a href="{{ url('admin/recibos')}}"><span class="glyphicon glyphicon-list-alt"></span>Recibos</a></li>
            <li><a href="{{ url('admin/consultas') }}"><span class="glyphicon glyphicon-search"></span>Consultas</a></li>
        </ul>
    </div><!--/.sidebar-->
@endif

@if(!Auth::guest())
    <div class="col-sm-9 col-sm-offset-3
    col-lg-10 col-lg-offset-2 main">
@endif

    @yield('content')

@if(!Auth::guest())
    </div>
@endif

    <!-- JavaScripts -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/chosen/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-table.js') }}"></script>
    <script src="{{ asset('assets/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
    <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

    $('div.alert').not('.alert-important').delay(4100).fadeOut(350);
    </script>

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}


@yield('js')
</body>
</html>
