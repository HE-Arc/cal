@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">Yours agendas</div>
                <!-- List group -->
                <ul class="list-group">
                    @foreach ($listAgendas as $key => $agenda)
                        {{ Form::open(array('route' => array('calendar.destroy', $key), 'method' => 'delete')) }}
                        <li class="list-group-item"><a href="{{ route('calendar.show', ['calendarId' => $key]) }}">{{ $agenda }} </a>

                            {{ Form::button('<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>',
                            array('type' => 'submit','class' => 'btn btn-default'))}}
                            {{ Form::close()}}
                        </li>
                    @endforeach
                    <li class="list-group-item"><a href="{{ route('calendar.create') }}">New agenda</a></li>
                </ul>
            </div>

        </div>
        <div class="col-md-8">
            <div class="panel panel-warning">
                <div class="panel-heading">Feeds</div>

                <div class="panel-body">
                    {!! $calendar->calendar() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous">
</script>
<script src='http://fullcalendar.io/js/fullcalendar-3.1.0/lib/moment.min.js'></script>
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src='http://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.js'></script>
{!! !empty($calendar) ? $calendar->script() : '' !!}
@endsection

@section('styles')
<link rel="stylesheet" href="http://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.css"/>
@endsection
