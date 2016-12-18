@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-warning">
                <div class="col-md-8"><h2>{{$agenda->title}} by {{$admin->alias}}</h2></div>
                <div class="panel-body">
                    <div class="pan" style="display: flex; justify-content: space-between;">
                        @if ($userRightsToAddTask)
                        <a href="{{ route('tasks.create', ['calendarId' => $calendarId]) }}"><button>create Task</button></a>
                        @endif
                        @if($userRightsToEditMember)
                                <a href="{{ route('tasks.create', ['calendarId' => $calendarId]) }}"><button>Edit Member</button></a>
                            @endif
                        @if ($userRightsToEditCal)
                        <a href="{{ route('calendar.edit' , ['calendarId' => $calendarId])}}"><button>edit Calendar</button></a>
                        @endif
                    </div>
                </div>
                <!-- Crée un div automatiquement qui contient le calendrier (Proviens de l'helper)-->
                {!! $calendar->calendar() !!}

            </div>
        </div>
        <div class="panel panel-info" style="display: flex; flex-direction: column; align-self:center;justify-self: center;">
            <div class="panel-heading">Members</div>
            <!-- List group -->
            <ul class="list-group">
                @foreach ($members as $user)
                    <li class="list-group-item">{{$user->alias}}</li>
                @endforeach
            </ul>
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
{!! $calendar->script() !!}
@endsection

@section('styles')
<link rel="stylesheet" href="http://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.css"/>
@endsection
