/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/show_entries.js":
/***/ (function(module, exports) {



window.onload = function () {

  // GLOBAL STATE VARS
  window.$entries; // list of entries
  window.$user; // User data
  window.$entryCount = 0;
  var $entriesCost = 0;
  var $returnPostageCost = 0;
  var $sectionCost = 0;

  var $sectionCounter = []; // holds section entry couters.
  var $sectionCount; // number of sections entered


  // Function used to make ajax call init, delete and promote items 
  var remoteCall = function remoteCall(action, data) {
    return $.ajax({
      method: "POST",
      dataType: "json",
      url: "/process",
      data: {
        action: action,
        data: data
      }
    }).done(function (response) {});
  };

  var list_entries = function list_entries(entries) {
    $entryCount = 0;

    var cost = 0;
    var parts = []; // html parts
    parts.push('<div id="thelist"><span id="cost_display"></span>');
    $sectionCounter = []; // reset section counters
    $sectionCount = 0;
    $.each(entries, function (category_name, sections) {
      // console.log('CATEGORY_NAME', category_name);
      //console.log('sections', sections);
      parts.push('<div class="category">');
      parts.push('<h2>' + category_name + '</h2>');

      $sectionCost = 0;
      $.each(sections, function (section_name, section_entries) {
        //console.log('SECTION_NAME', section_name);
        //console.log('SECTION_ENTRIES', section_entries);
        parts.push('<h3>' + section_name + '</h3>');

        var section_item_count = 0;
        if (section_entries.length > 0) {
          $sectionCount++;
        }
        $.each(section_entries, function (index, section_item) {
          // console.log('SECTION_ENTRY_index', index);
          //console.log('SECTION_ITEM', section_item);
          section_item_count++;
          $entryCount++;
          $sectionCounter[section_item.section_id] = section_item_count;

          parts.push('<div class="entry"><div class="control"></div>');

          parts.push('<div class="left-spacer"></div>');

          parts.push('<div class="img-container"><img src="/storage/photos/' + section_item.filepath + '"></div><span class="title">' + section_item.title + '</span></div>');
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
  };

  var getCategoryId = function getCategoryId() {
    var res = photoCategory_Section.value.split('_');
    return res[0];
  };

  var getSectionId = function getSectionId() {
    var res = photoCategory_Section.value.split('_');
    // console.log(res[1]);
    return res[1];
  };

  function showMsg(message, msgType) {
    // console.log(message,msgType);
    $('#msgBox').html(message);
    $('#msgBox').removeClass('success error warning').addClass(msgType).show();
    setTimeout(function () {
      $('#msgBox').fadeOut(100);
    }, 3000);
  }

  function updateTotalCost() {
    var total = parseFloat($entriesCost) + parseFloat($returnPostageCost);

    $('#total_cost').html('$' + total.toFixed(2));
  }

  remoteCall('init').then(function (response) {
    list_entries(response.data);
    $(loadingDiv).addClass('display-none');
  });;

  //$returnPostageCost = application_return_postage; // initial value on page load
};

/***/ }),

/***/ 2:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/show_entries.js");


/***/ })

/******/ });