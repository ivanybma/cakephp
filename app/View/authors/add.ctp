
<?php print_r($dta)?>
<br>
<?php print_r($mdta)?>
<br>
<?php print_r($nmdta)?>
<br>
<table border='1'>
<?php echo $this->Form->create();?>
<?php for ($i=0;$i<$count;$i++)
{
?>
<!--pay atention to the $i expression-->
<tr><td>Author Name</td><td><?php echo $this->Form->input("Author.$i.name",array('div'=>false,'label'=>false));?></td></tr>
<tr><td>Author Email</td><td><?php echo $this->Form->input("Author.$i.email",array('div'=>false,'label'=>false));?></td></tr>
<tr><td>Author Website</td><td><?php echo $this->Form->input("Author.$i.website",array('div'=>false,'label'=>false));?></td></tr>
<tr><td>---------</td></tr>
<?php }?>
<tr><td></td><td>
<?php echo $this->Form->button('submit',array('type'=>'submit','div'=>false,'label'=>false,'formnovalidate'=>true));?>
</td></tr>
<?php echo $this->Form->end();?>
</table>