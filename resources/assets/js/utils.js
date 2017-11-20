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

   var btn = document.getElementById('uploadBtn'),
      progressBar = document.getElementById('progressBar'),
      progressOuter = document.getElementById('progressOuter'),
      msgBox = document.getElementById('msgBox'),
      photoTitle = document.getElementById('photoTitle'),
      photoCategory_Section = document.getElementById('category_section');

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



  // category selector change event handler
  $('#category_section').on('change', function(e){
    // console.log(e.target.value);
    $('#msgBox').hide(); // empty the message box
    var sectionId = getSectionId(e.target.value);
    if ($sectionCounter[sectionId] >= $maxSectionEntries){
      showMsg('Max entries reached for selected section','warning');
    }

  });

  // Ajax file uploader submit
  $('#my_submit_btn').on('click', function( e ) {
    // console.log('Upload clicked');
     
    // validate inputs
    var valid = true;
    var msgParts =[];
    
    var filename = btn.innerHTML;
    if(  ! /\.jp[eg]$/i.test(filename) ){
      msgParts.push("File selected");
      valid=false;
    }

    // console.log('Title length', photoTitle.value.length);
    if (photoTitle.value.length < 2){
      msgParts.push("Photo title"); // invalid title
      valid=false;
    }
    var cs = getSectionId();
    // console.log('Section', cs);
    if (typeof cs == 'undefined' ||  cs  < 1 ){
      msgParts.push("Photo section"); // invalid section
      valid=false;
    } else if ($sectionCounter[cs] > $maxSectionEntries){
      //console.log('MaxSection Entries reached');
      msgParts.push("Maximum entries for selected section has been reached"); // invalid section
      valid=false;
    }
    // elseif count of section entries is already max
    // then report max section entries reached

    if(! valid ){
      var msgCombined = 'Invalid inputs for:<br />' + msgParts.join(',<br />')
      showMsg(msgCombined,'error');
      if($uploaderExtError){
        uploader.clearQueue(); //remove the invalid entry
        $uploaderExtError = false; // clear error flag
      }
      
      //  return ; // prevent upload starting
    }
    // console.log(valid);
    //showMsg('Uploading ' + photoTitle.value + '....','success');
    if ( valid ){
      uploader.submit(); // Submit upload when #my_submit_btn is clicked
    }
    
    e.preventDefault();
  });

  // GLOBAL STATE VARS
  window.$entries ; // list of entries
  window.$user; // User data
  window.$entryCount =0;
  var $entriesCost = 0;
  var $returnPostageCost = 0;

  var $uploaderExtError = false; 
  var $sectionCounter = []; // holds section entry couters.
  var $maxSectionEntries = 4; // max entries accepted per section

  // click manager for photo list

  $('#entries').on('click', function(e){

    // console.log('entry clicked',e.target);
    // if e.target has class control and delte then delete the item via ajax
    if( $(e.target).hasClass("control") ){
      
      if( $(e.target).hasClass("delete") ){
        var photo_id = $(e.target).parent().attr('photo_id');
        remoteCall('delete', photo_id);
      }

      if( $(e.target).hasClass("promote") ){
        var photo_id = $(e.target).parent().attr('photo_id');
        remoteCall('promote', photo_id);
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
        $.each(section_entries, function(index, section_item){
          // console.log('SECTION_ENTRY_index', index);
          //console.log('SECTION_ITEM', section_item);
          section_item_count++;
          $entryCount++;
          $sectionCounter[section_item.section_id] = section_item_count;
          
          
          parts.push('<div class="entry" photo_id="' + section_item.id + '" ><div title="delete item"class="control delete">X</div>');
          if (section_item_count > 1 ){
              parts.push('<div class="control promote" title="promote item">^</div>');
          }
          parts.push( section_item_count + ' ' +section_item.section_entry_number + ' <img src="/storage/photos/' + section_item.filepath + '" width="60">' +  section_item.title + '</div>');
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
  $.ajax({
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
      $entries = response.entries;
      $user = response.user;

      list_entries($entries);
      
    });

}
  

 

  var  clear_upload_form = function() {
    photoTitle.value = '';
    photoCategory_Section.value = 0;

  }


   var getCategoryId = function() {
      res =  photoCategory_Section.value.split('_');
      return res[0];
   } 

   var getSectionId = function() {
      res =  photoCategory_Section.value.split('_');
      // console.log(res[1]);
      return res[1];
   }    





  var uploader = new ss.SimpleUpload({
        debug: false,
        button: btn,
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
            progressOuter.style.display = 'block'; // make progress bar visible
            this.setProgressBar( progressBar );
        },
        onChange: function(filename,extension,uploadBtn,filesize, file){
          // console.log('Extension',extension);
          if (  ! /\jp[eg]$/i.test(extension)) {
            this.removeCurrent();
            // this.clearQueue();
            showMsg('Files must be a JPEG','error');
            return false;
          }
          btn.innerHTML = filename;
          // return false; // stops file auto uploading with change event
        },
        onSubmit: function() {
    
            var self = this;
            $('#msgBox').hide(); // empty the message box


            btn.innerHTML = 'Uploading...'; // change button text to "Uploading..."
            self.setData({
                title: photoTitle.value,
                section_id: getSectionId(),
                category_id: getCategoryId()
            });

          },

        onComplete: function( filename, response ) {
            btn.innerHTML = 'Choose Another File';
            progressOuter.style.display = 'none'; // hide progress bar when upload is completed

            if ( !response ) {
                showMsg('Unable to upload file', 'error');
                return;
            }

            if ( response.entries ) {
                console.log(response);
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
            progressOuter.style.display = 'none';
            showMsg('Unable to upload file','warning');
          }
	});

  function showMsg(message, msgType) {
    // console.log(message,msgType);
    $('#msgBox').html(message);
    $('#msgBox').removeClass('success error warning').addClass(msgType).show();
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
        button: 'submit',
        number_of_entries: $entryCount,
        postage: $returnPostageCost,
        return_post_option: $('#return_instructions').val()
       }
    })
    .done(function( response ) {
      // var response = $.parseJSON(data)

      if(response.success){
        document.location ='/final';
      } else {

        var message = 'A problem was encountered ';

        if($entryCount < 1) {
          message +=' make sure you add at least one photo!';
        }

        alert(message);
      }
      
      
    });

    // After Call redirect to final page
    
    // document.location ='index.php?' + encodeURI('action=submit&postage=' + $returnPostageCost + '&return_post_option=' + $('#return_instructions').val() );
  })

  $('#msgBox').hide().html(''); // empty the message box
  $('#return_postage').val($returnPostageCost);
  remoteCall('init');
  
};
