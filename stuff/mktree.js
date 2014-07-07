/**
 * Copyright (c)2005-2009 Matt Kruse (javascripttoolbox.com)
 * 
 * Dual licensed under the MIT and GPL licenses. 
 * This basically means you can use this code however you want for
 * free, but don't claim to have written it yourself!
 * Donations always accepted: http://www.JavascriptToolbox.com/donate/
 * 
 * Please do not link to the .js files on javascripttoolbox.com from
 * your site. Copy the files locally to your server instead.
 * 
 */
/*
This code is inspired by and extended from Stuart Langridge's aqlist code:
		http://www.kryogenix.org/code/browser/aqlists/
		Stuart Langridge, November 2002
		sil@kryogenix.org
		Inspired by Aaron's labels.js (http://youngpup.net/demos/labels/) 
		and Dave Lindquist's menuDropDown.js (http://www.gazingus.org/dhtml/?id=109)
*/

// Automatically attach a listener to the window onload, to convert the trees
//addEvent(window,"load",convertTrees); 
/*Note: this is just to attach a function to event "load" of the Window object and ensure this function can be triggered*/
/*whenever window load event happen*/

// Utility function to add an event listener
/*function addEvent(o,e,f){
	if (o.addEventListener){ o.addEventListener(e,f,false); return true; }
	else if (o.attachEvent){ return o.attachEvent("on"+e,f); }
	else { return false; }
}*/

// utility function to set a global variable if it is not already set
function setDefault(name,val) {
	if (typeof(window[name])=="undefined" || window[name]==null) {
		window[name]=val;
	}
}

// Full expands a tree with a given ID
function expandTree(treeId) {
	var ul = document.getElementById(treeId);
	if (ul == null) { return false; }
	expandCollapseList(ul,nodeOpenClass);//it is just to change the class of the designated UL to the defined nodeOpenClass
}

// Fully collapses a tree with a given ID
function collapseTree(treeId) {
	var ul = document.getElementById(treeId);
	if (ul == null) { return false; }
	expandCollapseList(ul,nodeClosedClass);//it is just to change the class of the designated UL to the defined nodeClosedClass
}

// Expands enough nodes to expose an LI with a given ID *****this function is not used in this page at this moment
function expandToItem(treeId,itemId) {
	var ul = document.getElementById(treeId);
	if (ul == null) { return false; }
	var ret = expandCollapseList(ul,nodeOpenClass,itemId);
	if (ret) {
		var o = document.getElementById(itemId);
		if (o.scrollIntoView) {
			o.scrollIntoView(false);
		}
	}
}

// Performs 3 functions:
// a) Expand all nodes
// b) Collapse all nodes
// c) Expand all nodes to reach a certain ID
function expandCollapseList(ul,cName,itemId) {
	if (!ul.childNodes || ul.childNodes.length==0) { alert("html:"+ul.html()); return false; }
	// Iterate LIs
	alert(ul.childNodes.length);
	alert(ul.innerHTML+"xxxx"+ul.childNodes[0].nodeType+"xx"+ul.childNodes[1].nodeType+"xx"+ul.childNodes[2].nodeType);
	for (var itemi=0;itemi<ul.childNodes.length;itemi++) {       /*loop to process all subelement under the current top UL*/
		var item = ul.childNodes[itemi];                       /*mark down the child of  the top UL for the coming processing*/
		if (itemId!=null && item.id==itemId) { return true; } /*up till get to the child element which designated in parameter*/
		if (item.nodeName == "LI") {   /*only process the LI child element*/
			// Iterate things in this LI
			var subLists = false;     /*initialize the sign for identifying if the LI has UL under it*/
			for (var sitemi=0;sitemi<item.childNodes.length;sitemi++) {
				var sitem = item.childNodes[sitemi];
				if (sitem.nodeName=="UL") { /* check if there is UL child under this LI, if yes, then need a recursion*/ 
					subLists = true;
					var ret = expandCollapseList(sitem,cName,itemId);/* recurse the UL up till the one without UL residing into any LI of it*/
					if (itemId!=null && ret) {
						item.className=cName;
						return true;
					}
				}
			}
			if (subLists && itemId==null) {
				item.className = cName;
			}
		}
	}
}

// Search the document for UL elements with the correct CLASS name, then process them
function convertTrees() {
	setDefault("treeClass","mktree");                       /*initialize he constant*/
	setDefault("nodeClosedClass","liClosed");
	setDefault("nodeOpenClass","liOpen");
	setDefault("nodeBulletClass","liBullet");
	setDefault("nodeLinkClass","bullet");
	setDefault("preProcessTrees",true);
	if (preProcessTrees) {
		if (!document.createElement) { return; } // Without createElement, we can't do anything
		var uls = document.getElementsByTagName("ul");
		if (uls==null) { return; }
		var uls_length = uls.length;
		for (var uli=0;uli<uls_length;uli++) {//search all the UL element in the document to get the one we want it to be a tree
			var ul=uls[uli];
			if (ul.nodeName=="UL" && ul.className==treeClass) {
				processList(ul);      //change the designated ul into a tree
			}
		}
	}
}

