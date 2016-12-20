@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>
                            Modify members of {{$agenda->title}}
                        </h1>
                    </div>
                    <div class="panel-body">
                        <label class="col-md-12 control-label">
                            Add to this calendar's users:
                        </label>
                        <form class="row form-horizontal" role="form" method="POST"
                              action="{{url('calendar/'.$agenda->id.'/members/')}}">
                            {{ csrf_field() }}

                            <div class="col-md-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-3 control-label">E-Mail Address Members</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="permission" class="col-md-1 col-xs-offset-1 control-label"> Permissions</label>
                                <div class="container-fluid">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="col-md-1 col-xs-2">
                                            <p>Add task</p>
                                            <input type="checkbox" name="add_task">
                                        </div>
                                        <div class="col-md-1 col-xs-2">
                                            <p>Edit task</p>
                                            <input type="checkbox" name="edit_task">
                                        </div>
                                        <div class="col-md-1 col-xs-2">
                                            <p>Delete task</p>
                                            <input type="checkbox" name="delete_task">
                                        </div>
                                        <div class="col-md-1 col-xs-2">
                                            <p>Edit members</p>
                                            <input type="checkbox" name="edit_member">
                                        </div>
                                        <div class="col-md-1 col-xs-2">
                                            <p>Edit calendar</p>
                                            <input type="checkbox" name="edit_calendar">
                                        </div>
                                        <div class="col-md-1 col-xs-2">
                                            <p>Delete calendar</p>
                                            <input type="checkbox" name="delete_calendar">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-offset-5 col-xs-offset-4">
                                    <input type="hidden" name="update" value="add">
                                    <button type="submit" class="btn btn-primary">
                                        Register Member
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="row form-group">
                            @foreach($users as $user)
                                <label class="col-md-12 col-md-offset-1 col-xs-12 col-xs-offset-0 control-label">Edit this calendar user : {{ $user->email }}
                                </label>
                                <div class="col-md-12 col-md-offset-1">
                                    <form class="form-horizontal" role="form" method="POST"
                                          action="{{url('calendar/'.$agenda->id.'/members/')}}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="email" value="{{$user->email}}"/>
                                        <div class="col-md-1 col-xs-2">
                                            <p>Add task</p>
                                            <input type="checkbox"
                                                   name="add_task" {{ $user->pivot->add_task? 'checked' : '' }}>
                                        </div>


                                        <div class="col-md-1 col-xs-2">
                                            <p>Edit task</p>
                                            <input type="checkbox"
                                                   name="edit_task" {{ $user->pivot->edit_task? 'checked' : '' }}>
                                        </div>

                                        <div class="col-md-1 col-xs-2">
                                            <p>Delete task</p>
                                            <input type="checkbox"
                                                   name="delete_task" {{ $user->pivot->delete_task? 'checked' : '' }}>
                                        </div>
                                        <div class="col-md-1 col-xs-2">
                                            <p>Edit members</p>
                                            <input type="checkbox"
                                                   name="edit_member" {{ $user->pivot->edit_member? 'checked' : '' }}>
                                        </div>

                                        <div class="col-md-1 col-xs-2">
                                            <p>Edit calendar</p>
                                            <input type="checkbox"
                                                   name="edit_calendar" {{ $user->pivot->edit_calendar? 'checked' : '' }}>
                                        </div>

                                        <div class="col-md-1 col-xs-2">
                                            <p>Delete calendar</p>
                                            <input type="checkbox"
                                                   name="delete_calendar" {{ $user->pivot->delete_calendar? 'checked' : '' }}>
                                        </div>
                                        <div class="col-md-1 col-xs-1">
                                            <button type="submit" class="btn btn-default">
                                                <input type="hidden" name="update" value="update"/>
                                                Save
                                            </button>
                                        </div>

                                    </form>
                                    <form class="col-xs-offset-9 form-horizontal" role="form" method="POST"
                                          action="{{url('calendar/'.$agenda->id.'/members/')}}">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger">
                                            <input type="hidden" name="email" value="{{$user->email}}"/>
                                            <input type="hidden" name="update" value="delete"/>
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
