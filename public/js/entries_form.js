!function(e){var t={};function n(s){if(t[s])return t[s].exports;var i=t[s]={i:s,l:!1,exports:{}};return e[s].call(i.exports,i,i.exports,n),i.l=!0,i.exports}n.m=e,n.c=t,n.d=function(e,t,s){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:s})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=1)}({1:function(e,t,n){e.exports=n("6pTK")},"6pTK":function(e,t,n){function s(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}var i=n("P62f");window.onload=function(){var e;window.$entries,window.$user,window.$entryCount=0;var t,n=0,o=0,r=0,a=[],u=[],l=!1,d=[],c=!1,p=document.getElementById("select_file_btn"),h=document.getElementById("upload_entry_btn"),f=document.getElementById("progressBar"),_=document.getElementById("progressOuter"),m=(document.getElementById("msgBox"),document.getElementById("photoTitle")),g=document.getElementById("category_section"),v=document.getElementById("loadingDiv"),b=p.innerHTML,y=/Return by Post/i,x="";$("#closeMessageButton").on("click",function(){T("close message button click")}),$("#return_instructions").on("change",function(){x=$("#return_instructions").val(),C()});var C=function(){y.test(x)?$("#return_postage").prop("disabled",!1):($("#return_postage").prop("disabled",!0),$("#return_postage").val(0),o=0),B()};$("#photoTitle").on("keyup",function(e){E(!1,"title_check")}),$("#category_section").on("change",function(e){E(!1,"section_check")});var E=function(){var e=arguments.length>0&&void 0!==arguments[0]&&arguments[0];arguments.length>1&&void 0!==arguments[1]&&arguments[1];T("validate inputs");var t=!0,n=[];m.value.length<3&&(n.push("Enter a title (must be more than 2 characters long) "),t=!1);var s=S();((void 0===s||s<1)&&(n.push("Select an Section"),t=!1),d[s]>=4&&(n.push("Maximum entries for selected section has been reached"),e=!1,t=!1),!t&&n.length>0&&!e)&&w("Issues: "+n.join(",<br />"),"warning");return t?$(h).prop("disabled",!1):$(h).prop("disabled",!0),t};$(h).on("click",function(e){e.preventDefault(),T("uploadBtnEntryClick");var t=E(!1,"all");t?t&&H.submit():l&&(H.clearQueue(),l=!1)}),$("#entries").on("click",function(e){if(!c&&$(e.target).hasClass("control")){if($(e.target).hasClass("delete")){var t=$(e.target).attr("photo_id");c=!0,$(v).removeClass("display-none"),P("delete",t).then(function(e){O(e.data),c=!1,$(v).addClass("display-none")})}if($(e.target).hasClass("promote")){t=$(e.target).attr("photo_id");c=!0,$(v).removeClass("display-none"),P("promote",t).then(function(e){O(e.data),c=!1,$(v).addClass("display-none")})}}e.preventDefault()});var O=function(e){$entryCount=0;var s=0,i=[];i.push('<div id="thelist"><span id="cost_display"></span>'),d=[],a=[],t=0,u=0,$.each(e,function(e,n){u++,i.push('<div class="category">'),i.push("<h2>"+e+"</h2>"),a[u]=0,0,$.each(n,function(e,n){i.push("<h3>"+e+"</h3>");var s=0;n.length>0&&(t++,a[u]++),$.each(n,function(e,t){s++,$entryCount++,d[t.section_id]=s,i.push('<div class="entry"><div class="control"><span photo_id="'+t.id+'" title="Delete this image" class="glyphicon glyphicon-remove-circle  control delete" aria-hidden="true"></span></div>'),s>1?i.push('<span  photo_id="'+t.id+'" title="Move image up" class="glyphicon glyphicon-circle-arrow-up  control promote" aria-hidden="true"></span>'):i.push('<div class="left-spacer"></div>'),i.push('<div class="img-container"><img src="/storage/photos/'+t.filepath+'"></div><span class="title">'+t.title+"</span></div>")})}),s=flagfall_cost,s+=a[1]*digital_section_cost+a[2]*print_section_cost,i.push("</div>\x3c!-- end category --\x3e")}),i.push("</div>");var o=i.join(" ");$("#entries").hide().html(o).fadeIn("slow"),n=s,B(),E("all")},P=function(e,t){return $.ajax({method:"POST",dataType:"json",url:"api/process",data:{api_token:$apiToken,action:e,data:t}}).done(function(e){})},U=function(){m.value="",g.value=0},S=function(){return g.value.split("_")[1]};function T(){arguments.length>0&&void 0!==arguments[0]&&arguments[0];$("#messageContainer").hide()}function w(e,t){var n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],s=arguments.length>3&&void 0!==arguments[3]&&arguments[3];$("#messageContainer").fadeIn(100),$("#messageContainer").removeClass("alert-success alert-info alert-warning alert-danger").addClass("alert-"+t),$("#msgBox").html(e),s&&$("#close_icon").html("&times;"),n&&setTimeout(function(){$("#messageContainer").fadeOut(100)},6e3)}function B(){var e=parseFloat(n)+parseFloat(o);a[1]>a[2]&&"Warragul Camera Club"!==user_application.club_nomination?(e+=digital_only_entry_surcharge,r=digital_only_entry_surcharge):r=0,e>0?$("#final_submit_button").removeAttr("disabled"):$("#final_submit_button").attr("disabled","disabled"),$("#total_cost").html("$"+e.toFixed(2))}$("#return_postage").on("keyup",function(e){var t=$("#return_postage").val();""==(t=(t=t.replace("$","")).replace(" ",""))&&(t=0),/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/.test(t)?isNaN(t)||(o=parseFloat(t)):o=0,o>0&&$("#return_postage").val(o),B()}),$("#upload_form").on("click",function(e){}),$("#final_submit_button").on("click",function(e){if($entryCount<1)alert("No entries have been added yet!");else{if(0==o&&y.test(x))return alert("You have selected to have your print entries returned by post but you have not included any amount for postage. You need to enter an amount that will be sufficient to cover the return postage of your entries"),void $("#return_postage").focus();$("#final_submit_button").attr("disabled","disabled"),$.ajax({method:"POST",url:"api/submit",data:{number_of_entries:$entryCount,number_of_sections:t,entries_cost:n+r,return_postage:o,return_post_option:$("#return_instructions").val(),return_group:$("#return_group").val(),api_token:$apiToken}}).done(function(e){if("success"==e.status)document.location="/checkout";else{var t="A problem was encountered ";$entryCount<1&&(t+=" make sure you add at least one photo!"),alert(t)}})}});var H=new i.SimpleUpload((s(e={debug:!1,button:p,url:"api/upload",autoSubmit:!1,queue:!1,multipleSelect:!1,name:"image",multipart:!0,hoverClass:"hover",focusClass:"focus",responseType:"json",customHeaders:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}},"customHeaders",{Authorization:"Bearer "+$apiToken}),s(e,"startXHR",function(){c=!0,_.style.display="block",this.setProgressBar(f)}),s(e,"onChange",function(e,t,n,s,i){if(this.clearQueue(),T("xhr upload line 492"),!/jpe?g$/i.test(t)||s>4096)return w("Files must be a JPEG and smaller than 3MB","danger"),n.innerHTML="Click here to <br>select image to upload",!1;n.innerHTML=e,E(!0,"file_check")}),s(e,"onSubmit",function(){T("xhr upload line 485"),$(h).prop("disabled",!0),p.innerHTML="Uploading...",this.setData({title:m.value,section_id:S(),category_id:g.value.split("_")[0]})}),s(e,"onComplete",function(e,t){(p.innerHTML=b,_.style.display="none",c=!1,t)?"success"==t.status?(O(t.data),w("<strong>"+String(e).replace(/&/g,"&amp;").replace(/"/g,"&quot;").replace(/'/g,"&#39;").replace(/</g,"&lt;").replace(/>/g,"&gt;")+"</strong> successfully uploaded.","success",!0),U()):"fail"==t.status?(U(),w(t.message,"danger",!0)):w("An error occurred and the upload failed.","danger",!0):w("Unable to upload file","warning",!0)}),s(e,"onError",function(){p.innerHTML=b,c=!1,_.style.display="none",w("Unable to upload file","danger",!1),$(h).prop("disabled",!0),U()}),e));o=application_return_postage,x=return_instructions,$("#messageContainer").hide(),$("#return_postage").val(o),E(!0),C(),c=!0,$(v).removeClass("display-none"),P("init").then(function(e){O(e.data),$(v).addClass("display-none"),c=!1})}},P62f:function(e,t,n){var s,i,o;i="undefined"!=typeof window?window:this,o=function(e){var t,n=e.ss||{},s=/^\s+/,i=/\s+$/,o=/[xy]/g,r=/.*(\/|\\)/,a=/.*[.]/,u=/[\t\r\n]/g,l=Object.prototype.toString.call(e.HTMLElement).indexOf("Constructor")>0,d=-1!==navigator.userAgent.indexOf("MSIE 7"),c=document.createElement("input");c.type="file",t="multiple"in c&&"undefined"!=typeof File&&void 0!==(new XMLHttpRequest).upload,n.obj2string=function(e,t){"use strict";var s=[];for(var i in e)if(e.hasOwnProperty(i)){var o=t?t+"["+i+"]":i,r=e[i];s.push("object"==typeof r?n.obj2string(r,o):encodeURIComponent(o)+"="+encodeURIComponent(r))}return s.join("&")},n.extendObj=function(e,t){"use strict";for(var n in t)t.hasOwnProperty(n)&&(e[n]=t[n])},n.addEvent=function(e,t,s){"use strict";return e.addEventListener?e.addEventListener(t,s,!1):e.attachEvent("on"+t,s),function(){n.removeEvent(e,t,s)}},n.removeEvent=document.removeEventListener?function(e,t,n){e.removeEventListener&&e.removeEventListener(t,n,!1)}:function(e,t,n){var s="on"+t;void 0===e[s]&&(e[s]=null),e.detachEvent(s,n)},n.newXHR=function(){"use strict";if("undefined"!=typeof XMLHttpRequest)return new e.XMLHttpRequest;if(e.ActiveXObject)try{return new e.ActiveXObject("Microsoft.XMLHTTP")}catch(e){return!1}},n.encodeUTF8=function(e){"use strict";return unescape(encodeURIComponent(e))},n.getIFrame=function(){"use strict";var e,t=n.getUID();return d?e=document.createElement('<iframe src="javascript:false;" name="'+t+'">'):((e=document.createElement("iframe")).src="javascript:false;",e.name=t),e.style.display="none",e.id=t,e},n.getForm=function(e){"use strict";var t=document.createElement("form");for(var n in t.encoding="multipart/form-data",t.enctype="multipart/form-data",t.style.display="none",e)e.hasOwnProperty(n)&&(t[n]=e[n]);return t},n.getHidden=function(e,t){"use strict";var n=document.createElement("input");return n.type="hidden",n.name=e,n.value=t,n},n.parseJSON=function(t){"use strict";if(!t)return!1;if(t=n.trim(t+""),e.JSON&&e.JSON.parse)try{return e.JSON.parse(t+"")}catch(e){return!1}var s,i=null;return!(!t||n.trim(t.replace(/(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g,function(e,t,n,o){return s&&t&&(i=0),0===i?e:(s=n||t,i+=!o-!n,"")})))&&Function("return "+t)()},n.getBox=function(t){"use strict";var n,s,i=0,o=0;if(t.getBoundingClientRect)n=t.getBoundingClientRect(),s=document.documentElement,i=n.top+(e.pageYOffset||s.scrollTop)-(s.clientTop||0),o=n.left+(e.pageXOffset||s.scrollLeft)-(s.clientLeft||0);else do{o+=t.offsetLeft,i+=t.offsetTop}while(t=t.offsetParent);return{top:Math.round(i),left:Math.round(o)}},n.addStyles=function(e,t){"use strict";for(var n in t)t.hasOwnProperty(n)&&(e.style[n]=t[n])},n.copyLayout=function(e,t){"use strict";var s=n.getBox(e);n.addStyles(t,{position:"absolute",left:s.left+"px",top:s.top+"px",width:e.offsetWidth+"px",height:e.offsetHeight+"px"})},n.getUID=function(){"use strict";return"axxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(o,function(e){var t=16*Math.random()|0;return("x"==e?t:3&t|8).toString(16)})};var p="".trim;n.trim=p&&!p.call("\ufeff ")?function(e){return null===e?"":p.call(e)}:function(e){return null===e?"":e.toString().replace(s,"").replace(i,"")};return n.indexOf=[].indexOf?function(e,t){return e.indexOf(t)}:function(e,t){for(var n=0,s=e.length;n<s;n++)if(e[n]===t)return n;return-1},n.arrayDelete=function(e,t){var s=n.indexOf(e,t);s>-1&&e.splice(s,1)},n.getFilename=function(e){"use strict";return e.replace(r,"")},n.getExt=function(e){"use strict";return-1!==e.indexOf(".")?e.replace(a,""):""},n.isVisible=function(e){"use strict";return!!e&&(1!==e.nodeType||e==document.body?(e=null,!0):e.parentNode&&(e.offsetWidth>0||e.offsetHeight>0||"none"!=n.getStyle(e,"display").toLowerCase())?n.isVisible(e.parentNode):(e=null,!1))},n.getStyle=function(t,n){"use strict";return e.getComputedStyle?t.ownerDocument.defaultView.getComputedStyle(t,null).getPropertyValue(n):t.currentStyle&&t.currentStyle[n]?t.currentStyle[n]:void 0},n.getFormObj=function(e){"use strict";for(var t,s=e.elements,i=["button","submit","image","reset"],o={},r=0,a=s.length;r<a;r++)if(t={},s[r].name&&!s[r].disabled&&-1===n.indexOf(i,s[r].type)){if(("checkbox"==s[r].type||"radio"==s[r].type)&&!s[r].checked)continue;t[s[r].name]=n.val(s[r]),n.extendObj(o,t)}return o},n.val=function(e){"use strict";if(e){if("SELECT"==e.nodeName.toUpperCase()){for(var t,n=e.options,s=e.selectedIndex,i="select-one"===e.type||s<0,o=i?null:[],r=0,a=n.length;r<a;r++)if((n[r].selected||r===s)&&!n[r].disabled){if(t=n[r].value?n[r].value:n[r].text,i)return t;o.push(t)}return o}return e.value}},n.hasClass=function(e,t){"use strict";return!(!e||!t)&&(" "+e.className+" ").replace(u," ").indexOf(" "+t+" ")>=0},n.addClass=function(e,t){"use strict";if(!e||!t)return!1;n.hasClass(e,t)||(e.className+=" "+t)},n.removeClass=function(){"use strict";var e={};return function(t,n){if(!t||!n)return!1;e[n]||(e[n]=new RegExp("(?:^|\\s)"+n+"(?!\\S)")),t.className=t.className.replace(e[n],"")}}(),n.purge=function(e){"use strict";var t,s,i,o=e.attributes;if(o)for(t=o.length-1;t>=0;t-=1)"function"==typeof e[i=o[t].name]&&(e[i]=null);if(o=e.childNodes)for(s=o.length,t=0;t<s;t+=1)n.purge(e.childNodes[t])},n.remove=function(e){"use strict";e&&e.parentNode&&(n.purge(e),e.parentNode.removeChild(e)),e=null},n.verifyElem=function(t){"use strict";return"undefined"!=typeof jQuery&&t instanceof jQuery?t=t[0]:"string"==typeof t&&("#"==t.charAt(0)&&(t=t.substr(1)),t=document.getElementById(t)),!(!t||1!==t.nodeType)&&("A"==t.nodeName.toUpperCase()&&(t.style.cursor="pointer",n.addEvent(t,"click",function(t){t&&t.preventDefault?t.preventDefault():e.event&&(e.event.returnValue=!1)})),t)},n._options={},n.uploadSetup=function(e){"use strict";n.extendObj(n._options,e)},n.SimpleUpload=function(e){"use strict";if(this._opts={button:"",url:"",dropzone:"",dragClass:"",form:"",overrideSubmit:!0,cors:!1,withCredentials:!1,progressUrl:!1,sessionProgressUrl:!1,nginxProgressUrl:!1,multiple:!1,maxUploads:3,queue:!0,checkProgressInterval:500,keyParamName:"APC_UPLOAD_PROGRESS",sessionProgressName:"PHP_SESSION_UPLOAD_PROGRESS",nginxProgressHeader:"X-Progress-ID",customProgressHeaders:{},corsInputName:"XHR_CORS_TARGETORIGIN",allowedExtensions:[],accept:"",maxSize:!1,name:"",data:{},noParams:!0,autoSubmit:!0,multipart:!0,method:"POST",responseType:"",debug:!1,hoverClass:"",focusClass:"",disabledClass:"",customHeaders:{},encodeHeaders:!0,autoCalibrate:!0,onBlankSubmit:function(){},onAbort:function(e,t,n){},onChange:function(e,t,n,s,i){},onSubmit:function(e,t,n,s){},onProgress:function(e){},onUpdateFileSize:function(e){},onComplete:function(e,t,n,s){},onExtError:function(e,t){},onSizeError:function(e,t){},onError:function(e,t,n,s,i,o,r){},startXHR:function(e,t,n){},endXHR:function(e,t,n){},startNonXHR:function(e,t){},endNonXHR:function(e,t){}},n.extendObj(this._opts,n._options),n.extendObj(this._opts,e),this._queue=[],this._active=0,this._disabled=!1,this._maxFails=10,this._progKeys={},this._sizeFlags={},this._btns=[],this.addButton(this._opts.button),delete this._opts.button,this._opts.button=e=null,!1===this._opts.multiple&&(this._opts.maxUploads=1),""!==this._opts.dropzone&&this.addDZ(this._opts.dropzone),""===this._opts.dropzone&&this._btns.length<1)throw new Error("Invalid upload button. Make sure the element you're passing exists.");""!==this._opts.form&&this.setForm(this._opts.form),this._createInput(),this._manDisabled=!1,this.enable(!0)},n.SimpleUpload.prototype={destroy:function(){"use strict";for(var e=this._btns.length;e--;)this._btns[e].off&&this._btns[e].off(),n.removeClass(this._btns[e],this._opts.hoverClass),n.removeClass(this._btns[e],this._opts.focusClass),n.removeClass(this._btns[e],this._opts.disabledClass),this._btns[e].disabled=!1;this._killInput(),this._destroy=!0},log:function(t){"use strict";this._opts&&this._opts.debug&&e.console&&e.console.log&&e.console.log("[Uploader] "+t)},setData:function(e){"use strict";this._opts.data=e},setOptions:function(e){"use strict";n.extendObj(this._opts,e)},addButton:function(e){var t;if(e instanceof Array)for(var s=0,i=e.length;s<i;s++)!1!==(t=n.verifyElem(e[s]))?this._btns.push(this.rerouteClicks(t)):this.log("Button with array index "+s+" is invalid");else!1!==(t=n.verifyElem(e))&&this._btns.push(this.rerouteClicks(t))},addDZ:function(e){t&&((e=n.verifyElem(e))?this.addDropZone(e):this.log("Invalid or nonexistent element passed for drop zone"))},setProgressBar:function(e){"use strict";this._progBar=n.verifyElem(e)},setPctBox:function(e){"use strict";this._pctBox=n.verifyElem(e)},setFileSizeBox:function(e){"use strict";this._sizeBox=n.verifyElem(e)},setProgressContainer:function(e){"use strict";this._progBox=n.verifyElem(e)},setAbortBtn:function(e,t){"use strict";this._abortBtn=n.verifyElem(e),this._removeAbort=!1,t&&(this._removeAbort=!0)},setForm:function(t){"use strict";if(this._form=n.verifyElem(t),this._form&&"FORM"==this._form.nodeName.toUpperCase()){var s=this;this._opts.autoSubmit=!1,this._opts.overrideSubmit&&(n.addEvent(this._form,"submit",function(t){t.preventDefault?t.preventDefault():e.event&&(e.event.returnValue=!1),s._validateForm()&&s.submit()}),this._form.submit=function(){s._validateForm()&&s.submit()})}else this.log("Invalid or nonexistent element passed for form")},getQueueSize:function(){"use strict";return this._queue.length},removeCurrent:function(e){"use strict";if(e){for(var t=this._queue.length;t--;)if(this._queue[t].id===e){this._queue.splice(t,1);break}}else this._queue.splice(0,1);this._cycleQueue()},clearQueue:function(){"use strict";this._queue.length=0},disable:function(e){"use strict";var t,s=this._btns.length;for(this._manDisabled=!e||!0===this._manDisabled,this._disabled=!0;s--;)"INPUT"!=(t=this._btns[s].nodeName.toUpperCase())&&"BUTTON"!=t||(this._btns[s].disabled=!0),""!==this._opts.disabledClass&&n.addClass(this._btns[s],this._opts.disabledClass);this._input&&this._input.parentNode&&(this._input.parentNode.style.visibility="hidden")},enable:function(e){"use strict";if(e||(this._manDisabled=!1),!0!==this._manDisabled){var t=this._btns.length;for(this._disabled=!1;t--;)n.removeClass(this._btns[t],this._opts.disabledClass),this._btns[t].disabled=!1}},updatePosition:function(e){"use strict";(e=e||this._btns[0])&&this._input&&this._input.parentNode&&n.copyLayout(e,this._input.parentNode),e=null},rerouteClicks:function(t){"use strict";var s=this;if(t.off=n.addEvent(t,"mouseover",function(){s._disabled||(s._input||s._createInput(),s._overBtn=t,n.copyLayout(t,s._input.parentNode),s._input.parentNode.style.visibility="visible")}),s._opts.autoCalibrate&&!n.isVisible(t)){s.log("Upload button not visible");var i=function(){n.isVisible(t)?(s.log("Upload button now visible"),e.setTimeout(function(){s.updatePosition(t),1===s._btns.length&&(s._input.parentNode.style.visibility="hidden")},200)):e.setTimeout(i,500)};e.setTimeout(i,500)}return t},submit:function(e,t){"use strict";!t&&this._queue.length<1?this._opts.onBlankSubmit.call(this):this._disabled||this._active>=this._opts.maxUploads||this._queue.length<1||this._checkFile(this._queue[0])&&(!1!==this._opts.onSubmit.call(this,this._queue[0].name,this._queue[0].ext,this._queue[0].btn,this._queue[0].size)?(this._active++,(!1===this._opts.multiple||!1===this._opts.queue&&this._active>=this._opts.maxUploads)&&this.disable(!0),this._initUpload(this._queue[0])):this.removeCurrent(this._queue[0].id))}},n.IframeUpload={_detachEvents:{},_detach:function(e){this._detachEvents[e]&&(this._detachEvents[e](),delete this._detachEvents[e])},_getHost:function(e){var t=document.createElement("a");return t.href=e,t.hostname?t.hostname.toLowerCase():e},_addFiles:function(e){var t=n.getFilename(e.value),s=n.getExt(t);return!1!==this._opts.onChange.call(this,t,s,this._overBtn,void 0,e)&&(this._queue.push({id:n.getUID(),file:e,name:t,ext:s,btn:this._overBtn,size:null}),!0)},_uploadIframe:function(t,s,i,o,r,a,u){"use strict";var l,d,c,p=this,h=this._opts,f=n.getUID(),_=n.getIFrame(),m=!1,g=!1;if(d=!0===h.noParams?h.url:h.nginxProgressUrl?d+(d.indexOf("?")>-1?"&":"?")+encodeURIComponent(h.nginxProgressHeader)+"="+encodeURIComponent(f):h.url,l=n.getForm({action:d,target:_.name,method:h.method}),h.onProgress.call(this,0),r&&(r.innerHTML="0%"),o&&(o.style.width="0%"),h.cors){var v=n.getUID();p._detachEvents[v]=n.addEvent(e,"message",function(e){p._getHost(e.origin)==p._getHost(h.url)?(m=!0,p._detach(v),h.endNonXHR.call(p,t.name,t.btn),p._finish(t,"","",e.data,i,s,r,a,u)):p.log("Non-matching origin: "+e.origin)})}p._detachEvents[_.id]=n.addEvent(_,"load",function(){for(var d in p._detach(_.id),h.sessionProgressUrl?l.appendChild(n.getHidden(h.sessionProgressName,f)):h.progressUrl&&l.appendChild(n.getHidden(h.keyParamName,f)),p._form&&n.extendObj(h.data,n.getFormObj(p._form)),h.data)h.data.hasOwnProperty(d)&&l.appendChild(n.getHidden(d,h.data[d]));h.cors&&l.appendChild(n.getHidden(h.corsInputName,e.location.href)),l.appendChild(t.file),p._detachEvents[t.id]=n.addEvent(_,"load",function(){if(_&&_.parentNode&&!g)if(p._detach(t.id),g=!0,delete p._progKeys[f],delete p._sizeFlags[f],a&&n.removeEvent(a,"click",c),h.cors)e.setTimeout(function(){n.remove(_),m||p._errorFinish(t,"","",!1,"error",s,i,r,a,u),t=h=f=_=i=s=r=a=u=null},600);else{try{var o=(_.contentDocument?_.contentDocument:_.contentWindow.document).body.innerHTML;n.remove(_),_=null,h.endNonXHR.call(p,t.name,t.btn),p._finish(t,"","",o,i,s,r,a,u)}catch(e){p._errorFinish(t,"",e.message,!1,"error",s,i,r,a,u)}t=h=f=i=s=r=null}}),a&&(c=function(){if(n.removeEvent(a,"click",c),delete p._progKeys[f],delete p._sizeFlags[f],_){g=!0,p._detach(t.id);try{_.contentWindow.document.execCommand&&_.contentWindow.document.execCommand("Stop")}catch(e){}try{_.src="javascript".concat(":false;")}catch(e){}e.setTimeout(function(){n.remove(_),_=null},1)}p.log("Upload aborted"),h.onAbort.call(p,t.name,t.btn,t.size),p._last(i,s,r,a,u)},n.addEvent(a,"click",c)),p.log("Commencing upload using iframe"),l.submit(),e.setTimeout(function(){n.remove(l),l=null,p.removeCurrent(t.id)},1),p._hasProgUrl&&(p._progKeys[f]=1,e.setTimeout(function(){p._getProg(f,o,i,r,1),o=i=r=null},600))}),document.body.appendChild(l),document.body.appendChild(_)},_getProg:function(t,s,i,o,r){"use strict";var a,u,l,d=this,c=this._opts,p=(new Date).getTime();if(t)if(c.nginxProgressUrl?u=c.nginxProgressUrl+"?"+encodeURIComponent(c.nginxProgressHeader)+"="+encodeURIComponent(t)+"&_="+p:c.sessionProgressUrl?u=c.sessionProgressUrl:c.progressUrl&&(u=c.progressUrl+"?progresskey="+encodeURIComponent(t)+"&_="+p),l=function(){var u,p,h,f,_;try{if(l&&(c.cors||4===a.readyState)){l=void 0,a.onreadystatechange=function(){};try{_=a.statusText,f=a.status}catch(e){_="",f=""}if(c.cors||f>=200&&f<300){if(!1===(u=n.parseJSON(a.responseText)))return void d.log("Error parsing progress response (expecting JSON)");if(c.nginxProgressUrl){if("uploading"==u.state)(p=parseInt(u.size,10))>0&&(h=Math.round(parseInt(u.received,10)/p*100),p=Math.round(p/1024));else if("done"==u.state)h=100;else if("error"==u.state)return void d.log("Error requesting upload progress: "+u.status)}else(c.sessionProgressUrl||c.progressUrl)&&!0===u.success&&(p=parseInt(u.size,10),h=parseInt(u.pct,10));if(h&&(o&&(o.innerHTML=h+"%"),s&&(s.style.width=h+"%"),c.onProgress.call(d,h)),p&&!d._sizeFlags[t]&&(i&&(i.innerHTML=p+"K"),d._sizeFlags[t]=1,c.onUpdateFileSize.call(d,p)),!h&&!p&&r>=d._maxFails)return r++,void d.log("Failed progress request limit reached. Count: "+r);h<100&&d._progKeys[t]&&e.setTimeout(function(){d._getProg(t,s,i,o,r),t=s=i=o=r=null},c.checkProgressInterval)}else delete d._progKeys[t],d.log("Error requesting upload progress: "+f+" "+_);a=p=h=f=_=u=null}}catch(e){d.log("Error requesting upload progress: "+e.message)}},c.cors&&!c.sessionProgressUrl){if(!e.XDomainRequest)return;(a=new e.XDomainRequest).open("GET",u,!0),a.onprogress=a.ontimeout=function(){},a.onload=l,a.onerror=function(){delete d._progKeys[t],t=null,d.log("Error requesting upload progress")}}else{var h,f=c.sessionProgressUrl?"POST":"GET",_={};for(var m in(a=n.newXHR()).onreadystatechange=l,a.open(f,u,!0),c.sessionProgressUrl&&(h=encodeURIComponent(c.sessionProgressName)+"="+encodeURIComponent(t),_["Content-Type"]="application/x-www-form-urlencoded"),c.nginxProgressUrl&&(_[c.nginxProgressHeader]=t),_["X-Requested-With"]="XMLHttpRequest",_.Accept="application/json, text/javascript, */*; q=0.01",n.extendObj(_,c.customProgressHeaders),_)_.hasOwnProperty(m)&&(c.encodeHeaders?a.setRequestHeader(m,n.encodeUTF8(_[m]+"")):a.setRequestHeader(m,_[m]+""));a.send(c.sessionProgressUrl&&h||null)}},_initUpload:function(e){if(!1===this._opts.startNonXHR.call(this,e.name,e.btn))return this._disabled&&this.enable(!0),void this._active--;this._hasProgUrl=!!(this._opts.progressUrl||this._opts.sessionProgressUrl||this._opts.nginxProgressUrl),this._uploadIframe(e,this._progBox,this._sizeBox,this._progBar,this._pctBox,this._abortBtn,this._removeAbort),e=this._progBox=this._sizeBox=this._progBar=this._pctBox=this._abortBtn=this._removeAbort=null}},n.XhrUpload={_addFiles:function(e){var t,s,i,o,r=e.length;for(this._opts.multiple||(r=1),o=0;o<r;o++){if(t=n.getFilename(e[o].name),s=n.getExt(t),i=Math.round(e[o].size/1024),!1===this._opts.onChange.call(this,t,s,this._overBtn,i,e[o]))return!1;this._queue.push({id:n.getUID(),file:e[o],name:t,ext:s,btn:this._overBtn,size:i})}return!0},_uploadXhr:function(e,t,s,i,o,r,a,u,l,d){"use strict";var c,p,h=this,f=this._opts,_=n.newXHR();for(var m in o&&(o.innerHTML=e.size+"K"),u&&(u.innerHTML="0%"),r&&(r.style.width="0%"),c=function(t,s){var i;try{if(c&&(s||4===_.readyState))if(c=void 0,_.onreadystatechange=function(){},s)4!==_.readyState&&_.abort(),f.onAbort.call(h,e.name,e.btn,e.size),h._last(o,a,u,l,d);else{l&&n.removeEvent(l,"click",p);try{i=_.statusText}catch(e){i=""}_.status>=200&&_.status<300?(f.endXHR.call(h,e.name,e.size,e.btn),h._finish(e,_.status,i,_.responseText,o,a,u,l,d)):h._errorFinish(e,_.status,i,_.responseText,"error",a,o,u,l,d)}}catch(t){s||h._errorFinish(e,-1,t.message,!1,"error",a,o,u,l,d)}},l&&(p=function(){n.removeEvent(l,"click",p),c&&c(void 0,!0)},n.addEvent(l,"click",p)),_.onreadystatechange=c,_.open(f.method.toUpperCase(),t,!0),_.withCredentials=!!f.withCredentials,n.extendObj(i,f.customHeaders),i)i.hasOwnProperty(m)&&(f.encodeHeaders?_.setRequestHeader(m,n.encodeUTF8(i[m]+"")):_.setRequestHeader(m,i[m]+""));if(n.addEvent(_.upload,"progress",function(e){if(e.lengthComputable){var t=Math.round(e.loaded/e.total*100);f.onProgress.call(h,t),u&&(u.innerHTML=t+"%"),r&&(r.style.width=t+"%")}}),f.onProgress.call(this,0),!0===f.multipart){var g=new FormData,v=!1;for(var b in s)s.hasOwnProperty(b)&&(b!==f.name||!0!==f.noParams||h._form||(v=!0),g.append(b,s[b]));v||g.append(f.name,e.file),this.log("Commencing upload using multipart form"),_.send(g)}else this.log("Commencing upload using binary stream"),_.send(e.file);this.removeCurrent(e.id)},_initUpload:function(e){"use strict";var t,s={},i={};if(!1===this._opts.startXHR.call(this,e.name,e.size,e.btn))return this._disabled&&this.enable(!0),void this._active--;i["X-Requested-With"]="XMLHttpRequest",i["X-File-Name"]=e.name,"json"==this._opts.responseType.toLowerCase()&&(i.Accept="application/json, text/javascript, */*; q=0.01"),this._opts.multipart||(i["Content-Type"]="application/octet-stream"),this._form&&n.extendObj(s,n.getFormObj(this._form)),n.extendObj(s,this._opts.data),t=!0===this._opts.noParams?this._opts.url:this._opts.url+(this._opts.url.indexOf("?")>-1?"&":"?")+n.obj2string(s),this._uploadXhr(e,t,s,i,this._sizeBox,this._progBar,this._progBox,this._pctBox,this._abortBtn,this._removeAbort),this._sizeBox=this._progBar=this._progBox=this._pctBox=this._abortBtn=this._removeAbort=null}},n.DragAndDrop={_dragFileCheck:function(e){if(e.dataTransfer.types)for(var t=0;t<e.dataTransfer.types.length;t++)if("Files"==e.dataTransfer.types[t])return!0;return!1},addDropZone:function(e){var t=this,s=[];n.addStyles(e,{zIndex:16777271}),e.ondragenter=function(e){return e.stopPropagation(),e.preventDefault(),!!t._dragFileCheck(e)&&(0===s.length&&n.addClass(this,t._opts.dragClass),-1===n.indexOf(s,e.target)&&s.push(e.target),!1)},e.ondragover=function(e){return e.stopPropagation(),e.preventDefault(),t._dragFileCheck(e)&&(e.dataTransfer.dropEffect="copy"),!1},e.ondragend=function(){return n.removeClass(this,t._opts.dragClass),!1},e.ondragleave=function(e){return n.arrayDelete(s,e.target),0===s.length&&n.removeClass(this,t._opts.dragClass),!1},e.ondrop=function(e){e.stopPropagation(),e.preventDefault(),n.arrayDelete(s,e.target),0===s.length&&n.removeClass(this,t._opts.dragClass),t._dragFileCheck(e)&&!1!==t._addFiles(e.dataTransfer.files)&&t._cycleQueue()}}},n.extendObj(n.SimpleUpload.prototype,{_createInput:function(){"use strict";var e=this,s=document.createElement("div");this._input=document.createElement("input"),this._input.type="file",this._input.name=this._opts.name,t&&!l&&this._opts.multiple&&(this._input.multiple=!0),"accept"in this._input&&""!==this._opts.accept&&(this._input.accept=this._opts.accept),n.addStyles(s,{display:"block",position:"absolute",overflow:"hidden",margin:0,padding:0,opacity:0,direction:"ltr",zIndex:16777270}),"0"!==s.style.opacity&&(s.style.filter="alpha(opacity=0)"),n.addStyles(this._input,{position:"absolute",right:0,margin:0,padding:0,fontSize:"480px",fontFamily:"sans-serif",cursor:"pointer",height:"100%",zIndex:16777270}),this._input.turnOff=n.addEvent(this._input,"change",function(){e._input&&""!==e._input.value&&!1!==e._addFiles(t?e._input.files:e._input)&&(n.removeClass(e._overBtn,e._opts.hoverClass),n.removeClass(e._overBtn,e._opts.focusClass),e._killInput(),e._createInput(),e._opts.autoSubmit&&e.submit())}),""!==e._opts.hoverClass&&(s.mouseOverOff=n.addEvent(s,"mouseover",function(){n.addClass(e._overBtn,e._opts.hoverClass)})),s.mouseOutOff=n.addEvent(s,"mouseout",function(){e._input.parentNode.style.visibility="hidden",""!==e._opts.hoverClass&&(n.removeClass(e._overBtn,e._opts.hoverClass),n.removeClass(e._overBtn,e._opts.focusClass))}),""!==e._opts.focusClass&&(this._input.focusOff=n.addEvent(this._input,"focus",function(){n.addClass(e._overBtn,e._opts.focusClass)}),this._input.blurOff=n.addEvent(this._input,"blur",function(){n.removeClass(e._overBtn,e._opts.focusClass)})),s.appendChild(this._input),document.body.appendChild(s),s=null},_last:function(e,t,s,i,o){"use strict";if(e&&(e.innerHTML=""),s&&(s.innerHTML=""),i&&o&&n.remove(i),t&&n.remove(t),this._active--,e=t=s=i=o=null,this._disabled&&this.enable(!0),this._destroy&&0===this._queue.length&&0===this._active)for(var r in this)this.hasOwnProperty(r)&&delete this[r];else this._cycleQueue()},_errorFinish:function(e,t,n,s,i,o,r,a,u,l){"use strict";this.log("Upload failed: "+t+" "+n),this._opts.onError.call(this,e.name,i,t,n,s,e.btn,e.size),this._last(r,o,a,u,l),e=t=n=s=i=r=o=a=u=l=null},_finish:function(e,t,s,i,o,r,a,u,l){"use strict";this.log("Server response: "+i),"json"!=this._opts.responseType.toLowerCase()||!1!==(i=n.parseJSON(i))?(this._opts.onComplete.call(this,e.name,i,e.btn,e.size),this._last(o,r,a,u,l),e=t=s=i=o=r=a=u=l=null):this._errorFinish(e,t,s,!1,"parseerror",r,o,u,l)},_checkFile:function(e){"use strict";var t=!1,n=this._opts.allowedExtensions.length;if(n>0){for(;n--;)if(this._opts.allowedExtensions[n].toLowerCase()==e.ext.toLowerCase()){t=!0;break}if(!t)return this.removeCurrent(e.id),this.log("File extension not permitted"),this._opts.onExtError.call(this,e.name,e.ext),!1}return e.size&&!1!==this._opts.maxSize&&e.size>this._opts.maxSize?(this.removeCurrent(e.id),this.log(e.name+" exceeds "+this._opts.maxSize+"K limit"),this._opts.onSizeError.call(this,e.name,e.size),!1):(e=null,!0)},_killInput:function(){"use strict";this._input&&(this._input.turnOff&&this._input.turnOff(),this._input.focusOff&&this._input.focusOff(),this._input.blurOff&&this._input.blurOff(),this._input.parentNode.mouseOverOff&&this._input.parentNode.mouseOverOff(),n.remove(this._input.parentNode),delete this._input,this._input=null)},_cycleQueue:function(){"use strict";this._queue.length>0&&this._opts.autoSubmit&&this.submit(void 0,!0)},_validateForm:function(){"use strict";return!(this._form.checkValidity&&!this._form.checkValidity())}}),t?n.extendObj(n.SimpleUpload.prototype,n.XhrUpload):n.extendObj(n.SimpleUpload.prototype,n.IframeUpload),n.extendObj(n.SimpleUpload.prototype,n.DragAndDrop),n},void 0===(s=function(){return o(i)}.call(t,n,t,e))||(e.exports=s)}});