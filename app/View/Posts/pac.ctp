<?php 
echo $this->Html->css(array("grossstyle","mktree"), null, array('inline' => false)); 
echo $this->Html->script("//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", array('inline' => false));
echo $this->Html->script(array("menu.hoverIntent","mfnc","menucontrol","mktree"), array('inline' => false));
?>
<?php $this->start('title');
echo "Personal account page";
$this->end();
?>
<?php $this->start('base');
echo "<base href='/erp_cake/stuff/'>";
$this->end();
?>
<?php $this->start('loginof');
$contadd = $this->Html->url();// will get the current controller and action
$maclnk = $this->Html->url(array('action' => 'pac'));  //url will default to get the current location for the non defined node
echo 
'<div id="login" style="background-color:#889933;">
<form action="'.$contadd.'" method="POST" onsubmit="return validate()">
<table>
<tr>
<td width="110"><a class="lginc">ID: </a><a class="lgofc">Welcome back !</a></td>
<td><input type="text" name="id" id="id" class="lginc"></input><a id="nme" class="lgofc"></a></td>
</tr>
<tr>
<td width="110" ><a class="lginc">Password: </a><a class="lgofc">Last login time:</a></td>
<td ><input type="password" class="lginc" name="pwd" id="pwd"></input><a id="ltime" class="lgofc"></a></td>
</tr>
<tr>
<td width="110"><input type="submit" id="lginb" class="lginc" style="display:inline;" value="Login"></input>
<a class="lgofc" id="acmnu" href=""></a></td>    <!---- button in a form need to be defined with type = "button", or else, it will trigger the submit() event--->
<td><div id="info"><button type="button" class="lgofc" id="sngff" onclick="signoff(1)">log off</button></div></td>
</tr>
</table>
</form>
</div>';
echo $lginfo;
$this->end();
?>
<?php 
echo $this->start('dmenu');
echo 
'<div class="menudv">
<ul class="topul cfix">
           <li class="home">
		    <a href="home">home</a>
		    <div class="secdv" style="display: none; opacity: 0;">
			<a class="bu-close" href="#">Close</a>
		    </div>
		   </li>		   
		   <li class="item_a">
		    <a>item_a</a>
		    <div class="secdv" style="display: none; opacity: 0;">
			<a class="bu-close" href="#">Close</a>
		    </div>
		   </li>
           <li class="item_b">
		    <a>item_b</a>
		    <div class="secdv" style="display: none; opacity: 0;">
			<a class="bu-close" href="#">Close</a>
		    </div>
		   </li>		   
		   <li class="item_c">
		    <a>item_c</a>
		    <div class="secdv" style="display: none; opacity: 0;">
			<a class="bu-close" href="#">Close</a>
		    </div>
		   </li>
		   <li class="item_d">
		    <a>item_d</a>
		    <div class="secdv" style="display: none; opacity: 0;">
			<a class="bu-close" href="#">Close</a>
		    </div>
		   </li>	  
           <li class="item_e">
		    <a>item_e</a>
		    <div class="secdv" style="display: none; opacity: 0;">
			<a class="bu-close" href="#">Close</a>
		    </div>
		   </li>	
		   
</ul>
</div>';
$this->end();
?>
<?php 
$this->start('dtree');
echo '<div class="usrfn"><fieldset class="acau">
<legend>Authority group</legend><ul class="mktree" id="tree1">
</ul></fieldset></div>';
$this->end();
?>
