
<h2>Entrant Registration Form</h2>

<form method="post" action="" id="registrationForm">
<div class="form-group">
    <div class="row">
        <div class="col-xs-3">
            <label for="salutation" class="control-label">Salutation</label>
            <select class="form-control" id="salutation" name="salutation" >
            <option value="">Select ...</option>

            </select>
        </div>
        <div class="col-xs-4 firstname">
            <label for="name" class="control-label">First name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" />
        </div>
        <div class="col-xs-5 lastname">
            <label for="name" class="control-label">Last name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" />
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-xs-12">
            <label for="honours" class="control-label">Honours</label>
            <input type="text" class="form-control" id="honours" name="honours" />
        </div>
    </div>
 </div>

<div class="form-group">
    <div class="row">
        <div class="col-xs-12">
            <label class="control-label">Address 1</label>
            <input type="text" class="form-control address" name="address1" />
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <label class="control-label">Address 2</label>
            <input type="text" class="form-control address" name="address2" />
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-xs-7">
            <label class="control-label">City</label>
            <input type="text" class="form-control" name="city" />
        </div>
        <div class="col-xs-3">
            <label class="control-label">State</label>
            <select class="form-control" name="state" >
            <option>Select ...</option>
            </select>
        </div>
        <div class="col-xs-2">
            <label class="control-label">Postcode</label>
            <input type="text" class="form-control" name="postcode" />
        </div>
    </div>
</div>



<div class="form-group">
    <div class="row">
        <div class="col-xs-6">
            <label class="control-label">Phone</label>
            <input type="text" class="form-control" name="phone" />
        </div>
        <div class="col-xs-6">
            <label class="control-label">Email</label>
            <input type="text" class="form-control" name="email" />
        </div>
    </div>
</div>

<div class="form-group">
	<div class="row">
		<div class="col-xs-6">
            <label class="control-label">Do you belong to a VAPS affiliated club?</label>
            <select class="form-control" name="vaps_affiliated" >
            <option>Select ...</option>

            </select>
        </div>
        <div class="col-xs-6">
            <label class="control-label">Are you a member<br /> of APS?</label>
            <select class="form-control" name="aps_member" >
            <option>Select ...</option>

            </select>
        </div>

	</div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-xs-12">
            <label class="control-label">Nominate the name of your Club for the special award (One club only)</label>
            <select  class="form-control" name="club_nomination" >
            <option value=''>Select club</option>

            </select>
        </div>
    </div>
</div>

<div class="row">
        <div class="col-xs-9">
            <input type="checkbox"  id="confirm_terms" name="confirm_terms"> I confirm that I have read and agree to the <a href=" TERMS_AND_CONDITIONS_URL" target="_blank">competition terms and conditions</a>
        </div>

        <div class="col-xs-3">
            <button type="submit" class="btn btn-primary" id="continue_btn" name="continue_btn" >Continue</button>
        </div>
</div>
</form>
