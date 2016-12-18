@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <label class="col-md-12 control-label">
                            Add to this calendar's users:
                        </label>
                        <form class="row form-horizontal" role="form" method="POST" action="{{url('calendar/'.$agenda->id.'/members/')}}">
                            {{ csrf_field() }}

                            <div class="col-md-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-3 control-label">E-Mail Address Members</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="permission" class="col-md-3 control-label">Permissions</label>

                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <p>Add task</p>
                                            <input type="checkbox" name="add_task">
                                        </div>
                                        <div class="col-md-1">
                                            <p>Edit task</p>
                                            <input type="checkbox" name="edit_task">
                                        </div>
                                        <div class="col-md-1">
                                            <p>Delete task</p>
                                            <input type="checkbox" name="delete_task">
                                        </div>
                                        <div class="col-md-1">
                                            <p>Edit members</p>
                                            <input type="checkbox" name="edit_member">
                                        </div>
                                        <div class="col-md-1">
                                            <p>Edit calendar</p>
                                            <input type="checkbox" name="edit_calendar">
                                        </div>
                                        <div class="col-md-1">
                                            <p>Delete calendar</p>
                                            <input type="checkbox" name="delete_calendar">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-offset-5">
                                    <button type="submit" value="add" class="btn btn-primary">
                                        Register Member
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="row form-group">
                            <label class="col-md-12 control-label">
                                Edit this calendar's users:
                            </label>
                            <div class="col-md-12 col-md-offset-1">
                                <label class="col-md-2 control-label">Email</label>
                                <label class="col-md-1 control-label">Add task</label>
                                <label class="col-md-1 control-label">Edit task</label>
                                <label class="col-md-1 control-label">Delete task</label>
                                <label class="col-md-1 control-label">Edit members</label>
                                <label class="col-md-1 control-label">Edit calendar</label>
                                <label class="col-md-1 control-label">Delete calendar</label>
                            </div>
                            @foreach($users as $user)
                                <div class="col-md-12 col-md-offset-1">
                                    <form class="form-horizontal" role="form" method="POST" action="{{url('calendar/'.$agenda->id.'/members/')}}">
                                    <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                        <div class="col-md-2">{{ $user->email }}</div>
                                        <div class="col-md-1"><input type="checkbox" name="add_task" {{ $user->pivot->add_task? 'checked' : '' }}></div>
                                        <div class="col-md-1"><input type="checkbox" name="edit_task" {{ $user->pivot->edit_task? 'checked' : '' }}></div>
                                        <div class="col-md-1"><input type="checkbox" name="delete_task" {{ $user->pivot->delete_task? 'checked' : '' }}></div>
                                        <div class="col-md-1"><input type="checkbox" name="edit_member" {{ $user->pivot->edit_member? 'checked' : '' }}></div>
                                        <div class="col-md-1"><input type="checkbox" name="edit_calendar" {{ $user->pivot->edit_calendar? 'checked' : '' }}></div>
                                        <div class="col-md-1"><input type="checkbox" name="delete_calendar" {{ $user->pivot->delete_calendar? 'checked' : '' }}></div>
                                        <div class="col-md-1"><button type="submit" class="btn btn-default">Save</button></div>
                                        <div class="col-md-1"><button type="submit" class="btn btn-danger">Remove</button></div>
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
