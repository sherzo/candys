@extends('layouts.app')

@section('content')
    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Inicio</h1>
            </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-6">
                    <div class="panel panel-orange panel-widget">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-3 widget-left">
                              <svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>                            </div>
                            <div class="col-sm-9 col-lg-9 widget-right">
                                <div class="large">{{ $pagar }} bs</div>
                                <div class="text-muted">En gastos por pagar</div>
                            </div>
                        </div>
                    </div>
                </div>
        <a href="{{ url('admin/propietarios/morosos') }}">
          <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="panel panel-red panel-widget">
                    <div class="row no-padding">
                        <div class="col-sm-3 col-lg-3 widget-left">
                          <svg class="glyph stroked clock"><use xlink:href="#stroked-clock"/></svg>
                        </div>
                        <div class="col-sm-9 col-lg-9 widget-right">
                            <div class="large">{{ $morosos }}</div>
                            <div class="text-muted">Propietaios morosos</div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </a>

        <div class="row">

          <a href="{{ url('admin/consultas') }}">
            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="panel panel-teal panel-widget ">
                    <div class="row no-padding">
                        <div class="col-sm-3 col-lg-3 widget-left">
                            <svg class="glyph stroked lock"><use xlink:href="#stroked-lock"/></use></svg>

                        </div>
                        <div class="col-sm-9 col-lg-9 widget-right">
                            <div class="large">{{ $fondo->real }} bs</div>
                            <div class="text-muted">Fondo Disponible</div>
                        </div>
                    </div>
                </div>
            </div>
          </a>

            <a href="{{ url('admin/consultas') }}">
            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="panel panel-blue panel-widget ">
                    <div class="row no-padding">
                        <div class="col-sm-3 col-lg-3 widget-left">
                          <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"/></svg>
                        </div>
                        <div class="col-sm-9 col-lg-9 widget-right">
                            <div class="large">{{ $saldo->saldo }} bs</div>
                            <div class="text-muted">Saldo disponible</div>
                        </div>
                    </div>
                </div>
            </div>
          </a>
      </div>



@endsection
