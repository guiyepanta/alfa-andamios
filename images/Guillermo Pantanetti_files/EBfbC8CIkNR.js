/*!CK:2322672720!*//*1408935345,*/

if (self.CavalryLogger) { CavalryLogger.start_js(["z7lCs"]); }

__d("TypeaheadMetricCounter",["copyProperties"],function(a,b,c,d,e,f,g){function h(){"use strict";this.reset();}h.prototype.reset=function(){"use strict";this.stats={};this.avgStats={};};h.prototype.recordStat=function(i,j){"use strict";this.stats[i]=j;};h.prototype.recordCountStat=function(i){"use strict";var j=this.stats[i];this.stats[i]=j?j+1:1;};h.prototype.recordAvgStat=function(i,j){"use strict";if(this.avgStats[i]){this.avgStats[i][0]+=j;this.avgStats[i][1]+=1;}else this.avgStats[i]=[j,1];};h.prototype.hasStats=function(){"use strict";return !!Object.keys(this.stats).length;};h.prototype.getStats=function(){"use strict";var i=g({},this.stats);for(var j in this.avgStats){var k=this.avgStats[j];i[j]=k[0]/k[1];}return i;};e.exports=h;},null);