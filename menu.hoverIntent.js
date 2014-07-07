/**
* hoverIntent r5 // 2007.03.27 // jQuery 1.1.2+
* <http://cherne.net/brian/resources/jquery.hoverIntent.html>
* 
* @param  f  onMouseOver function || An object with configuration options
* @param  g  onMouseOut function  || Nothing (use configuration options object)
* @author    Brian Cherne <brian@cherne.net>
*/
(
function($)
{
$.fn.hoverIntent=function(f,g)
{
var cfg={sensitivity:7,interval:100,timeout:0};
cfg=$.extend(cfg,g?{over:f,out:g}:f);
var cX,cY,pX,pY;
var track=function(ev)
{cX=ev.pageX;cY=ev.pageY;};
var compare=function(ev,ob)
{
ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);
if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity) 
//in fact this is some kind of checking on how fast the mouse moving on the current element, if the difference is
// larger than sensitivity, that means mouse moving very fast and so the buttonover function will not be triggered 
// on the current element
{
$(ob).unbind("mousemove",track);
ob.hoverIntent_s=1;
return cfg.over.apply(ob,[ev]);// trigger the buttonover function for the current element
}
else
{// if the mouse speed checking result is larger than the sensitivity(very fast), that means at this moment, user still 
//not yet get to the final destination he want to be, then pgm just need to keep the current location(as the last location)
// for next time's speed checking
pX=cX;
pY=cY;
ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);
}
};
var delay=function(ev,ob){
ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);
ob.hoverIntent_s=0;
return cfg.out.apply(ob,[ev]);
};
var handleHover=function(e)
{
var p=(e.type=="mouseover"?e.fromElement:e.toElement)||e.relatedTarget;
while(p&&p!=this)
{
try{p=p.parentNode;}
catch(e){p=this;}
}
if(p==this){return false;}
var ev=jQuery.extend({},e);
var ob=this;
if(ob.hoverIntent_t)
{ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);}
if(e.type=="mouseover")
{
pX=ev.pageX;pY=ev.pageY;$(ob).bind("mousemove",track);
if(ob.hoverIntent_s!=1)
{ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);}
}
else
{
$(ob).unbind("mousemove",track);
if(ob.hoverIntent_s==1)
{ob.hoverIntent_t=setTimeout(function(){delay(ev,ob);},cfg.timeout);}
}
};
return this.mouseover(handleHover).mouseout(handleHover);
};
}
)(jQuery);