function treeNodeOnclick() {  
//when the node of a tree is clicked, in fact the being clicked element is <a></a>, 
//so we need to get it's parent LI and then change it's class to the opposite case(close->open, open->close)
//	this.parentNode.className = (this.parentNode.className==nodeOpenClass) ? nodeClosedClass : nodeOpenClass;

if (this.parentNode.className == nodeOpenClass)
{
// if the current status is OPEN then make it to close 
this.parentNode.className = nodeClosedClass;
//and then
// 1st: clear all the content under this node
$grp=$(this).siblings("a").text(); // at this moment,"this" is pointing to SPAN element which is the first child of LI  
//alert($grp);
//$obsolete = $(this).siblings("ul").html();
$item=$(this).siblings("ul");
$(this).siblings("ul").html(" ");
//alert($(this).siblings("ul").html());

// 2nd: recreate the sub element basing on the AJAX return
{ //this blacket is for testing usage
//$.getJSON("rfshtree.php", {"grpusr":$grp},jsonpro(data, status)
//{
//$rtn = $.parseJSON(data);
//});
//var jsonp = '[{"Lang":"jQuery","ID":"1"},{"Lang":"C#","ID":"2"}]';
//var lang = '';
//var obj = $.parseJSON(jsonp);
//alert(obj[0].Lang+"$"+obj[0].ID);
//alert(obj[1].Lang + "$" +obj[1].ID);
//console.log(obj);
}
reauest=$.ajax({
                        type: 'POST',
                        url: 'rfshtree.php',
                        data: { "usrgrp" : $grp },
                        dataType: 'json',
                        success: function(data){ 
						$.each(data, function(i,val){
                        $lnk=val.fnclnk;
                        $des=val.fncdes;
                        $item.append('<li><a href='+$lnk+'>'+$des+'</a></li>');	
						});
						
	{		//testing only			console.log(data);
					//    ppp  = $.parseJSON(data);   
//need to remember that jquery ajax will help to parse the data automatically if we defined dataType with "json"
// so we don't need to parseJSON again, that will trigger an exception
					//	$.each(data, function(i,val) {
						
				//	 $rtn.push(val);
					  //   console.log(val);
				//		 console.log(i);				
                   //     });	
				   
//alert(JSON.stringify(data));	
//$newtxt=$item.html();
//alert($obsolete + " " + $newtxt);  
//alert($obsolete + " " + $newtxt);
}
var pitem=$item.get(0);//to convert the jquery object to javascript object, need to provide the index number of jquery object(as every jquery object is an array)
processList(pitem);	   //regenerate the tree for the current UL

						}
                });							
}
else // if the current status is CLOSE then just make it to OPEN
{
//alert($(this).siblings("a").text());
//alert(this.nodeName);
this.parentNode.className = nodeOpenClass;
}

	return false;
}
function retFalse() {
	return false;
}
// Process a UL tag and all its children, to convert to a tree
function processList(ul) {
	if (!ul.childNodes || ul.childNodes.length==0) { return; }  //if there is no child under this element, then it is the ending
	// Iterate LIs
	var childNodesLength = ul.childNodes.length;
	for (var itemi=0;itemi<childNodesLength;itemi++) {
		var item = ul.childNodes[itemi];
		
		if (item.nodeName == "LI") {
			// Iterate things in this LI
			var subLists = false;
			var itemChildNodesLength = item.childNodes.length;
			for (var sitemi=0;sitemi<itemChildNodesLength;sitemi++) {
				var sitem = item.childNodes[sitemi];
				if (sitem.nodeName=="UL") {
					subLists = true;
					processList(sitem);
				}
			}
			var s= document.createElement("SPAN");     // this is the exactly element will be clicked by user
			var t= '\u00A0'; // &nbsp; space
			s.className = nodeLinkClass;
			if (subLists) {
				// This LI has UL's in it, so it's a +/- node
				if (item.className==null || item.className=="") {
					item.className = nodeOpenClass;
				}				
			/*		alert(item.firstChild.nodeName);
				var ss=item.firstChild;
				if(ss.nodeName=="A")
				alert(ss.innerHTML);*/
				// If it's just text, make the text work as the link also
				
				if (item.firstChild.nodeName=="#text") {
					//if the text shown in the node is not held by a container, the following code will create a SPAN to 
				//hold the text and then take the place of it
				    alert("ddd");
					t = t+item.firstChild.nodeValue;       // mark down the #text value for later regeneration
					item.removeChild(item.firstChild);    // as it is a #text , so just remove it 
				}//so if we give a <a></a> to contain the node value, this code will not work.
				s.onclick = treeNodeOnclick;   // attach the onclick event to s
			}
			else {
				// No sublists, so it's just a bullet node
				item.className = nodeBulletClass;
				s.onclick = retFalse;
			}
			s.appendChild(document.createTextNode(t)); 
			// if there is no container to hold the text previously, this code will put the text within the SPAN
			// or else, the content of SPAN will be blank
			item.insertBefore(s,item.firstChild); //attach this SPAN in front of first child of item(if we 
			//use <a> to contain the text, then SPAN with blank will be posted prior to <a>
		}
	}
}

jQuery(document).ready(function($){
//alert("ready");
 convertTrees();
});