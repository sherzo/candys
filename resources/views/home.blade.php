@extends('layouts.app')

@section('content')
    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Inicio</h1>
            </div>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-teal panel-widget">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">
                                <svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large">44</div>
                                <div class="text-muted">Propietarios</div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="panel panel-red panel-widget">
                    <div class="row no-padding">
                        <div class="col-sm-3 col-lg-5 widget-left">
                        <svg class="glyph stroked hourglass"><use xlink:href="#stroked-hourglass"/></svg>
                        </div>
                        <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large">15</div>
                            <div class="text-muted">Atrasados</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="panel panel-blue panel-widget ">
                    <div class="row no-padding">
                        <div class="col-sm-3 col-lg-5 widget-left">
                            <svg class="glyph stroked lock"><use xlink:href="#stroked-lock"/></use></svg>

                        </div>
                        <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large">120</div>
                            <div class="text-muted">New Orders</div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    

@endsection
