@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($mode!=1)
                            Create your Agenda
                        @elseif($mode==1)
                            Edit the Agenda
                        @endif
                    </div>
                    <div class="panel-body">
                    @if($mode!=1)
                        {{ Form::open(array('route' => array('calendar.store'), 'method' => 'post', 'class' =>"form-horizontal")) }}
                    @elseif($mode==1)
                        {{ Form::open(array('route' => array('calendar.update', $agenda->id), 'method' => 'patch','class' =>"form-horizontal")) }}
                    @endif

                    {{ csrf_field() }}

                    <!-- Title -->
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-4 control-label">Title</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title"
                                   value="@if($mode==1){{ $agenda->title }} @endif" required autofocus>

                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Priority high color -->
                    <div class="form-group{{ $errors->has('priority_high_color') ? ' has-error' : '' }}">
                        <label for="priority_high_color" class="col-md-4 control-label">High priority color</label>

                        <div class="col-md-6">
                            <input type="color" name="priority_high_color" value="@if($mode==1){{ '#'.$agenda->priority_high_color}}@endif">

                            @if ($errors->has('priority_high_color'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('priority_high_color') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Priority medium color -->
                    <div class="form-group{{ $errors->has('priority_medium_color') ? ' has-error' : '' }}">
                        <label for="priority_medium_color" class="col-md-4 control-label">Medium priority color</label>
                        <div class="col-md-6">
                            <input type="color" name="priority_medium_color" value="@if($mode==1){{ '#'.$agenda->priority_medium_color}}@endif">

                            @if ($errors->has('priority_medium_color'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('priority_medium_color') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Priority low color -->
                    <div class="form-group{{ $errors->has('priority_low_color') ? ' has-error' : '' }}">
                        <label for="priority_low_color" class="col-md-4 control-label">Low priority color</label>
                        <div class="col-md-6">
                            <input type="color" name="priority_low_color" value="@if($mode==1){{ '#'.$agenda->priority_low_color}}@endif">
                            @if ($errors->has('priority_low_color'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('priority_low_color') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- Submit -->
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                @if($mode!=1)
                                    Create
                                @elseif($mode==1)
                                    Edit
                                @endif
                            </button>
                        </div>
                    </div>
                    {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
