var ss = require('simple-ajax-uploader');

function escapeTags(str) {
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;');
}

window.onload = function () {

  // GLOBAL STATE VARS
  window.$entries; // list of entries
  window.$user; // User data
  window.$entryCount = 0;
  var $entriesCost = 0;
  var $returnPostageCost = 0;
  var $catalogFee = 0;
  var $sectionCost = 0;
  var $categoryCounters = [];
  var $categoryCounterIndex = [];

  var $uploaderExtError = false;
  var $sectionCounter = []; // holds section entry couters.
  var $sectionCount; // number of sections entered
  // Added in 2020
  var $digitalSectionCount = 0;
  var $printSectionCount = 0;

  // TODO replace $maxSectionEntries with setting max_entries_per_section
  var $maxSectionEntries = 4; // max entries accepted per section
  var ajaxActive = false;

  // Element selectors
  var selectFileBtn = document.getElementById('select_file_btn'),
    uploadEntryBtn = document.getElementById('upload_entry_btn'),

    progressBar = document.getElementById('progressBar'),
    progressOuter = document.getElementById('progressOuter'),
    msgBox = document.getElementById('msgBox'),
    photoTitle = document.getElementById('photoTitle'),
    photoCategory_Section = document.getElementById('category_section'),
    loadingDiv = document.getElementById('loadingDiv');

  var $btnText = selectFileBtn.innerHTML; // initial text in the btn, gets restored after upload

  var jpegRegex = /\.jpe?g$/i;
  var returnPostageRegex = /Return by Post/i;
  var $returnInstructions = '';



  $('#closeMessageButton').on('click', function () {
    hideMessage('close message button click');
  });





  $('#return_instructions').on('change', function () {
    // unless option == Return by Post - force return_postage to zero and disable 
    // return_postage input field

    $returnInstructions = $('#return_instructions').val();
    checkReturnPostage();

  });

  var checkReturnPostage = function () {

    if (!returnPostageRegex.test($returnInstructions)) {
      $('#return_postage').prop('disabled', true)
      $('#return_postage').val(0);
      $returnPostageCost = 0
    } else {
      $('#return_postage').prop('disabled', false);
    }

    updateTotalCost();

  };

  $('#photoTitle').on('keyup', function (e) {
    //console.log('title changed - validate silently with title_check')
    validateInputs(false, 'title_check');

  });

  // category selector change event handler
  $('#category_section').on('change', function (e) {
    validateInputs(false, 'section_check'); // 
  });

  var validateInputs = function (silent = false, report_on = '') {
    // console.log('validateInput',silent,report_on);
    hideMessage('validate inputs');
    var valid = true;
    var msgParts = [];

    report_on = 'all';



    if (photoTitle.value.length < 3) {
      if (report_on == 'all' || report_on == 'title_check') {
        msgParts.push("Enter a title (must be more than 2 characters long) "); // invalid title
      }
      valid = false;
    }

    var cs = getSectionId();
    // console.log('Section', cs);
    // console.log('$sectionCounter[cs]', $sectionCounter[cs]);
    if (typeof cs == 'undefined' || cs < 1) {
      if (report_on == 'all' || report_on == 'section_check') {
        msgParts.push("Select an Section"); // invalid section
      }
      valid = false;
    }

    if ($sectionCounter[cs] >= $maxSectionEntries) {
      // console.log('MaxSection Entries reached');
      if (report_on == 'all' || report_on == 'section_check') {
        msgParts.push("Maximum entries for selected section has been reached"); // invalid section
      }
      silent = false; // force report to be seen
      valid = false;
    }

    // console.log('Valid',valid)
    // console.log('msgParts',msgParts)
    // console.log('Silent',silent)
    // console.log('result',! valid && msgParts.length > 0 && ! silent)


    if (!valid && msgParts.length > 0 && !silent) {
      var msgCombined = 'Issues: ' + msgParts.join(',<br />')
      showMessage(msgCombined, 'warning');
    }

    if (!valid) {
      $(uploadEntryBtn).prop('disabled', true); // disable upload btn
    } else {
      $(uploadEntryBtn).prop('disabled', false); // enable upload btn
    }

    return valid;
  }; // end validate form

  // Upload the photo button clicked
  $(uploadEntryBtn).on('click', function (e) {
    //console.log('uploadBtn clicked');

    e.preventDefault();

    hideMessage('uploadBtnEntryClick');
    var valid = validateInputs(false, 'all');
    if (!valid) {
      if ($uploaderExtError) {
        uploader.clearQueue(); //remove the invalid entry
        $uploaderExtError = false; // clear error flag
      }

      return; // prevent upload starting
    }

    if (valid) {
      uploader.submit(); // Submit upload when #upload_entry_btn is clicked
    }


  });

  // click manager for photo list

  $('#entries').on('click', function (e) {

    // console.log('entry clicked',e.target);
    // if e.target has class control and delte then delete the item via ajax
    if (!ajaxActive && $(e.target).hasClass("control")) {

      if ($(e.target).hasClass("delete")) {
        var photo_id = $(e.target).attr('photo_id');
        ajaxActive = true;
        $(loadingDiv).removeClass('display-none');
        remoteCall('delete', photo_id).then(function (response) {
          list_entries(response.data);
          ajaxActive = false;
          $(loadingDiv).addClass('display-none');
        });
      }

      if ($(e.target).hasClass("promote")) {
        var photo_id = $(e.target).attr('photo_id');
        ajaxActive = true;

        $(loadingDiv).removeClass('display-none');
        remoteCall('promote', photo_id).then(function (response) {
          list_entries(response.data);
          ajaxActive = false;
          $(loadingDiv).addClass('display-none');
        });
      }
    }
    e.preventDefault();
  });


// LIST ALL ENTRIES AND TOTAL UP ENTRY COSTS
  var list_entries = function (entries) {

    
    $entryCount = 0;

    var cost = 0;
    var parts = []; // html parts
    parts.push('<div id="thelist"><span id="cost_display"></span>');

    $sectionCounter = []; // reset section counters
    $categoryCounters = []; // reset category counters
    $sectionCount = 0;
    $categoryCounterIndex = 0;

    // Loop through the CATEGORIES - ie Digital images | Prints
    $.each(entries, function (category_name, sections) {
      // console.log('CATEGORY_NAME', category_name);
      // console.log('sections', sections);
      $categoryCounterIndex++; // 1 == Digital , 2 = Print

      parts.push('<div class="category">');
      parts.push('<h2>' + category_name + '</h2>');

      $categoryCounters[$categoryCounterIndex] = 0;

      $sectionCost = 0;
      $.each(sections, function (section_name, section_entries) {
        // console.log('SECTION_NAME', section_name);
        // console.log('SECTION_ENTRIES', section_entries);
        parts.push('<h3>' + section_name + '</h3>');

        var section_item_count = 0;
        if (section_entries.length > 0) {
          $sectionCount++;

          $categoryCounters[$categoryCounterIndex]++; // indicates category has entries

        }
        $.each(section_entries, function (index, section_item) {
          // console.log('SECTION_ENTRY_index', index);
          // console.log('SECTION_ITEM', section_item);

          section_item_count++;
          $entryCount++;
          $sectionCounter[section_item.section_id] = section_item_count;


          parts.push('<div class="entry"><div class="control"><span photo_id="' + section_item.id + '" title="Delete this image" class="glyphicon glyphicon-remove-circle  control delete" aria-hidden="true"></span></div>');
          if (section_item_count > 1) {
            parts.push('<span  photo_id="' + section_item.id + '" title="Move image up" class="glyphicon glyphicon-circle-arrow-up  control promote" aria-hidden="true"></span>');
          } else {
            parts.push('<div class="left-spacer"></div>');
          }
          parts.push('<div class="img-container"><img src="/storage/photos/' + section_item.filepath + '"></div><span class="title">' + section_item.title + '</span></div>');
          //parts.push( section_item.section_entry_number + ' - ' +  section_item.title + '</div>');

        });

        

        


        
      });
      cost = flagfall_cost; // init


      // if($categoryCounters[2] < 1 && $categoryCounters[1] > 0){
      //   cost += digital_only_entry_surcharge;
      // }

      cost += ($categoryCounters[1] * digital_section_cost) +  ($categoryCounters[2] * print_section_cost);
      // console.log('COST',cost);
      // console.log('CATEGORYCOUNTERS',$categoryCounters);
      // console.log('print_section_cost',print_section_cost);
      // console.log('digital_section_cost',digital_section_cost);

      parts.push('</div><!-- end category -->');
    });

    parts.push('</div>');
    var combined = parts.join(" ");
    $('#entries').hide().html(combined).fadeIn('slow');
    // $('#total_cost').html('$' + cost);
    // console.log('SECTION COUNTERS',$sectionCounter);
    // console.log('CATEGORY_COUNTERS',$categoryCounters);
    $entriesCost = cost;

    updateTotalCost();
    validateInputs('all')
  }

  // Function used to make ajax call init, delete and promote items 
  var remoteCall = function (action, data) {
    return $.ajax({
        method: "POST",
        dataType: "json",
        url: "api/process",
        data: {
          api_token: $apiToken,
          action: action,
          data: data
        }
      })
      .done(function (response) {
        // var response = $.parseJSON(data)
        // $entries = response.entries;
        // $user = response.user;
        //console.log(response.status   

      });
  }

  var clear_upload_form = function () {
    photoTitle.value = '';
    photoCategory_Section.value = 0;

  }


  var getCategoryId = function () {
    var res = photoCategory_Section.value.split('_');
    return res[0];
  }

  var getSectionId = function () {
    var res = photoCategory_Section.value.split('_');
    // console.log(res[1]);
    return res[1];
  }

  function hideMessage(from = 'unknown') {
    // console.log('hide message called from: ',from)
    $('#messageContainer').hide();
  }


  function showMessage(message, msgType, timeout = false, closer = false) {
    // console.log(message,msgType);
    //$('#messageContainer').show();

    $('#messageContainer').fadeIn(100);
    $('#messageContainer').removeClass('alert-success alert-info alert-warning alert-danger').addClass("alert-" + msgType);
    $('#msgBox').html(message);
    if (closer) {
      $('#close_icon').html("&times;")
    }


    // Upload success messages are the only ones that time out
    if (timeout) {
      setTimeout(function () {
        $('#messageContainer').fadeOut(100);
      }, 6000);
    }

  }



  function isDigitalOnlyEntry() {
    return $categoryCounters[1] > $categoryCounters[2]; // true if only Digital category used
  }

  function updateTotalCost() {
    var total = parseFloat($entriesCost) + parseFloat($returnPostageCost);
    // Add $2 if enrty is Digital Only if only $categoryCounter[1] ==1
    if (isDigitalOnlyEntry() && user_application.club_nomination !== 'Warragul Camera Club') {
      // Add the $2 catalog postage fee
      total += digital_only_entry_surcharge;
      $catalogFee = digital_only_entry_surcharge;
    } else {
      $catalogFee = 0;
    }


    // console.log('TOTAL COST', total);
    if (total > 0) {
      $('#final_submit_button').removeAttr('disabled');
    } else {
      $('#final_submit_button').attr('disabled', 'disabled');

    }
    $('#total_cost').html('$' + total.toFixed(2));
  }

  // Return postage changes
  $('#return_postage').on('keyup', function (e) {
    // console.log('RETURN POSTAGE CHANGE', $('#return_postage').val());
    var postage = $('#return_postage').val();
    postage = postage.replace('$', '');
    postage = postage.replace(' ', '');

    if (postage == '') {
      postage = 0;
    }

    if (/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/
      .test(postage)) {
      if (!isNaN(postage)) {
        $returnPostageCost = parseFloat(postage);
      }
    } else {
      $returnPostageCost = 0;
    }
    if ($returnPostageCost > 0) {
      $('#return_postage').val($returnPostageCost);
    }
    updateTotalCost();
  });

  $('#upload_form').on('click', function (e) {
    // $('#msgBox').fadeOut(100).html('');
    // $('#messageContainer').fadeOut(100);
    // hideMessage('#upload form click');
  })

  // FINAL FORM SUBMISSSION
  $('#final_submit_button').on('click', function (e) {
    //console.log('LOAD FINAL PAGE');



    if ($entryCount < 1) {
      alert('No entries have been added yet!');
      return
    }
    // Check that return_instructions is set and if
    // set to return by post that a return postage amount has been added

    // console.log('Return instructions',$returnInstructions);
    // console.log('Return PostageCost',$returnPostageCost);

    if ($returnPostageCost == 0 && returnPostageRegex.test($returnInstructions)) {
      alert('You have selected to have your print entries returned by post but you have not included any amount for postage. You need to enter an amount that will be sufficient to cover the return postage of your entries');
      $('#return_postage').focus();
      return;
    }


    // Disable button while we do the ajax call
    $('#final_submit_button').attr('disabled', 'disabled');

    // make a POST call
    $.ajax({
        method: "POST",
        url: "api/submit",
        data: {
          number_of_entries: $entryCount,
          number_of_sections: $sectionCount,
          entries_cost: $entriesCost + $catalogFee,
          return_postage: $returnPostageCost,
          return_post_option: $('#return_instructions').val(),
          return_group:$('#return_group').val(),
          api_token: $apiToken,
        }
      })
      .done(function (response) {
        // var response = $.parseJSON(data)

        if (response.status == 'success') {
          document.location = '/checkout';
        } else {

          var message = 'A problem was encountered ';

          if ($entryCount < 1) {
            message += ' make sure you add at least one photo!';
          }
          alert(message);
        }


      });
  });




  var uploader = new ss.SimpleUpload({
    debug: false,
    button: selectFileBtn,
    url: 'api/upload',
    autoSubmit: false,
    queue: false,
    multipleSelect: false,
    //allowedExtensions: ['jpg', 'jpeg'], // for example, if we were uploading pics
    name: 'image',
    multipart: true,
    hoverClass: 'hover',
    focusClass: 'focus',
    responseType: 'json',
    customHeaders: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    customHeaders: {
      'Authorization': 'Bearer ' + $apiToken
    },
    startXHR: function () {
      ajaxActive = true;
      progressOuter.style.display = 'block'; // make progress bar visible
      this.setProgressBar(progressBar);
    },
    onChange: function (filename, extension, selectFileBtn, filesize, file) {
      this.clearQueue();
      //console.log(filename,extension,filesize)
      hideMessage('xhr upload line 492');

      if (!/jpe?g$/i.test(extension) || filesize > 4096) {
        //this.removeCurrent();
        //this.clearQueue();
        //alert('Warning invalid file selected');
        showMessage('Files must be a JPEG and smaller than 4MB', 'danger');
        selectFileBtn.innerHTML = 'Click here to <br>select image to upload';
        return false;
      }


      selectFileBtn.innerHTML = filename;
      validateInputs(true, 'file_check');

      // return false; // stops file auto uploading with change event
    },
    onSubmit: function () {

      var self = this;
      hideMessage('xhr upload line 485');

      $(uploadEntryBtn).prop('disabled', true); // disable upload btn


      selectFileBtn.innerHTML = 'Uploading...'; // change button text to "Uploading..."
      self.setData({
        title: photoTitle.value,
        section_id: getSectionId(),
        category_id: getCategoryId()
      });

    },

    onComplete: function (filename, response) {
      selectFileBtn.innerHTML = $btnText; //'Choose Another File';
      progressOuter.style.display = 'none'; // hide progress bar when upload is completed
      ajaxActive = false;
      if (!response) {
        //console.log('onComplete respones:',response);
        showMessage('Unable to upload file', 'warning', true);
        return;
      }
      //console.log(response)

      if (response.status == 'success') {
        //console.log(response);
        // display entries
        list_entries(response.data);

        showMessage('<strong>' + escapeTags(filename) + '</strong>' + ' successfully uploaded.', 'success', true);
        // TODO clear the form
        clear_upload_form();

      } else {
        if (response.status == 'fail') {
          clear_upload_form();
          showMessage(response.message, 'danger', true);

        } else {
          showMessage('An error occurred and the upload failed.', 'danger', true);
        }
      }
    },
    onError: function () {
      selectFileBtn.innerHTML = $btnText; //'Choose Another File';
      ajaxActive = false;
      progressOuter.style.display = 'none';

      showMessage('Unable to upload file', 'danger', false);
      $(uploadEntryBtn).prop('disabled', true); // disable upload btn
      clear_upload_form();
    }
  });



  $returnPostageCost = application_return_postage; // initial value on page load
  $returnInstructions = return_instructions;

  //$('#msgBox').hide().html(''); // empty the message box
  $('#messageContainer').hide(); // hide the message box container
  $('#return_postage').val($returnPostageCost);



  // disable the upload button
  validateInputs(true);

  // Disable the return postage field if return postage option not set
  checkReturnPostage();




  ajaxActive = true;
  $(loadingDiv).removeClass('display-none');
  remoteCall('init').then(function (response) {
    list_entries(response.data);
    $(loadingDiv).addClass('display-none');
    ajaxActive = false;
  });





};