

window.onload = function() {

// GLOBAL STATE VARS
window.$entries ; // list of entries
window.$user; // User data
window.$entryCount =0;
var $entriesCost = 0;
var $returnPostageCost = 0;
var $sectionCost = 0;


var $sectionCounter = []; // holds section entry couters.
var $sectionCount; // number of sections entered


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
    });
}

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
          
          
          parts.push('<div class="entry"><div class="control"></div>');
          
          parts.push('<div class="left-spacer"></div>');
          
          parts.push( '<div class="img-container"><img src="/storage/photos/' + section_item.filepath + '"></div><span class="title">' +  section_item.title + '</span></div>');
          

        });
  
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
    
    $('#total_cost').html('$' + total.toFixed(2));
  }

 
  remoteCall('init').then(function(response){
    list_entries(response.data);
    $(loadingDiv).addClass('display-none');
    
  });;

  //$returnPostageCost = application_return_postage; // initial value on page load
  
};
