<?php $this->extend('/Common/view'); //this is to show how to use child view extending parent one
//with 1. extend (defining which parent view is to be extended by this view
//     2. assign (assign the block content, this content will be fetched in parent view with command "fetch") 
$this->assign('title','extended by author index view');
?>
<?php echo $this->Html->script("test");?>
<?php //echo $this->Html->script("//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", array('inline' => false));?>
<script>alert ('<?php echo $rstpe?>');</script>
<h1>Total number of Author: <?php echo $total;?></h1>
<?php if (is_null($srch))
{
?>
<table style="width:600px;border:solid">
<tr><td style="width:400px;border:solid">
<?php 
echo $this->Form->button("ajax tst",array("type"=>"button","div"=>false,"id"=>'ajt'));
echo $this->Js->get("#ajt")->event(
    'click',
    $this->Js->get("#ajt")->request(
        array('action' => 'clock','success'=>"alert($abc)"),
        array('async' => true, 'update'=>$abc)
    )
);
?>
 <div id="clock" style="background-color:#887700;width:200px;height:50px;"></div>
</td><td style="border:dotted">
<?php 
echo $this->element('search',array(
"formname" => "test",
"fieldname" => "name"
));
//the follwoing content is included in element named "search" and it will be prompted out
// in the screen according to the above control information
//echo $this->Form->create('test',array('div'=>false));
//echo $this->Form->input('name', array('div'=>false));
//echo $this->Form->end(array('div'=>false));
?>
</td></tr>
<tr><td></td><td></td></tr>
</table>
<button id="b1">button</button> 
<div id="mylst", style="width:200px;height:200px;background-color:#773300"></div>
<?php // print_r($list);
//print_r($authors);
echo $this->Form->button("test",array("type"=>'button',"id"=>'b2'));
//with "js->writeBuffer()" in the layout, all script prepared through $this->Js 
//will be shown at the bottom of BODY session, user's browser cannot use the script without 
//writing them out to the pagex
$data=array("a"=>'1',"b"=>'2');
$data=array(array('a','b','c'),"d","e",array("f","g"));
echo $this->Js->get('#b2')->event('click', $this->Js->alert('hey you!'));// at this moment, 
echo $this->Js->get('#b1')->event('click','jcode()');//bind the function defined in scriptblock to a click event
//bind the function defined in js file under folder webroot/js/ path
echo $this->Form->button("msg",array("type"=>'button',"id"=>"msg","onclick"=>"msg()"));
echo $this->Html->scriptBlock("
function jcode()
{alert('jcode triggered');}
",array('inline'=>true));
echo $this->Js->get("#mylst");
echo $this->Js->event("click",$this->Js->effect('fadeOut'));

// the the above script just locates in cache, it will not be available in page until we 
//use writeBuffer in layout
?>
<p><?php // print_r($thread)?></p>
<p> Total number of book: <?php echo $btotal;?> </p>
<p>New Author: <?php echo $this->Html->link('Add',array('action'=>'add'))?></p>
<table>
<tr><td style="border-bottom:solid">Author ID</td><td style="border-bottom:solid">Name</td><td style="border-bottom:solid">Book Count</td><td style="border-bottom:solid">Action</td></tr>
<?php foreach($authors as $author): ?>
<tr><td style="border-bottom:solid"><?php echo $author['Author']['id']?></td>
<td style="border-bottom:solid"><?php echo $author['Author']['name']?></td>
<!-- The below book_count is updated automatically by delete() and save() cakePHP function -->
<td style="border-bottom:solid"><?php echo $author['Author']['book_count']?></td><td><?php echo $this->Html->link("Update ",array("action"=>"update",$author['Author']['id'])); echo $this->Html->link("| Delete",array('action'=>"delete",$author['Author']['id']));?></td></tr>
<tr><td></td><td style="border:double; ">Book list:</td></tr>
<tr><td></td><td style="border:double;">ID</td><td style="border:double;">Title</td><td style="border:double;">Description</td></tr>
<?php foreach($author['Book'] as $book): ?>
<tr><td></td><td style="border:double;"><?php echo $this->Html->link($book['id'],array('controller'=>'Books','action'=>'view',$book['id'])) ?></td><td style="border:double;"><?php echo $book['title'] ?></td><td style="border:double;"><?php echo $book['description']?></td></tr>
<?php endforeach; ?>
<?php endforeach; ?>    
</table>

<?php }
else 
{
	?>
	<table border='1'>
	<th>id</th><th>name</th><th>email</th><th>website</th><th>book count</th>
	<?php 
	print_r($srch);
	foreach ($srch as $rcd)
	{ $cnt=0;
		foreach ($ak as $aks)
		{
		if ($aks['Book']['author_id']==$rcd['authors']['id'])
		{
		//	foreach ($aks['0'] as $cnt) this is the same as the below expression
		//	{$cnt=$cnt['cnt'];}
			
			$cnt=$aks['0']['cnt'];  //this is the same as the above expression
		}
		}
		echo "<tr><td>".$rcd['authors']['id']."</td><td>".$rcd['authors']['name'].
		"</td><td>".$rcd['authors']['email']."</td><td>".$rcd['authors']['website'].
		"</td><td>".$cnt."</td></tr>";
	}
	?>
	</table>
<?php 	
	echo "<br>";
	print_r($srch2);
	echo "<br>";
	print_r($ak);	


	
}

?>

