/*!CK:4078526582!*//*1408968545,*/

if (self.CavalryLogger) { CavalryLogger.start_js(["FPP3w"]); }

__d("TypeaheadMetricReporter",["AsyncRequest","TypeaheadMetricCounter","mixInEventEmitter","copyProperties"],function(a,b,c,d,e,f,g,h,i,j){var k='/ajax/typeahead/record_basic_metrics.php';function l(m){"use strict";this.counter=new h();this.extraData=m;this.bootstrapped=null;this.bootstrapBegin=null;this.lastQuery=null;this.$TypeaheadMetricReporter0();}l.prototype.sessionStart=function(){"use strict";this.sessionActive=true;};l.prototype.sessionEnd=function(){"use strict";if(this.sessionActive){this.$TypeaheadMetricReporter1();this.$TypeaheadMetricReporter0();this.sessionActive=false;}};l.prototype.reportSelect=function(m,n,o,p,q){"use strict";q=q==null?this.lastQuery:q;this.counter.recordStat('selected_id',m||'SELECT_NULL');this.counter.recordStat('selected_type',n);this.counter.recordStat('selected_position',o);this.counter.recordStat('selected_with_mouse',p?1:0);this.counter.recordStat('selected_query',q);};l.prototype.reportBootstrapBegin=function(){"use strict";this.bootstrapBegin=Date.now();};l.prototype.reportBootstrapDirty=function(){"use strict";this.bootstrapped=false;};l.prototype.reportBootstrapComplete=function(m){"use strict";this.counter.recordAvgStat('bootstrap_latency',Date.now()-this.bootstrapBegin);var n={};m.forEach(function(o){n[o]=(n[o]||0)+1;});this.counter.recordStat('bootstrap_response_types',n);this.bootstrapped=true;};l.prototype.reportQueryBegin=function(m){"use strict";this.counter.recordStat('query',m);this.counter.recordCountStat('num_queries');this.lastQuery=m;};l.prototype.reportQueryComplete=function(m,n){"use strict";this.counter.recordAvgStat('avg_query_latency',m);if(typeof n!='undefined')this.counter.recordStat('filtered_count',n);};l.prototype.reportResults=function(m){"use strict";this.results=m;};l.prototype.$TypeaheadMetricReporter0=function(){"use strict";this.sid=Math.floor(Date.now()*Math.random());this.results=null;this.counter.reset();this.emit('reset',{sid:this.sid});};l.prototype.$TypeaheadMetricReporter2=function(){"use strict";var m={};for(var n in this.extraData){var o=this.extraData[n];m[n]=typeof o==='function'?o():o;}return m;};l.prototype.$TypeaheadMetricReporter1=function(){"use strict";if(this.counter.hasStats()){if(this.results)this.counter.recordStat('candidate_results',JSON.stringify(this.results));if(this.sid)this.counter.recordStat('sid',this.sid);if(this.bootstrapped)this.counter.recordStat('bootstrapped',1);var m=j(this.counter.getStats(),this.$TypeaheadMetricReporter2());new g().setURI(k).setMethod('POST').setData({stats:m}).send();this.emit('submitted',m);}};i(l,{reset:true,submitted:true});e.exports=l;},null);