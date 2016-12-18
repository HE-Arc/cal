@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{url('calendar/'.$agenda->id.'/members/')}}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address Members</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="permission" class="col-md-4 control-label">Permissions</label>

                                <div class="col-md-6">
                                    <table name="permission">
                                        <tr>
                                            <td>Add task</td>
                                            <td>Edit task</td>
                                            <td>Delete task</td>
                                            <td>Edit members</td>
                                            <td>Edit calendar</td>
                                            <td>Delete calendar</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="add_task" ></td>
                                            <td><input type="checkbox" name="edit_task"></td>
                                            <td><input type="checkbox" name="delete_task"></td>
                                            <td><input type="checkbox" name="edit_member"></td>
                                            <td><input type="checkbox" name="edit_calendar"></td>
                                            <td><input type="checkbox" name="delete_calendar"></td>
                                            <td><button type="submit" class="btn">Save</button></td>
                                            <td><button type="submit" class="btn">Remove</button></td>

                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-6">
                                    <button type="submit" class="btn btn-primary">
                                        Register Member
                                    </button>
                                </div>
                            </div>
                        </form>
                        <table>
                            <tr>
                                <td>Email</td>
                                <td>Add task</td>
                                <td>Edit task</td>
                                <td>Delete task</td>
                                <td>Edit members</td>
                                <td>Edit calendar</td>
                                <td>Delete calendar</td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach($users as $user)

                                <form class="form-horizontal" role="form" method="POST" action="{{url('calendar/'.$agenda->id.'/members/')}}">
                                <tr>
                                    <input type="hidden" name="user_id" value="$user->id"/>
                                    <td>{{ $user->email }}</td>
                                    <td><input type="checkbox" name="add_task" {{ $user->pivot->add_task? 'checked' : '' }}></td>
                                    <td><input type="checkbox" name="edit_task" {{ $user->pivot->edit_task? 'checked' : '' }}></td>
                                    <td><input type="checkbox" name="delete_task" {{ $user->pivot->delete_task? 'checked' : '' }}></td>
                                    <td><input type="checkbox" name="edit_member" {{ $user->pivot->edit_member? 'checked' : '' }}></td>
                                    <td><input type="checkbox" name="edit_calendar" {{ $user->pivot->edit_calendar? 'checked' : '' }}></td>
                                    <td><input type="checkbox" name="delete_calendar" {{ $user->pivot->delete_calendar? 'checked' : '' }}></td>
                                    <td><button type="submit" class="btn">Save</button></td>
                                    <td><button type="submit" class="btn">Remove</button></td>

                                </tr>
                                </form>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
