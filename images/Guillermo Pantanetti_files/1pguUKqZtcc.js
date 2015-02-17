/*!CK:685894744!*//*1410142455,*/

if (self.CavalryLogger) { CavalryLogger.start_js(["oJza4"]); }

__d("AbstractPopoverButton.react",["ReactPropTypes","React","URI","cloneWithProps","cx","joinClasses","merge"],function(a,b,c,d,e,f,g,h,i,j,k,l,m){var n=h.createClass({displayName:'AbstractPopoverButton',propTypes:{config:g.object.isRequired,haschevron:g.bool,maxwidth:g.number},getDefaultProps:function(){return {haschevron:true};},render:function(){var o=this.props.config,p={},q=o.defaultMaxWidth;if(typeof this.props.maxwidth!=='undefined')q=this.props.maxwidth;var r=null;if(q){var s=this.props.haschevron?q-o.chevronWidth:q;if(this.props.label)r={maxWidth:s+'px'};p.style=m(p.style,{maxWidth:q+'px'});}p.image=null;var t=null;if(this.props.image)t=j(this.props.image,{className:'mrs'});if(t||this.props.label)p.label=h.createElement(h.DOM.span,{className:"_55pe",style:r},t,this.props.label);if(this.props.haschevron)p.imageRight=o.chevron;p.className=l(o.button.props.className,"_2agf");p.href=i('#');return j(o.button,p);}});e.exports=n;},null);
__d("ReactSelectorUtils",["ReactChildren"],function(a,b,c,d,e,f,g){var h={processAndMutateMenuItems:function(i,j){var k;g.forEach(i,function(l){if(l){var m=l.props.value===j;l.props.selected=m;if(m)k=l;}});return k;}};e.exports=h;},null);
__d("PopoverMenuContextMinWidth",["CSS","Style","copyProperties","cx","shield"],function(a,b,c,d,e,f,g,h,i,j,k){function l(m){"use strict";this._popoverMenu=m;this._popover=m.getPopover();}l.prototype.enable=function(){"use strict";this._setMenuSubscription=this._popoverMenu.subscribe('setMenu',k(this._onSetMenu,this));};l.prototype.disable=function(){"use strict";this._setMenuSubscription.unsubscribe();this._setMenuSubscription=null;if(this._showSubscription){this._showSubscription.unsubscribe();this._showSubscription=null;}if(this._menuSubscription){this._menuSubscription.unsubscribe();this._menuSubscription=null;}};l.prototype._onSetMenu=function(){"use strict";this._menu=this._popoverMenu.getMenu();this._showSubscription=this._popover.subscribe('show',k(this._updateWidth,this));var m=this._updateWidth.bind(this);this._menuSubscription=this._menu.subscribe(['change','resize'],function(){setTimeout(m,0);});this._updateWidth();};l.prototype._updateWidth=function(){"use strict";var m=this._menu.getRoot(),n=this._popoverMenu.getTriggerElem(),o=n.offsetWidth;h.set(m,'min-width',o+'px');g.conditionClass(m,"_575s",o>=m.offsetWidth);};i(l.prototype,{_setMenuSubscription:null,_showSubscription:null,_menuSubscription:null});e.exports=l;},null);
__d("PopoverMenuOverlappingBorder",["CSS","DOM","Style","copyProperties","cx","shield"],function(a,b,c,d,e,f,g,h,i,j,k,l){function m(n){"use strict";this._popoverMenu=n;this._popover=n.getPopover();this._triggerElem=n.getTriggerElem();}m.prototype.enable=function(){"use strict";this._setMenuSubscription=this._popoverMenu.subscribe('setMenu',l(this._onSetMenu,this));};m.prototype.disable=function(){"use strict";this._popoverMenu.unsubscribe(this._setMenuSubscription);this._setMenuSubscription=null;this._removeBorderSubscriptions();this._removeShortBorder();};m.prototype._onSetMenu=function(){"use strict";this._removeBorderSubscriptions();this._menu=this._popoverMenu.getMenu();this._renderShortBorder(this._menu.getRoot());this._showSubscription=this._popover.subscribe('show',l(this._updateBorder,this));var n=this._updateBorder.bind(this);this._menuSubscription=this._menu.subscribe(['change','resize'],function(){setTimeout(n,0);});this._updateBorder();};m.prototype._updateBorder=function(){"use strict";var n=this._menu.getRoot(),o=this._triggerElem.offsetWidth,p=Math.max(n.offsetWidth-o,0);i.set(this._shortBorder,'width',p+'px');};m.prototype._renderShortBorder=function(n){"use strict";this._shortBorder=h.create('div',{className:"_54hx"});h.appendContent(n,this._shortBorder);g.addClass(n,"_54hy");};m.prototype._removeShortBorder=function(){"use strict";if(this._shortBorder){h.remove(this._shortBorder);this._shortBorder=null;g.removeClass(this._popoverMenu.getMenu().getRoot(),"_54hy");}};m.prototype._removeBorderSubscriptions=function(){"use strict";if(this._showSubscription){this._popover.unsubscribe(this._showSubscription);this._showSubscription=null;}if(this._menuSubscription){this._menu.unsubscribe(this._menuSubscription);this._menuSubscription=null;}};j(m.prototype,{_shortBorder:null,_setMenuSubscription:null,_showSubscription:null,_menuSubscription:null});e.exports=m;},null);
__d("AbstractSelector.react",["InlineBlock.react","React","PopoverMenu.react","ReactPropTypes","ReactSelectorUtils","ContextualLayerAutoFlip","PopoverMenuContextMinWidth","PopoverMenuOverlappingBorder","cloneWithProps","cx","invariant","joinClasses"],function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r){var s=h.createClass({displayName:'AbstractSelector',propTypes:{config:j.object.isRequired,alignh:j.oneOf(['left','center','right']),name:j.string,overlappingborder:j.bool,onChange:j.func,disabled:j.bool,maxheight:j.number},getInitialState:function(){return {value:(this.props.value!=null?this.props.value:this.props.defaultValue!=null?this.props.defaultValue:this.props.initialValue)};},setMenuValue:function(t){q(this.refs&&this.refs.popover);this._internalChange=true;this.refs.popover.getMenu().setValue(t);this._internalChange=false;},onChange:function(t,u){if(this._internalChange)return;if(this.props.value==null){this.setState({value:u.value});}else this.setMenuValue(this.props.value);if(this.props.onChange)this.props.onChange(u);},componentWillReceiveProps:function(t){if(t.value!=null)this.setState({value:t.value});},render:function(){var t=this.props.config,u=o(t.menu,{children:this.props.children,className:r("_575t",t.menu.props.className),maxheight:this.props.maxheight,onChange:this.onChange}),v=k.processAndMutateMenuItems(this.props.children,this.state.value),w={label:v.props.label||v.props.children,disabled:this.props.disabled};if(v.props.icon)w.image=o(v.props.icon,{});var x=o(t.button,w),y=[l];if(t.layerBehaviors)y=y.concat(t.layerBehaviors);var z=[m];if(this.props.overlappingborder)z.push(n);return (h.createElement(g,Object.assign({},this.props,{alignv:"middle",name:null}),h.createElement(i,{ref:"popover",menu:u,alignh:this.props.alignh,layerBehaviors:y,behaviors:z,disabled:this.props.disabled},x),h.createElement(h.DOM.input,{type:"hidden",name:this.props.name,value:this.state.value})));},showMenu:function(){q(this.refs&&this.refs.popover);this.refs.popover.showPopover();}});e.exports=s;},null);
__d("XUIPopoverButton.react",["AbstractPopoverButton.react","Image.react","React","XUIButton.react","cx","ix","joinClasses"],function(a,b,c,d,e,f,g,h,i,j,k,l,m){var n=i.PropTypes,o=i.createClass({displayName:'ReactXUIPopoverButton',propTypes:{haschevron:n.bool,maxwidth:n.number},statics:{getButtonSize:function(p){return p.size||'medium';}},render:function(){var p=o.getButtonSize(this.props),q="_55pi";if(this.props.theme==='dark')q=m(q,(("_5vto")+(p==='small'?' '+"_55_o":'')+(p==='medium'?' '+"_55_p":'')+(p==='large'?' '+"_55_q":'')+(p==='xlarge'?' '+"_55_r":'')+(p==='xxlarge'?' '+"_55_s":'')));var r=this.props.chevron;if(!r){var s=this.props.theme==='dark'?l('/images/ui/x/button/dark/chevron.png'):l('/images/ui/x/button/normal/chevron.png');r=i.createElement(h,{src:s});}var t={button:i.createElement(j,Object.assign({},this.props,{className:m(this.props.className,q),size:p})),chevron:r,chevronWidth:14,defaultMaxWidth:this.props.maxwidth||200};return (i.createElement(g,{config:t,haschevron:this.props.haschevron,image:this.props.image,label:this.props.label,maxwidth:this.props.maxwidth}));}});e.exports=o;},null);
__d("XUISelector.react",["AbstractSelector.react","ContextualLayerPositionClassOnContext","React","XUIPopoverButton.react","ReactXUIMenu","invariant"],function(a,b,c,d,e,f,g,h,i,j,k,l){var m=k.SelectableMenu,n=k.SelectableItem,o=i.createClass({displayName:'ReactXUISelector',statics:{getButtonSize:function(p){return p.size||'medium';}},getDefaultProps:function(){return {haschevron:true};},render:function(){var p={button:i.createElement(j,{haschevron:this.props.haschevron,disabled:this.props.disabled,use:this.props.use,size:this.props.size,suppressed:this.props.suppressed,theme:"dark",maxwidth:this.props.maxwidth}),menu:i.createElement(m,{maxheight:this.props.maxheight}),layerBehaviors:[h]};return (i.createElement(g,Object.assign({},this.props,{ref:"abstractSelector",config:p}),this.props.children));},showMenu:function(){l(this.refs&&this.refs.abstractSelector);this.refs.abstractSelector.showMenu();}});o.Option=n;e.exports=o;},null);
__d("ComposerXEmptyAttachment",["ComposerXAttachment"],function(a,b,c,d,e,f,g){for(var h in g)if(g.hasOwnProperty(h))j[h]=g[h];var i=g===null?null:g.prototype;j.prototype=Object.create(i);j.prototype.constructor=j;j.__superConstructor__=g;function j(k,l){"use strict";g.call(this);this._root=k;if(l)this.attachmentClassName=l;}j.prototype.getRoot=function(){"use strict";return this._root;};e.exports=j;},null);