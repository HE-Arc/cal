@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-warning">
                <div class="panel-body">
                    <div class="pan"> voici votre calendrier </div>
                </div>
                <!-- Crée un div automatiquement qui contient le calendrier (Proviens de l'helper)-->
                {!! $calendar->calendar() !!}
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
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
<script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>
{!! $calendar->script() !!}
@endsection

@section('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endsection
