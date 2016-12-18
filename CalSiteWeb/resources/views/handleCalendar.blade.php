@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($mode=='create')
                            Create your Agenda
                        @elseif($mode=='edit')
                            Edit the Agenda
                        @endif
                    </div>
                    <div class="panel-body">
                    @if($mode=='create')
                        {{ Form::open(['route' => ['calendar.store'], 'method' => 'post', 'class' =>"form-horizontal"])}}
                    @elseif($mode=='edit')
                        {{ Form::open(['route' => ['calendar.update', $agenda->id], 'method' => 'patch','class' =>"form-horizontal"]) }}
                    @endif

                    {{ csrf_field() }}

                    <!-- Title -->
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-4 control-label">Title</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title"
                                   value="@if($mode=='edit'){{ $agenda->title }} @endif" required autofocus>

                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label"><h3>Task Priority Colors</h3></label>
                    </div>
                    <!-- Task high priority color setting-->
                    <div class="form-group{{ $errors->has('priority_high_color') ? ' has-error' : '' }}">
                        <label for="priority_high_color" class="col-md-5 control-label">High priority</label>

                        <div class="col-md-6">
                            <input type="color" name="priority_high_color" value="@if($mode=='edit'){{ '#'.$agenda->priority_high_color}}@elseif($mode=='create'){{'#ff0000'}}@endif">

                            @if ($errors->has('priority_high_color'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('priority_high_color') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Task medium priority color setting -->
                    <div class="form-group{{ $errors->has('priority_medium_color') ? ' has-error' : '' }}">
                        <label for="priority_medium_color" class="col-md-5 control-label">Medium priority</label>
                        <div class="col-md-6">
                            <input type="color" name="priority_medium_color" value="@if($mode=='edit'){{ '#'.$agenda->priority_medium_color}}@elseif($mode=='create'){{'#ff5500'}}@endif">

                            @if ($errors->has('priority_medium_color'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('priority_medium_color') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Task low priority color setting -->
                    <div class="form-group{{ $errors->has('priority_low_color') ? ' has-error' : '' }}">
                        <label for="priority_low_color" class="col-md-5 control-label">Low priority</label>
                        <div class="col-md-6">
                            <input type="color" name="priority_low_color" value="@if($mode=='edit'){{ '#'.$agenda->priority_low_color}}@elseif($mode=='create'){{'#00ff00'}}@endif">
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
                                @if($mode=='create')
                                    Create
                                @elseif($mode=='edit')
                                    Edit
                                @endif
                            </button>
                            @if($mode == 'edit')
                                {{ Form::close() }}
                                {{  Form::open(['route' => ['calendar.destroy', $agenda->id], 'method' => 'delete', 'style' =>"display:inline-block"]) }}
                                <button type="submit" class="btn btn-primary"> Delete </button>
                            @endif
                        </div>
                    </div>
                    {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
