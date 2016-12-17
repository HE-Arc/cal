@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($mode!=1)
                            Create new Task
                        @elseif($mode==1)
                            Edit the Task
                        @endif
                    </div>
                    <div class="panel-body">

                        @if($mode!=1)
                            {{ Form::open(array('route' => array('tasks.store','calendarId' => $calendarId), 'method' => 'post', 'class' =>"form-horizontal")) }}
                        @elseif($mode==1)
                            {{ Form::open(array('route' => array('tasks.update', 'calendarId' => $calendarId, 'id' =>$task->id), 'method' => 'patch','class' =>"form-horizontal")) }}
                        @endif
                        {{ csrf_field() }}
                        <!-- Title -->
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title"
                                           value="@if($mode==1){{ $task->title }}@endif" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Time Start -->
                            <div class="form-group{{ $errors->has('time_start') || $errors->has('date_start') ? ' has-error' : '' }}">
                                <label for="time_start" class="col-md-4 control-label">Start time</label>

                                <div class="col-md-6 ">
                                    <input type="date" name="date_start"
                                    value="@if($mode==1){{date_format($dateTimeStart,'Y-m-d')}}@else{{ date('Y-m-d') }}@endif">
                                    <input type="time" name="time_start"
                                    value="@if($mode==1){{date_format($dateTimeStart,'H:i')}}@else{{ date('H:i') }}@endif">
                                    @if ($errors->has('date_start'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('date_start') }}</strong>
                                    </span>
                                    @endif
                                    @if ($errors->has('time_start'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('time_start') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Time end -->
                            <div class="form-group{{ $errors->has('time_end') || $errors->has('date_end') ? ' has-error' : '' }}">
                                <label for="time_start" class="col-md-4 control-label">End time</label>

                                <div class="col-md-6 ">
                                    <input type="date" name="date_end" value="@if($mode==1){{date_format($dateTimeEnd,'Y-m-d')}}@else{{ date('Y-m-d') }}@endif">
                                    <input type="time" name="time_end" value="@if($mode==1){{date_format($dateTimeEnd,'H:i')}}@else{{ date('H:i', strtotime('+1 hour')) }}@endif">
                                    @if ($errors->has('date_end'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('date_end') }}</strong>
                                    </span>
                                    @endif
                                    @if ($errors->has('time_end'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('time_end') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- priority -->
                            <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                                <label for="priority" class="col-md-4 control-label">Priority</label>

                                <div class="col-md-6">
                                    <select id="priority" name="priority" required>
                                        <option value="3" @if($mode==1 && $task->priority == 3) selected @endif>High</option>
                                        <option value="2"  @if($mode==1 && $task->priority == 2) selected @else selected @endif>Medium</option>
                                        <option value="1" @if($mode==1 && $task->priority == 1) selected @endif>Low</option>
                                    </select>
                                    @if ($errors->has('priority'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control" name="description"
                                           value="@if($mode==1){{ $task->description}}@endif">

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                                <label for="location" class="col-md-4 control-label">Location</label>

                                <div class="col-md-6">
                                    <input id="location" type="text" class="form-control" name="location"
                                           value="@if($mode==1){{ $task->location}}@endif">

                                    @if ($errors->has('location'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- attachment_url -->
                            <div class="form-group{{ $errors->has('attachment_url') ? ' has-error' : '' }}">
                                <label for="attachment_url" class="col-md-4 control-label">Link</label>

                                <div class="col-md-6">
                                    <input id="attachment_url" type="text" class="form-control" name="attachment_url"
                                           value="@if($mode==1){{ $task->attachment_url}}@endif">

                                    @if ($errors->has('attachment_url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('attachment_url') }}</strong>
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
