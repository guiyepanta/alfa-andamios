/*!CK:4028964326!*//*1410145024,*/

if (self.CavalryLogger) { CavalryLogger.start_js(["mXeYe"]); }

__d("PhotosUploadWaterfallErrorCodes",[],function(a,b,c,d,e,f){e.exports={SECURITY:1,FILE_IO:2,IMAGE_IO:3,UPLOAD_IO:4,INVALID_SERVER_RESULT:5,RESIZE_FAILURE:6,ENCODE_FAILURE:7,INVALID_DOMAIN:8,BAD_JPEG_MARKERS:9,BAD_SERVER_RESPONSE:10,EXTERNAL_INTERFACE_UNAVAILABLE:11,JS_CALL_FAILED:12,UNCAUGHT_ERROR:13,UPLOAD_SWF_FAILED_LOAD:14,FILE_IO_TIMEOUT:15,IMAGE_SECURITY:16,BAD_IMAGE_FILE:17,IMAGE_IO_TIMEOUT:18,BLACK_PHOTO:19,EMPTY_FILE_LOADED:20,FILE_READ_DISABLED:21,BAD_NETWORK:22,FLASH_LOAD_TIMEOUT:23,FLASH_LOAD_FAILURE:24,FLASH_UPGRADE_REQUIRED:25};},null);
__d("ImageResizer",["ArbiterMixin","BlobFactory","DOM","UserAgent_DEPRECATED","copyProperties"],function(a,b,c,d,e,f,g,h,i,j,k){var l=function(m,n,o,p,q){this._input=m;this._image=null;this._canvas=null;this._rotation=0;this._maxWidth=n;this._maxHeight=o;this._outputMime=p||'image/jpeg';this._outputQuality=(q===undefined)?.87:q;};l.isSupported=function(){if(window.File&&window.FileReader){var m=i.create('canvas');if(m.toBlob||(m.toDataURL&&window.ArrayBuffer&&window.Uint8Array&&h.isSupported()))return true;}return false;};k(l.prototype,g);k(l.prototype,{setOrientation:function(m){this._rotation={1:0,3:180,6:90,8:270}[m]||0;},resize:function(){if(this._input instanceof HTMLCanvasElement||this._input instanceof HTMLImageElement){this._image=this._input;this._handleImage();}else if(typeof this._input=="string"){this._loadImage(this._input);}else if(this._input instanceof window.File)this._loadFile(this._input);},_rotatedToSide:function(){return (this._rotation%180)==90;},_prepareError:function(m){return (function(){this.inform.bind(this,"error",m);}.bind(this));},_loadFile:function(m){this._fileLoadTime=Date.now();var n=new FileReader();n.onload=this._handleFile.bind(this);n.onerror=this._prepareError("Could not read tile.");n.readAsDataURL(m);},_handleFile:function(event){this._fileLoadTime=Date.now()-this._fileLoadTime;var m=event.target.result;this._loadImage(m);},_loadImage:function(m){this._imageLoadTime=Date.now();this._image=i.create('img');this._image.onload=this._handleImage.bind(this);this._image.onerror=this._prepareError("Could not load image.");this._image.src=m;},_handleImage:function(){if(this._imageLoadTime)this._imageLoadTime=Date.now()-this._imageLoadTime;if(this._input instanceof window.File){var m=this._calculateRatio();if(m>=1){this._skippedResizing=true;return this._handleBlob(this._input);}}this._skippedResizing=false;this._drawTransformed();this._extractBlob();},_drawTransformed:function(){var m=Date.now(),n=this._calculateRatio(),o=0;if(j.chrome())if(n<.25){o=2;}else if(n<.5)o=1;var p=this._drawResizedCanvas(this._image,n*Math.pow(2,o));for(var q=0;q<o;q++)p=this._drawResizedCanvas(p,.5);if(this._rotation)p=this._drawRotatedCanvas(p);this._canvas=p;this._drawTime=Date.now()-m;},_drawResizedCanvas:function(m,n){var o=i.create('canvas');o.width=m.width*n;o.height=m.height*n;var p=o.getContext("2d");p.scale(n,n);p.drawImage(m,0,0);return o;},_drawRotatedCanvas:function(m){var n=i.create('canvas');if(this._rotatedToSide()){n.width=m.height;n.height=m.width;}else{n.width=m.width;n.height=m.height;}var o=n.getContext("2d");o.translate(n.width*.5,n.height*.5);o.rotate(Math.PI*(this._rotation/180));o.translate(m.width*-.5,m.height*-.5);o.drawImage(m,0,0,m.width,m.height);return n;},_calculateRatio:function(){var m=1,n=this._rotatedToSide()?this._maxHeight:this._maxWidth,o=this._rotatedToSide()?this._maxWidth:this._maxHeight,p=n/this._image.width,q=o/this._image.height;if(p<m&&p>0)m=p;if(q<m&&q>0)m=q;return m;},_extractBlob:function(){this._extractionStart=Date.now();if(this._canvas.toBlob){this._canvas.toBlob(this._handleBlob.bind(this),this._outputMime,this._outputQuality);return;}var m=this._canvas.toDataURL(this._outputMime,this._outputQuality),n=m.match(/^data:(.*?);base64,/);if(!n){this._prepareError("Couldn't get base64 encoded data from canvas.")();return;}var o=n[1],p=m.substr(n[0].length),q=window.atob(p),r=new ArrayBuffer(q.length),s=new Uint8Array(r);for(var t=0;t<q.length;t++)s[t]=q.charCodeAt(t);var u=h.getBlob([r],{type:o});this._handleBlob(u);},_handleBlob:function(m){this._canvas=this._canvas||i.create('canvas');m.performanceData={blockingDraw:+true,blockingExtraction:+!this._canvas.toBlob,imageLoadTime:this._imageLoadTime,fileLoadTime:this._fileLoadTime,skippedResizing:+this._skippedResizing};if(!this._skippedResizing)k(m.performanceData,{extractionTime:Date.now()-this._extractionStart,drawTime:this._drawTime});this.inform('resized',m);}});e.exports=l;},null);
__d("PhotosUploadWaterfallMixin",["PhotosUploadWaterfall","copyProperties","emptyFunction"],function(a,b,c,d,e,f,g,h,i){var j=i,k={getUploaderApp:j,getWaterfallID:j,logWaterfallStep:function(l,m,n){g.sendSignal(h({qn:this.getWaterfallID(),uploader:this.getUploaderApp(),step:l,ref:this.getWaterfallSource&&this.getWaterfallSource()},m),n);},logWaterfallStepUsingBanzai:function(l,m,n){g.sendBanzai(h({qn:this.getWaterfallID(),uploader:this.getUploaderApp(),step:l,ref:this.getWaterfallSource&&this.getWaterfallSource()},m),n);}};e.exports=k;},null);
__d("FilePickerEvent",[],function(a,b,c,d,e,f){e.exports={BEGIN:'FilePickerEvent/BEGIN',SELECT_START:'FilePickerEvent/SELECT_START',SELECTED:'FilePickerEvent/SELECTED_FILES',ALBUM_LIMIT_EXCEEDED:'FilePickerEvent/ALBUM_LIMIT_EXCEEDED',SESSION_LIMIT_EXCEEDED:'FilePickerEvent/SESSION_LIMIT_EXCEEDED',SELECT_CANCELED:'FilePickerEvent/SELECT_CANCELED',FALLBACK:'FilePickerEvent/FALLBACK'};},null);
__d("FlashArbiterEvents",["Arbiter","Run"],function(a,b,c,d,e,f,g,h){function i(j){"use strict";this._flashID=j;this._subscriptions=[];h.onLeave(this.unsubscribeAll.bind(this));}i.prototype.subscribe=function(j,k){"use strict";var l=this._flashID;this._subscriptions.push(g.subscribe(j,function(m,n){if(l===n.divID)k(n);}));return this;};i.prototype.unsubscribeAll=function(){"use strict";while(this._subscriptions.length)g.unsubscribe(this._subscriptions.pop());};e.exports=i;},null);
__d("compareFlashVersions",[],function(a,b,c,d,e,f){function g(i){return i.replace(/\d+/g,function(j){return '000'.substring(j.length)+j;});}function h(i,j){i=g(i);j=g(j);if(i>j){return 1;}else if(i<j)return -1;return 0;}e.exports=h;},null);
__d("FlashLoadEvent",[],function(a,b,c,d,e,f){e.exports={READY:'flash/ready',FAILED:'flash/failed',MOUSE_CANCELED:'UploadEvent/SELECT_CANCELED',MOUSE_DOWN:'UploadEvent/SELECT_DOWN',MOUSE_OUT:'UploadEvent/SELECT_OUT',MOUSE_OVER:'UploadEvent/SELECT_OVER',MOUSE_UP:'UploadEvent/SELECT_UP',ERROR_FLASH_LOAD_TIMEOUT:1,ERROR_FLASH_LOAD_FAILURE:2,ERROR_FLASH_UPGRADE_REQUIRED:3};},null);
__d("UploadEvent",[],function(a,b,c,d,e,f){var g={UPLOAD_START:'UploadEvent/UPLOAD_START',UPLOAD_HIRES_RESTART:'UploadEvent/UPLOAD_HIRES_RESTART',START:'UploadEvent/START',DONE:'UploadEvent/DONE',ERROR:'UploadEvent/ERROR',FINISHED_UPLOADING:'UploadEvent/FINISHED_UPLOADING',LOADED:'UploadEvent/LOADED',READY:'UploadEvent/READY',UPLOAD_FAILED:'UploadEvent/UPLOAD_FAILED',UPLOAD_PROGRESS:'UploadEvent/UPLOAD_PROGRESS',COMPRESS_PROGRESS:'UploadEvent/COMPRESS_PROGRESS',HI_RES_ATTACH_START:'UploadEvent/HI_RES_ATTACH_START',IMAGE_COMPRESS_ERROR:'UploadEvent/IMAGE_COMPRESS_ERROR',IMAGE_COMPRESS_BEGIN:'UploadEvent/IMAGE_COMPRESS_BEGIN',IMAGE_COMPRESSED:'UploadEvent/IMAGE_COMPRESSED',IMAGE_UPLOAD_ERROR:'UploadEvent/IMAGE_UPLOAD_ERROR',IMAGE_UPLOADED:'UploadEvent/IMAGE_UPLOADED',SELECT_START:'UploadEvent/SELECT_START',SELECT_CANCELED:'UploadEvent/SELECT_CANCELED',IMAGES_SELECTED:'UploadEvent/IMAGES_SELECTED',HEARTBEAT:'UploadEvent/HEARTBEAT',CANCELED_PROCESSING_PHOTO:'UploadEvent/CANCELED_PROCESSING_PHOTO',CANCELED_PHOTO_UPLOADED_ANYWAY:'UploadEvent/CANCELED_PHOTO_UPLOADED_ANYWAY'};e.exports=g;},null);
__d("FlashFilePicker",["Arbiter","ArbiterMixin","AsyncUploadBase","compareFlashVersions","ImageResizer","CSS","FilePickerEvent","Flash","FlashArbiterEvents","FlashLoadEvent","FlashUploaderConfig","HTML","Parent","PhotosUploadWaterfall","PhotosUploadWaterfallErrorCodes","PhotosUploadWaterfallMixin","PhotosUploadWaterfallXMixin","PUWApplications","UploadEvent","URI","PUWSteps","copyProperties","$"],function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,aa,ba,ca){function da(ha){for(var ia=0;ia<ha.length;++ia)if(n.checkMinVersion(ha[ia].toString()))return true;return false;}function ea(ha){var ia=s.byClass(ha,'addPhotosDisabled');if(ia){l.removeClass(ia,'addPhotosDisabled');l.addClass(ia,'addPhotosEnabled');}}function fa(ha,ia){ia.style.width=ha.offsetWidth+'px';ia.style.height=ha.offsetHeight+'px';}function ga(ha,ia,ja){this._swfID=ha;this._button=ia;this._waterfallID=ja.qn;this._ref=ja.ref;this._beginInformed=false;this._isReady=false;this._fallbackHref=ja.fallbackHref;if(!da(q.flashVersionInfo.minimumVersion)){this.logWaterfallStep(t.UPGRADE_REQUIRED);this._flashError(u.FLASH_UPGRADE_REQUIRED||25);return;}if(ja.flashObjectsPerVersion)this._constructAndAppendFlashObject(ja.flashObjectsPerVersion);this._flashEvents=new o(this._swfID).subscribe(p.READY,this._handleReady.bind(this)).subscribe(p.FAILED,this._handleFailed.bind(this)).subscribe(p.MOUSE_OVER,this._handleMouseIn.bind(this)).subscribe(p.MOUSE_OUT,this._handleMouseOut.bind(this)).subscribe(y.SELECT_START||'UploadEvent/SELECT_START',this._handleSelectStart.bind(this)).subscribe(y.IMAGES_SELECTED,this._handleSelected.bind(this)).subscribe(y.SELECT_CANCELED,this._handleCancelSelected.bind(this));this._timeout=setTimeout(function(){if(!this._isReady)this._flashError(u.FLASH_LOAD_TIMEOUT||23);}.bind(this),q.flashLoadTimeout);ja.logDetailed&&this.logDetailed();}ba(ga.prototype,h,v,w,{_constructAndAppendFlashObject:function(ha){var ia=ha['default'];delete ha['default'];var ja=Object.keys(ha).sort(function(oa,pa){return j(pa,oa);}),ka=ia;for(var la=0;la<ja.length;la++){var ma=ja[la];if(n.checkMinVersion(ma)){ka=ha[ma];break;}}var na=r.replaceJSONWrapper(ka).getRootNode();this._button.parentNode.appendChild(na);},getUploaderApp:function(){return t.APP_FLASH;},getWaterfallID:function(){return this._waterfallID;},getWaterfallAppName:function(){return x.WEB_FLASH;},getWaterfallSource:function(){return this._ref;},logDetailed:function(){this.logWaterfallStep(t.VERSION,{version:n.getVersion().join('.')});if(i.isSupported()){this.logWaterfallStep(t.ASYNC_AVAILABLE);if(k.isSupported()){this.logWaterfallStep(t.RESIZER_AVAILABLE);}else this.logStep(aa.CLIENT_PROCESS_UNAVAILABLE,{error:'no_resizer'});}else this.logStep(aa.CLIENT_PROCESS_UNAVAILABLE,{error:'no_async_upload'});},_handleReady:function(ha){setTimeout(function(){return fa(this._button,ca(this._swfID));}.bind(this));ea(this._button);this._isReady=true;clearTimeout(this._timeout);g.inform(y.READY,{divID:this._swfID},g.BEHAVIOR_PERSISTENT);},_handleFailed:function(ha){this._flashError(u.FLASH_LOAD_FAILURE||24);},_flashError:function(ha){if(this._fallbackHref){var ia=z(this._fallbackHref).addQueryData({error:ha}).toString();this._button.removeAttribute('rel');this._button.removeAttribute('ajaxify');this._button.setAttribute('href',ia);ea(this._button);}this.logWaterfallStep(t.CLIENT_ERROR,{code:ha,scuba_tags:{fallback_simple:true}});this.logStep(aa.CLIENT_FLOW_FATAL,{error_code:ha,fallback_simple:true});},_handleMouseIn:function(ha){l.addClass(this._button,'selectOver');},_handleMouseOut:function(ha){l.removeClass(this._button,'selectOver');},_handleSelectStart:function(ha){if(!this._beginInformed){this._beginInformed=true;this.inform(m.BEGIN||'FilePickerEvent/BEGIN');}this.inform(m.SELECT_START);},_handleSelected:function(ha){var ia;if(ha.files){ia=ha.files;}else{ia=[{uploadID:ha.divID+'.'}];ia.length=ha.count;}this.inform(m.SELECTED,{sender:this,files:ia},g.BEHAVIOR_PERSISTENT);if(ha.albumLimitExceeded)this.inform(m.ALBUM_LIMIT_EXCEEDED,{},g.BEHAVIOR_PERSISTENT);if(ha.sessionLimitExceeded)this.inform(m.SESSION_LIMIT_EXCEEDED,{},g.BEHAVIOR_PERSISTENT);},_handleCancelSelected:function(ha){this.inform(m.SELECT_CANCELED);}});e.exports=ga;},null);
__d("UploadSession",["AsyncRequest","FilePickerEvent","PhotosUploadWaterfall","PUWSteps","URI","arrayContains"],function(a,b,c,d,e,f,g,h,i,j,k,l){var m={};function n(p){"use strict";this._sessionID=p;this._asyncBootstrapped=false;this._controller=null;this._overlay=null;this._pickers=[];this._pendingFileLists=[];this._beginLogged=false;this._albumLimitWasExceeded=false;this._sessionLimitWasExceeded=false;}n.prototype.addFilePicker=function(p){"use strict";if(!l(this._pickers,p)){this._pickers.push(p);p.subscribe(h.BEGIN,function(q,r){if(!this._beginLogged){this._beginLogged=true;p.logWaterfallStep(i.BEGIN);p.logStep(j.CLIENT_FLOW_BEGIN);}}.bind(this));p.subscribe(h.SELECTED,function(q,r){p.logStep(j.CLIENT_SELECT_SUCCESS,{volume:r.files.length});if(this._controller){this._controller.uploadFiles(r.files);}else this._pendingFileLists.push(r);if(this._asyncBootstrapped)return;var s=p._button,t=new k(s.getAttribute('ajaxify'));t.addQueryData('num_selected',r.files.length);g.bootstrap(t.toString(),s,true);this._asyncBootstrapped=true;}.bind(this));p.subscribe(h.SELECT_START,function(){p.logStep(j.CLIENT_SELECT_BEGIN);}.bind(this));p.subscribe(h.SELECT_CANCELED,function(){p.logStep(j.CLIENT_SELECT_CANCEL);if(!this._overlay){p.logStep(j.CLIENT_FLOW_CANCEL);this._beginLogged=false;}}.bind(this));p.subscribe(h.ALBUM_LIMIT_EXCEEDED,function(){if(this._controller){this._controller.albumLimitExceeded();}else this._albumLimitWasExceeded=true;}.bind(this));p.subscribe(h.SESSION_LIMIT_EXCEEDED,function(){if(this._controller){this._controller.sessionLimitExceeded();}else this._sessionLimitWasExceeded=true;}.bind(this));}};n.prototype.addController=function(p){"use strict";this._controller=p;this._asyncBootstrapped=true;var q=(this._controller.getWaterfallID)?this._controller.getWaterfallID():this._controller.getWaterfallConfig().waterfallID,r=(this._controller.getUploaderApp)?this._controller.getUploaderApp():this._controller.getWaterfallConfig().waterfallApp;if(!this._beginLogged){this._beginLogged=true;i.sendSignal({qn:q,step:i.BEGIN,uploader:r});}if(this._pendingFileLists.length){var s=[];this._pendingFileLists.forEach(function(t){s=s.concat(t.files);});this._controller.uploadFiles(s);}else i.sendSignal({qn:q,step:i.OVERLAY_FIRST,uploader:r});if(this._albumLimitWasExceeded)this._controller.albumLimitExceeded();if(this._sessionLimitWasExceeded)this._controller.sessionLimitExceeded();};n.prototype.addOverlay=function(p){"use strict";this._overlay=p;};n.prototype.addOverlayAndController=function(p,q){"use strict";this.addOverlay(p);this.addController(q);};n.addFilePickerToSession=function(p,q){"use strict";o(p).addFilePicker(q);};n.addControllerToSession=function(p,q){"use strict";o(p).addController(q);};n.addOverlayToSession=function(p,q){"use strict";o(p).addOverlay(q);};n.addOverlayAndControllerToSession=function(p,q,r){"use strict";o(p).addOverlayAndController(q,r);};function o(p){if(!m[p])m[p]=new n(p);return m[p];}e.exports=n;},null);