<?php
$salautations = array(
    'Mr', 'Mrs', 'Ms', 'Miss', 'Dr',
);

$club_options = $db->select("vapclubs", ['name']);
usort($club_options, 'sort_clubs');

$yesNo_options = array('Yes', 'No');

$salutation_options = array(
    'Mr',
    'Mrs',
    'Ms',
    'Miss',
    'Dr',
);

$state_options = array(
    'ACT',
    'NSW',
    'NT',
    'QLD',
    'SA',
    'TAS',
    'VIC',
    'WA',
);

function formval($name = false)
{
    if ($name && isset($_SESSION[$name])) {
        return $_SESSION[$name];
    }
}

function yesno_options($name)
{
    global $yesNo_options;

    $html = '';

    foreach ($yesNo_options as $opt) {
        $selected = $opt == formval($name) ? ' selected="selected" ' : ' ';
        $html .= '<option ' . $selected . '>' . $opt . '</option>';
    }
    return $html;
}

function club_nomination_options()
{
    global $club_options;

    $html = '';

    foreach ($club_options as $club) {
        $selected = $club == formval('club_nomination') ? ' selected="selected" ' : ' ';
        $html .= '<option ' . $selected . '>' . $club['name'] . '</option>';
    }
    return $html;
}

function salutation_options()
{
    global $salutation_options;

    $html = '';

    foreach ($salutation_options as $opt) {
        $selected = $opt == formval('salutation') ? ' selected="selected" ' : ' ';
        $html .= '<option ' . $selected . '>' . $opt . '</option>';
    }
    return $html;
}

function state_options()
{
    global $state_options;

    $html = '';

    foreach ($state_options as $opt) {
        $selected = $opt == formval('state') ? ' selected="selected" ' : ' ';
        $html .= '<option ' . $selected . '>' . $opt . '</option>';
    }
    return $html;
}

?>
<h2>Entrant Registration Form</h2>

<form method="post" action="" id="registrationForm">
<div class="form-group">
    <div class="row">
        <div class="col-xs-3">
            <label for="salutation" class="control-label">Salutation</label>
            <select class="form-control" id="salutation" name="salutation" >
            <option value="">Select ...</option>
            <?php echo salutation_options() ?>
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
            <?php echo state_options() ?>
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
            <?php echo yesno_options('vaps_affiliated') ?>
            </select>
        </div>
        <div class="col-xs-6">
            <label class="control-label">Are you a member<br /> of APS?</label>
            <select class="form-control" name="aps_member" >
            <option>Select ...</option>
            <?php echo yesno_options('aps_member') ?>
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
            <?php echo club_nomination_options() ?>
            </select>
        </div>
    </div>
</div>

<div class="row">
        <div class="col-xs-9">
            <input type="checkbox"  id="confirm_terms" name="confirm_terms"> I confirm that I have read and agree to the <a href="<?php echo TERMS_AND_CONDITIONS_URL ?>" target="_blank">competition terms and conditions</a>
        </div>

        <div class="col-xs-3">
            <button type="submit" class="btn btn-primary" id="continue_btn" name="continue_btn" >Continue</button>
        </div>
</div>
</form>

<script src="js/jquery.js" ></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/formValidation.min.js" ></script>
<script src="js/framework/bootstrap.min.js"></script>
<script>

$(document).ready(function() {



    $('#registrationForm').formValidation({
        framework: 'bootstrap',
        iconX: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	salutation: {
            	row: '.col-xs-3',
                validators: {
                    notEmpty: {
                        message: 'Salutation is required'
                    }
                }
            },
            firstname: {
            	row: '.firstname',
                validators: {
                    notEmpty: {
                        message: 'The first name is required'
                    },
                    stringLength: {
                        min: 2,
                        max: 40,
                        message: 'The firstname must be more than 2 and less than 40 characters long'
                    }
                }
            },
            lastname: {
                row: '.lastname',
                validators: {
                    notEmpty: {
                        message: 'The last name is required'
                    },
                    stringLength: {
                        min: 2,
                        max: 40,
                        message: 'The last name must be more than 2 and less than 40 characters long'
                    }
                }
            },
            address: {
            	selector: '.address',
            	validators: {
            		callback: {
            			message: "at least one address field is required",

		            	callback: function(value, validator, $field){
		            		var isEmpty = true,
		            			$fields = validator.getFieldElements('address');
		            		for (var i = 0; i < $fields.length; i++){
		            			if ($fields.eq(i).val() !== '') {
		            				isEmpty = false;
		            				break;
		            			}
		            		}
		            		if (!isEmpty) {
		            			validator.updateStatus('address', validator.STATUS_VALID, 'callback');
		            			return true;

		            		}

		            		return false;
		            	}
		            }
            	}
            },
            city: {
            	row: '.col-xs-10',
                validators: {
                    notEmpty: {
                        message: 'City is required'
                    }
                }

            },
            postcode: {
            	row: '.col-xs-2',
                validators: {
                    notEmpty: {
                        message: 'postcode is required'
                    }
                }

            },
            phone: {
            	row: '.col-xs-6',
                validators: {
                    notEmpty: {
                        message: 'phone number is required'
                    }
                }

            },
            email: {
            	row: '.col-xs-6',
                validators: {
                    notEmpty: {
                        message: 'email is required'
                    },
                    emailAddress: {
                            message: 'The input is not a valid email address'
                    }
                }

            },
            confirm_terms: {
                row: '.col-xs-9',
                validators: {
                    notEmpty: {
                        message: 'Confirmation is required'
                    }
                }

            }
        }
    });
});
</script>