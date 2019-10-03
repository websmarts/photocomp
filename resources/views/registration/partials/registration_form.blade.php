

 {{-- dump($options) --}}
 {{-- dump($application) --}}
 {{-- dump($errors) --}}
 {{-- dump( old('country')) --}}


<form method="post" action="{{route('process_application_form')}}" id="registrationForm">
    {{ csrf_field() }}
<div class="form-group">
    <div class="row">
        <div class="col-xs-3">
            <label for="salutation" class="control-label">Salutation</label>
            <select class="form-control" id="salutation" name="salutation" placeholder="Select ...">
            <option value="">Select ...</option>
            @include('registration.partials.form_select_options',['options_key'=>'salutations','input_name'=>'salutation'])
            </select>
            @if ($errors->has('salutation'))
                <span class="help-block">
                    <strong>{{ $errors->first('salutation') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-xs-4 firstname">
            <label for="name" class="control-label">First name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname',$application->firstname) }}" />
            @if ($errors->has('firstname'))
                <span class="help-block">
                    <strong>{{ $errors->first('firstname') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-xs-5 lastname">
            <label for="name" class="control-label">Last name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname',$application->lastname) }}" />
            @if ($errors->has('lastname'))
                <span class="help-block">
                    <strong>{{ $errors->first('lastname') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-xs-12">
            <label for="honours" class="control-label">Honours</label>
            <input type="text" class="form-control" id="honours" name="honours" value="{{ old('honours',$application->honours) }}"/>
            @if ($errors->has('honours'))
                <span class="help-block">
                    <strong>{{ $errors->first('honours') }}</strong>
                </span>
            @endif
        </div>
    </div>
 </div>

<div class="form-group">
    <div class="row">
        <div class="col-xs-12">
            <label class="control-label">Address 1</label>
            <input type="text" class="form-control address" name="address1" value="{{ old('address1',$application->address1) }}"/>
            @if ($errors->has('address1'))
                <span class="help-block">
                    <strong>{{ $errors->first('address1') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <label class="control-label">Address 2</label>
            <input type="text" class="form-control address" name="address2" value="{{ old('address2',$application->address2) }}"/>
            @if ($errors->has('address2'))
                <span class="help-block">
                    <strong>{{ $errors->first('address2') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-xs-7">
            <label class="control-label">City</label>
            <input type="text" class="form-control" name="city" value="{{ old('city',$application->city) }}"/>
            @if ($errors->has('city'))
                <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-xs-3">
            <label class="control-label">State</label>
            <select class="form-control" name="state" >
            <option value="">Select ...</option>
            @include('registration.partials.form_select_options',['options_key'=>'states','input_name'=>'state'])
            </select>
            @if ($errors->has('state'))
                <span class="help-block">
                    <strong>{{ $errors->first('state') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-xs-2">
            <label class="control-label">Postcode</label>
            <input type="text" class="form-control" name="postcode" value="{{ old('postcode',$application->postcode) }}"/>
            @if ($errors->has('postcode'))
                <span class="help-block">
                    <strong>{{ $errors->first('postcode') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-xs-6">
        <label class="control-label">Country</label>
            <select class="form-control" name="country" >

            
            @foreach($options['countries'] as $v)
            <option {{ old('country',$application->country) == $v ? 'selected' : '' }} value="{{$v}}">{{ $v }}</option>
            @endforeach
            </select>
            @if ($errors->has('country'))
                <span class="help-block">
                    <strong>{{ $errors->first('country') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-xs-6">
            <!-- used to be Email but now user is logged in we know that! -->
        </div>
    </div>
</div>



<div class="form-group">
    <div class="row">
        <div class="col-xs-6">
            <label class="control-label">Phone</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone', $application->phone) }}" />
            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-xs-6">
            <!-- used to be Email but now user is logged in we know that! -->
        </div>
    </div>
</div>

<div class="form-group">
	<div class="row">

        
        

        <div class="col-xs-6">
            <label class="control-label">Are you a member of APS?</label>
            <select class="form-control" name="aps_member" >
            <option value="">Select ...</option>
            @include('registration.partials.form_select_options',['options_key'=>'yesno','input_name'=>'aps_member'])
            </select>
            @if ($errors->has('aps_member'))
                <span class="help-block">
                    <strong>{{ $errors->first('aps_member') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-xs-6">
            <label class="control-label">APS Membership number</label>
            <input type="text" class="form-control" name="aps_membership_number" value="{{ old('aps_membership_number', $application->aps_membership_number) }}" />
            @if ($errors->has('aps_membership_number'))
                <span class="help-block">
                    <strong>{{ $errors->first('aps_membership_number') }}</strong>
                </span>
            @endif
        </div>

	</div>
</div>

<div class="form-group">
	<div class="row">
		<div class="col-xs-6">
            <label class="control-label">Do you belong to a VAPS affiliated club?</label>
            <select class="form-control" name="vaps_affiliated" >
            <option  value="">Select ...</option>
            @include('registration.partials.form_select_options',['options_key'=>'yesno','input_name'=>'vaps_affiliated'])
            </select>
            @if ($errors->has('vaps_affiliated'))
                <span class="help-block">
                    <strong>{{ $errors->first('vaps_affiliated') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-xs-6">
            <label class="control-label">Name of (non-Victorian) club if interstate</label>
            <input type="text" class="form-control" name="club_name" value="{{ old('club_name', $application->club_name) }}" />
            @if ($errors->has('club_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('club_name') }}</strong>
                </span>
            @endif
        </div>
        

	</div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-xs-12">
            <label class="control-label">Nominate the name of your Club for the special award (One club only)</label>
            <select  class="form-control" name="club_nomination" >
            <option  value="">Select club</option>
            @include('registration.partials.form_select_options',['options_key'=>'vapsclubs','input_name'=>'club_nomination'])
            </select>

            @if ($errors->has('club_nomination'))
                <span class="help-block">
                    <strong>{{ $errors->first('club_nomination') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-xs-6">
            <label class="control-label">Where did you hear about the Competition?</label>
            <select  class="form-control" name="where_hear" >
            <option  value="">Select option</option>
            @include('registration.partials.form_select_options',['options_key'=>'wherehear','input_name'=>'where_hear'])
            </select>
           
        </div>

        <div class="col-xs-6">
        <label class="control-label" style="font-weight: normal">If OTHER please specify</label>
            <input type="text" class="form-control" name="where_hear_other" value="{{ old('where_hear_other', $application->where_hear) }}" />
            @if ($errors->has('where_hear'))
                <span class="help-block">
                    <strong>{{ $errors->first('where_hear') }}</strong>
                </span>
            @endif

        </div>
    </div>
</div>

<div class="row">
        <div class="col-xs-9">

            <input type="checkbox"  id="confirm_terms" name="confirm_terms" value="checked" {{ old('confirm_terms',$application->confirm_terms) }} >



             I confirm that I have read and agree to the <a href="{{ $settings->terms_and_conditions_url }}" target="_blank">competition terms and conditions</a>
             @if ($errors->has('confirm_terms'))
                <span class="help-block">
                    <strong>{{ $errors->first('confirm_terms') }}</strong>
                </span>
            @endif

        </div>

        <div class="col-xs-3">
            <button type="submit" class="btn btn-primary" id="continue_btn" name="continue_btn" >Continue</button>
        </div>
</div>
</form>
