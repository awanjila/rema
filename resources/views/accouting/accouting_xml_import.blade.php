@extends('layouts.app')

@section('title')
    Accounting :: @parent
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Stormware Pohoda XML Import
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'xmlImport', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::file('xml') !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Import', array('class' => 'btn btn-primary')) !!}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop