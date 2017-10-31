@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    {{-- dump($options) --}}
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('salutation') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Salutation</label>

                            <div class="col-md-6">
                                <select class="form-control" id="salutation" name="salutation" >
                                <option value="">Select ...</option>
                                @include('partials.form_select_options',['options_key'=>'salutations','input_name'=>'salutation'])
                                </select>

                                @if ($errors->has('salutation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('salutation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">First name</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" >

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Last name</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" >

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('honours') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Honours</label>

                            <div class="col-md-6">
                                <input id="honours" type="text" class="form-control" name="honours" value="{{ old('honours') }}" >

                                @if ($errors->has('honours'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('honours') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Address1</label>

                            <div class="col-md-6">
                                <input id="address1" type="text" class="form-control" name="address1" value="{{ old('address1') }}" >

                                @if ($errors->has('address1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Address2</label>

                            <div class="col-md-6">
                                <input id="address2" type="text" class="form-control" name="address2" value="{{ old('address2') }}" >

                                @if ($errors->has('address2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">City</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" >

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">State</label>

                            <div class="col-md-6">

                                <select  class="form-control" name="state" id="state">
                                <option value="">Select ...</option>
                                @include('partials.form_select_options',['options_key'=>'states','input_name'=>'state'])
                                </select>

                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('postcode') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Postcode</label>

                            <div class="col-md-6">
                                <input id="postcode" type="text" class="form-control" name="postcode" value="{{ old('postcode') }}" >

                                @if ($errors->has('postcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('postcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" >

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('vaps_affiliated') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Do you belong to a VAPS affiliated club?</label>

                            <div class="col-md-6">
                                <select  class="form-control" name="vaps_affiliated" id="vaps_affiliated">
                                    <option value="">Select ...</option>
                                    @include('partials.form_select_options',['options_key'=>'vapsclubs','input_name'=>'vaps_affiliated'])
                                </select>

                                @if ($errors->has('vaps_affiliated'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vaps_affiliated') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('aps_member') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Are you a member of APS?</label>

                            <div class="col-md-6">
                                <select class="form-control"  name="aps_member">
                                    <option value="">Select ...</option>
                                    @include('partials.form_select_options',['options_key'=>'yesno','input_name'=>'aps_member'])
                                </select>

                                @if ($errors->has('aps_member'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('aps_member') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('club_nomination') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nominate the name of your Club for the special award (One club only)</label>

                            <div class="col-md-6">
                                <select class="form-control" name="club_nomination" >
                                    <option value="">Select ...</option>
                                    @include('partials.form_select_options',['options_key'=>'vapsclubs','input_name'=>'club_nomination'])
                                </select>


                                @if ($errors->has('club_nomination'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('club_nomination') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
