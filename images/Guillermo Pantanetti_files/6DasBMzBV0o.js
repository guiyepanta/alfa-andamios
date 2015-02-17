/*!CK:822811379!*//*1410146332,*/

if (self.CavalryLogger) { CavalryLogger.start_js(["hdwmL"]); }

__d("PUWApplications",[],function(a,b,c,d,e,f){e.exports={WEB_SIMPLE:"web_simple",WEB_FLASH:"web_flash",WEB_HTML5:"web_html5",WEB_COMPOSER:"web_composer",WEB_ARCHIVE:"web_archive",WEB_MESSENGER:"web_messenger",WEB_OMNIPICKER:"web_omnipicker",WEB_MUSE_OMNIPICKER:"web_muse_omnipicker",WEB_M_ZERO:"web_m_zero",WEB_M_BASIC:"web_m_basic",WEB_M_TOUCH:"web_m_touch",MOBILE_FB4IOS:"mobile_fb4ios",MOBILE_FB4IOS_SNAP:"mobile_fb4ios_snap",MOBILE_FB4A:"mobile_fb4a",MOBILE_PMA_ANDROID:"mobile_pma_android",MOBILE_PMA_IOS:"mobile_pma_ios",THIRD_PARTY:"third_party"};},null);
__d("PUWSteps",[],function(a,b,c,d,e,f){e.exports={CLIENT_FLOW_BEGIN:"client_flow_begin",CLIENT_SELECT_BEGIN:"client_select_begin",CLIENT_SELECT_SUCCESS:"client_select_success",CLIENT_SELECT_CANCEL:"client_select_cancel",CLIENT_SELECT_FAIL:"client_select_fail",CLIENT_FLOW_POST:"client_flow_post",CLIENT_TRANSFER_BATCH_BEGIN:"client_transfer_batch_begin",CLIENT_UPLOAD_BEGIN:"client_upload_begin",CLIENT_PROCESS_BEGIN:"client_process_begin",CLIENT_PROCESS_SUCCESS:"client_process_success",CLIENT_PROCESS_CANCEL:"client_process_cancel",CLIENT_PROCESS_SKIP:"client_process_skip",CLIENT_PROCESS_FAIL:"client_process_fail",CLIENT_PROCESS_UNAVAILABLE:"client_process_unavailable",CLIENT_TRANSFER_ENQUEUE:"client_transfer_enqueue",CLIENT_TRANSFER_BEGIN:"client_transfer_begin",CLIENT_TRANSFER_SUCCESS:"client_transfer_success",CLIENT_TRANSFER_CANCEL:"client_transfer_cancel",CLIENT_TRANSFER_FAIL:"client_transfer_fail",CLIENT_UPLOAD_SUCCESS:"client_upload_success",CLIENT_UPLOAD_FAIL:"client_upload_fail",CLIENT_UPLOAD_CANCEL:"client_upload_cancel",CLIENT_UPLOAD_REMOVE:"client_upload_remove",CLIENT_FACEREC_BEGIN:"client_facerec_begin",CLIENT_FACEREC_SUCCESS:"client_facerec_success",CLIENT_FACEREC_FAIL:"client_facerec_fail",CLIENT_PHOTO_PREVIEW_OPEN:"client_photo_preview_open",CLIENT_PHOTO_PREVIEW_CLOSE:"client_photo_preview_close",CLIENT_TRANSFER_BATCH_SUCCESS:"client_transfer_batch_success",CLIENT_TRANSFER_BATCH_CANCEL:"client_transfer_batch_cancel",CLIENT_TRANSFER_BATCH_FAIL:"client_transfer_batch_fail",CLIENT_PUBLISH_ENQUEUE:"client_publish_enqueue",CLIENT_PUBLISH_BEGIN:"client_publish_begin",CLIENT_PUBLISH_SUCCESS:"client_publish_success",CLIENT_PUBLISH_FAIL:"client_publish_fail",CLIENT_ATTEMPT_FAIL:"client_attempt_fail",CLIENT_FLOW_SUCCESS:"client_flow_success",CLIENT_FLOW_FATAL:"client_flow_fatal",CLIENT_FLOW_GIVEUP:"client_flow_giveup",CLIENT_FLOW_CANCEL:"client_flow_cancel",CLIENT_FLOW_FAIL:"client_flow_fail",CLIENT_FLOW_INCOMPLETE:"client_flow_incomplete",CLIENT_ATTEMPT_INCOMPLETE:"client_attempt_incomplete",CLIENT_FLOW_RETRY:"client_flow_retry",CLIENT_ATTEMPT_RETRY:"client_attempt_retry",CLIENT_DIAGNOSTIC:"client_diagnostic",CLIENT_CANCEL_SURVEY:"client_cancel_survey",SERVER_UPLOAD_BEGIN:"server_upload_begin",SERVER_UPLOAD_SUCCESS:"server_upload_success",SERVER_UPLOAD_FAIL:"server_upload_fail",SERVER_PUBLISH_BEGIN:"server_publish_begin",SERVER_PUBLISH_SUCCESS:"server_publish_success",SERVER_PUBLISH_FAIL:"server_publish_fail",SERVER_RECEIVER_BEGIN:"server_receiver_begin",SERVER_RECEIVER_PUBLISH_BEGIN:"server_receiver_publish_begin"};},null);
__d("PhotosUploadWaterfallXMixin",["AsyncSignal","Banzai","PhotosUploadWaterfallXConfig","PUWApplications","copyProperties","invariant","randomInt"],function(a,b,c,d,e,f,g,h,i,j,k,l,m){function n(p,q){var r={};p.client_time=Math.round(Date.now()/1000);if(i.retryBanzai){r.retry=true;p.nonce=m(4294967296);}h.post(i.banzaiRoute,p,r);if(q)setTimeout(q,0);}function o(p,q){if(i.useBanzai){n(p,q);}else{var r=new g(i.loggingEndpoint,{data:JSON.stringify(p)}).setHandler(q);if(i.timeout)r.setTimeout(10*1000);r.send();}}e.exports={logStep:function(p,q,r){var s=this.getWaterfallID&&this.getWaterfallID(),t=this.getWaterfallAppName&&this.getWaterfallAppName();if(!s||!t)return;if(i.reduceLoggingRequests&&t===j.WEB_FLASH){r&&r();return;}o(k({step:p,qn:s,uploader:t,ref:this.getWaterfallSource&&this.getWaterfallSource()},q),r);}};},null);
__d("MercuryDataSources",[],function(a,b,c,d,e,f){var g={},h={add:function(i,j){g[i]=j;},get:function(i){!g[i];return g[i];}};e.exports=h;},null);
__d("MercuryLogger",["JSLogger","MercuryConfig","MercuryServerRequests","MercuryThreads"],function(a,b,c,d,e,f,g,h){var i=b('MercuryServerRequests').get(),j=b('MercuryThreads').get(),k=g.create('messaging_impressions');function l(event,p){k.log(event,p);}function m(p,q){var r=j.getThreadMetaNow(p);if(r){var s=i.getServerThreadIDNow(p);if(s){var event=q?'thread_search':'thread',t={is_single_thread:r.is_canonical_user,is_subscribed:r.is_subscribed,query:q||null};if(h.MercuryFBIDGK){t.thread_fbid=s;}else t.thread_id=s;l(event,t);}k.bump('opened_thread_'+r.folder);}}function n(p,q){var r={};q.forEach(function(s){var t=i.getServerThreadIDNow(s),u=j.getThreadMetaNow(s);if(u&&t){var v={is_single_thread:u.is_canonical_user,folder:u.folder,participants:u.participants,canonical_fbid:u.canonical_fbid};if(h.MercuryFBIDGK){v.thread_fbid=t;}else v.thread_id=t;r[t]=v;}});l('threadlist',{folder:p,threads:r});k.bump('opened_threadlist_'+p);}var o={logThread:function(p){m(p);},logThreadlist:function(p,q){n(p,q);},logThreadFromSearch:function(p,q){m(q,p);},logThreadlistFromSearch:function(p,q){l('threadlist_search',{folder:q,query:p});}};e.exports=o;},null);
__d("FileInputUploader",["ArbiterMixin","DOM","DTSG","FileForm","Form","copyProperties","mixin","submitForm"],function(a,b,c,d,e,f,g,h,i,j,k,l,m,n){var o=m(g);for(var p in o)if(o.hasOwnProperty(p))r[p]=o[p];var q=o===null?null:o.prototype;r.prototype=Object.create(q);r.prototype.constructor=r;r.__superConstructor__=o;function r(s,t){"use strict";this._inputElem=s;this._form_container=t?t:document.body;this._data={};}r.prototype.setInput=function(s){"use strict";this._inputElem=s;return this;};r.prototype.setURI=function(s){"use strict";this._uri=s;return this;};r.prototype.setData=function(s){"use strict";this._data=s;return this;};r.prototype.setPreprocessHandler=function(s){"use strict";this._preprocessHandler=s;return this;};r.prototype.setNetworkErrorRetryLimit=function(s){"use strict";this._retryLimit=s;return this;};r.prototype.setFiles=function(s){"use strict";this._files=s;return this;};r.prototype.setAllowCrossOrigin=function(s){"use strict";this._allowCrossOrigin=!!s;return this;};r.prototype.setUploadInParallel=function(s){"use strict";this._uploadInParallel=!!s;return this;};r.prototype.setConcurrentLimit=function(s){"use strict";this._concurrentLimit=s;return this;};r.prototype.send=function(){"use strict";this._createForm();var s=this._inputElem.cloneNode(false);h.replace(this._inputElem,s);h.appendContent(this._formElem,this._inputElem);h.appendContent(this._form_container,this._formElem);n(this._formElem);h.replace(s,this._inputElem);this._cleanup();};r.prototype._onFileFormEvent=function(s,t){"use strict";this.inform(s,t);};r.prototype._createForm=function(){"use strict";this._formElem=h.create('form',{action:this._uri,method:'post'});this._fileForm=new j(this._formElem,null,{allowCrossOrigin:this._allowCrossOrigin,uploadInParallel:this._uploadInParallel,concurrentLimit:this._concurrentLimit,preprocessHandler:this._preprocessHandler,networkErrorRetryLimit:this._retryLimit});if(this._files)this._fileForm.setFiles(this._files);this._fileForm.subscribe(j.EVENTS,this._onFileFormEvent.bind(this));k.createHiddenInputs(l({fb_dtsg:i.getToken()},this._data),this._formElem);};r.prototype._cleanup=function(){"use strict";this._fileForm.destroy();this._fileForm=null;h.remove(this._formElem);this._formElem=null;};l(r.prototype,{_formElem:null,_fileForm:null,_uri:null,_files:null,_allowCrossOrigin:false,_uploadInParallel:false,_concurrentLimit:null});e.exports=r;},null);
__d("glyph",["ix"],function(a,b,c,d,e,f){e.exports=b('ix');},null);