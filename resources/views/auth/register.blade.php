@extends('layouts.app')

@section('content')
<section id="register-form">
<div class="container">
    <div class="row">

<div class="col-md-12">
                    <form role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>


                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>


                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>


                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>


                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                        </div>


                        <div class="form-group">
                            <label for="role_selected" class="col-md-4 control-label">Register as </label>


                                <select name="role_selected" id="role_selected" class="form-control">
                                    <option value="buyer">Buyer</option>
                                    <option value="seller">Seller</option>
                                </select>

                        </div>

                        <div class="form-group">

                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>

                        </div>
                    </form>

    </div>
    </div>
</div>
</section>
@endsection
