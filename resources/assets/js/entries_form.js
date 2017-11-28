var ss = require('simple-ajax-uploader');

function escapeTags( str ) {
  return String( str )
           .replace( /&/g, '&amp;' )
           .replace( /"/g, '&quot;' )
           .replace( /'/g, '&#39;' )
           .replace( /</g, '&lt;' )
           .replace( />/g, '&gt;' );
}

window.onload = function() {

// GLOBAL STATE VARS
window.$entries ; // list of entries
window.$user; // User data
window.$entryCount =0;
var $entriesCost = 0;
var $returnPostageCost = 0;
var $sectionCost = 0;

var $uploaderExtError = false; 
var $sectionCounter = []; // holds section entry couters.
var $sectionCount; // number of sections entered
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
 
  // category selector change event handler
  $('#category_section').on('change', function(e){
    // console.log(e.target.value);
    $('#msgBox').hide(); // empty the message box
    // var sectionId = getSectionId(e.target.value);
    // if ($sectionCounter[sectionId] >= $maxSectionEntries){
    //   showMsg('Max entries reached for selected section','warning');
    // }
    // 
    validateInputs();
  });

  var validateInputs = function (silent = false) {
    //console.log('validateInput');
    var valid = true;
    var msgParts =[];
    
    var filename = selectFileBtn.innerHTML;
    if(  ! /\.jp[eg]$/i.test(filename) ){
      msgParts.push("Select an image (JPEG) file to upload");
      valid=false;
    }

    // console.log('Title length', photoTitle.value.length);
    if (photoTitle.value.length < 2){
      msgParts.push("Enter a title (must be more than 2 characters long) "); // invalid title
      valid=false;
    }

    var cs = getSectionId();
    // console.log('Section', cs);
    // console.log('$sectionCounter[cs]', $sectionCounter[cs]);
    if (typeof cs == 'undefined' ||  cs  < 1 ){
      msgParts.push("Select an Section"); // invalid section
      valid=false;
    } else if ($sectionCounter[cs] >= $maxSectionEntries){
      //console.log('MaxSection Entries reached');
      msgParts.push("Maximum entries for selected section has been reached"); // invalid section
      valid=false;
    }
    if(! valid && ! silent){
      var msgCombined = 'Issues: ' + msgParts.join(',<br />')
      showMsg(msgCombined,'error');
    }
    
    if(! valid ){
      $(uploadEntryBtn).prop('disabled', true); // disable upload btn
    } else {
      $(uploadEntryBtn).prop('disabled', false); // disable upload btn
    }

    return valid; 
  }// end validate form

  // Upload the phote button clicked
  $(uploadEntryBtn).on('click', function( e ) {
    //console.log('uploadBtn clicked');
    var valid = validateInputs();
    if(! valid ){ 
      if($uploaderExtError){
        uploader.clearQueue(); //remove the invalid entry
        $uploaderExtError = false; // clear error flag
      }
      
       return ; // prevent upload starting
    }
    
    if ( valid ){
      uploader.submit(); // Submit upload when #upload_entry_btn is clicked
    }
    
    e.preventDefault();
  });

  // click manager for photo list

  $('#entries').on('click', function(e){

    // console.log('entry clicked',e.target);
    // if e.target has class control and delte then delete the item via ajax
    if( !ajaxActive && $(e.target).hasClass("control") ){
      
      if( $(e.target).hasClass("delete") ){
        var photo_id = $(e.target).attr('photo_id');
        ajaxActive = true;
        $(loadingDiv).removeClass('display-none');
        remoteCall('delete', photo_id).then(function(data){
          list_entries(data.entries);
          ajaxActive = false;
          $(loadingDiv).addClass('display-none');
        });
      }

      if( $(e.target).hasClass("promote") ){
        var photo_id = $(e.target).attr('photo_id');
        ajaxActive = true;

        $(loadingDiv).removeClass('display-none');
        remoteCall('promote', photo_id).then(function(data){
          list_entries(data.entries);
          ajaxActive = false;
          $(loadingDiv).addClass('display-none');
        });
      }
    }
    e.preventDefault();   
  });

  var  list_entries = function (entries) {
    $entryCount = 0;
    
    var cost = 0;
    var parts = []; // html parts
    parts.push('<div id="thelist"><span id="cost_display"></span>');
    $sectionCounter =[]; // reset section counters
    $sectionCount =0;
    $.each(entries, function(category_name, sections){
      // console.log('CATEGORY_NAME', category_name);
      //console.log('sections', sections);
      parts.push('<div class="category">');
      parts.push('<h2>' + category_name + '</h2>');

      $sectionCost = 0;
      $.each(sections, function(section_name, section_entries) {
        //console.log('SECTION_NAME', section_name);
        //console.log('SECTION_ENTRIES', section_entries);
        parts.push('<h3>' + section_name + '</h3>');

        var section_item_count = 0;
        if(section_entries.length > 0){
          $sectionCount++;
        }
        $.each(section_entries, function(index, section_item){
          // console.log('SECTION_ENTRY_index', index);
          //console.log('SECTION_ITEM', section_item);
          section_item_count++;
          $entryCount++;
          $sectionCounter[section_item.section_id] = section_item_count;
          
          
          parts.push('<div class="entry"><div class="control"><span photo_id="' + section_item.id + '" title="Delete this image" class="glyphicon glyphicon-remove-circle  control delete" aria-hidden="true"></span></div>');
          if (section_item_count > 1 ){
              parts.push('<span  photo_id="' + section_item.id + '" title="Move image up" class="glyphicon glyphicon-circle-arrow-up  control promote" aria-hidden="true"></span>');
          } else {
             parts.push('<div class="left-spacer"></div>');
          }
          parts.push( '<div class="img-container"><img src="/storage/photos/' + section_item.filepath + '"></div><span class="title">' +  section_item.title + '</span></div>');
          //parts.push( section_item.section_entry_number + ' - ' +  section_item.title + '</div>');

        });
        if (section_item_count < 1 ) {
          //parts.push('<div>no section entries</div>');
        } else if (section_item_count > 0 ) {
          if( cost == 0 ){
            cost += first_section_cost; // First section $12
          } else { 
            cost += additional_section_cost; // each extra section $10
          }
          
        } 
      });
      parts.push('</div><!-- end category -->');
    });

    parts.push('</div>');
    var combined = parts.join(" ");
    $('#entries').hide().html(combined).fadeIn('slow');
    // $('#total_cost').html('$' + cost);
    // console.log('SECTION COUNTERS',$sectionCounter);
    $entriesCost = cost; 

    updateTotalCost();
  }

// Function used to make ajax call init, delete and promote items 
var remoteCall = function (action, data) {
  return $.ajax({
      method: "POST",
      dataType: "json",
      url: "/process",
      data: { 
        action: action,
        data: data
       }
    })
    .done(function( response ) {
      // var response = $.parseJSON(data)
      // $entries = response.entries;
      // $user = response.user;
      //console.log(response.status)

      
      
    });
}

  var  clear_upload_form = function() {
    photoTitle.value = '';
    photoCategory_Section.value = 0;
  }


   var getCategoryId = function() {
      var res =  photoCategory_Section.value.split('_');
      return res[0];
   } 

   var getSectionId = function() {
      var res =  photoCategory_Section.value.split('_');
      // console.log(res[1]);
      return res[1];
   }    


  function showMsg(message, msgType) {
    // console.log(message,msgType);
    $('#msgBox').html(message);
    $('#msgBox').removeClass('success error warning').addClass(msgType).show();
    setTimeout(function(){
      $('#msgBox').fadeOut(100);
    }, 3000);
  }

  function updateTotalCost() {
    var total = parseFloat($entriesCost) + parseFloat($returnPostageCost);
    // console.log('TOTAL COST', total);
    if(total > 0 ){
      $('#final_submit_button').removeAttr('disabled');
    } else {
      $('#final_submit_button').attr('disabled','disabled');
      
    }
    $('#total_cost').html('$' + total.toFixed(2));
  }

  // Return postage changes
  $('#return_postage').on('keyup', function(e){
    // console.log('RETURN POSTAGE CHANGE', $('#return_postage').val());
    var postage = $('#return_postage').val();
    postage = postage.replace('$','');
    postage = postage.replace(' ','');
    // TODO Should replace anything that is not a number type char with ''
    if(postage == ''){
      postage = 0;
    }
    // remove $ sign if present TODO
    if(/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/
      .test(postage)){
      if(!isNaN(postage)){
        $returnPostageCost = parseFloat(postage);
      }   
    } else {
      $returnPostageCost = 0;
    }
    if($returnPostageCost > 0){
      $('#return_postage').val($returnPostageCost);
    }  
    updateTotalCost();
  });

  // FINAL FORM SUBMISSSION
  $('#final_submit_button').on('click', function(e){
    //console.log('LOAD FINAL PAGE');
    // Disable button
    
    $('#final_submit_button').attr('disabled', 'disabled');
    if($entryCount < 1) {
      return alert('No entries have been added yet!');
    }

    // make a POST call
    $.ajax({
      method: "POST",
      url: "/submit",
      data: { 
        number_of_entries: $entryCount,
        number_of_sections:$sectionCount,
        entries_cost: $entriesCost,
        return_postage: $returnPostageCost,
        return_post_option: $('#return_instructions').val()
       }
    })
    .done(function( response ) {
      // var response = $.parseJSON(data)

      if(response.success){
        document.location ='/home';
      } else {

        var message = 'A problem was encountered ';

        if($entryCount < 1) {
          message +=' make sure you add at least one photo!';
        }
        alert(message);
      }
      
      
    });
 }); 

  $('#msgBox').hide().html(''); // empty the message box
  $('#return_postage').val($returnPostageCost);

  

  var uploader = new ss.SimpleUpload({
        debug: false,
        button: selectFileBtn,
        url: '/upload',
        autoSubmit: false,
        allowedExtensions: ['jpg', 'jpeg'], // for example, if we were uploading pics
        name: 'image',
        multipart: true,
        hoverClass: 'hover',
        focusClass: 'focus',
        responseType: 'json',
        customHeaders: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        startXHR: function() {
            ajaxActive = true;
            progressOuter.style.display = 'block'; // make progress bar visible
            this.setProgressBar( progressBar );
        },
        onChange: function(filename,extension,selectFileBtn,filesize, file){

          if (  ! /\jp[eg]$/i.test(extension)) {
            this.removeCurrent();
            // this.clearQueue();
            showMsg('Files must be a JPEG','error');
            return false;
          }

          selectFileBtn.innerHTML = filename;
          validateInputs();
          
          // return false; // stops file auto uploading with change event
        },
        onSubmit: function() {
    
            var self = this;
            $('#msgBox').hide(); // empty the message box


            selectFileBtn.innerHTML = 'Uploading...'; // change button text to "Uploading..."
            self.setData({
                title: photoTitle.value,
                section_id: getSectionId(),
                category_id: getCategoryId()
            });

          },

        onComplete: function( filename, response ) {
            selectFileBtn.innerHTML = $btnText; //'Choose Another File';
            progressOuter.style.display = 'none'; // hide progress bar when upload is completed
            ajaxActive = false;
            if ( !response ) {
              //console.log('onComplete respones:',response);
                showMsg('Unable to upload file', 'error');
                return;
            }

            if ( response.entries ) {
                //console.log(response);
                // display entries
                list_entries(response.entries);

                showMsg('<strong>' + escapeTags( filename ) + '</strong>' + ' successfully uploaded.', 'success');
                // TODO clear the form
                clear_upload_form();

            } else {
                if ( response.msg )  {
                    clear_upload_form();
                    showMsg(escapeTags( response.msg ), 'error');

                } else {
                    showMsg('An error occurred and the upload failed.','error') ;
                }
            }
          },
        onError: function() {
            ajaxActive = false;
            progressOuter.style.display = 'none';
            showMsg('Unable to upload file','warning');
          }
  });

  // disable the upload button
  validateInputs(true);

  ajaxActive = true;
  $(loadingDiv).removeClass('display-none');
  remoteCall('init').then(function(data){
    list_entries(data.entries);
    $(loadingDiv).addClass('display-none');
    ajaxActive = false;
  });;
  
};
