@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">Your's agendas</div>

                <div class="panel-body">
                    <div class="pan"> c'est ici que vous trouverez les différents agendas. </div>
                </div>
                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{ url('/calendar') }}">Calendrier 1</a></li>
                    <li class="list-group-item">calendar 2</li>
                    <li class="list-group-item">calendar 3</li>
                    <li class="list-group-item">calendar 4</li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-warning">
                <div class="panel-heading">Feeds</div>

                <div class="panel-body">
                    <div class="pan"> rendez-vous a venir : </div>
                </div>
                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item">rdv 1</li>
                    <li class="list-group-item">rdv 2</li>
                    <li class="list-group-item">rdv 3</li>
                    <li class="list-group-item">rdv 4</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
