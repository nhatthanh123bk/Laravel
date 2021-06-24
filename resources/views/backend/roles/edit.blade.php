@extends('master')
@section('title', 'Edit roles')
@section('content')
<div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            <form action = "{!!action('Admin\RolesController@update')!!}" class="form-horizontal" method="post">

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                <fieldset>
                    <legend>Edit role</legend>
                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Name</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                   value="{{ $user->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-lg-2 control-label">Email</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="email" placeholder="email" name="email"
                                   value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="col-lg-10">
                            <select class="form-control" id="role" name="role[]" multiple>
                                @foreach($roles as $role)
                                    <option value="{!! $role->name !!}"  @if(in_array($role->name, $selectedRoles))
                                    selected="selected" @endif >{!! $role->name !!}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Password</label>

                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Confirm password</label>

                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection