<?php print_r($ddta);?>
<table border='1'>
<?php echo $this->Form->create();?>
<tr><td>ISBN</td>
<td>
<?php echo $this->Form->input("isbn",array('div'=>false,'label'=>false));?>
</td></tr>
<tr><td>Title</td>
<td>
<?php echo $this->Form->input("title",array('div'=>false,'label'=>false));?>
</td></tr>
<tr><td>Author</td>
<td>
<?php echo $this->Form->input("author_id",array('div'=>false,'label'=>false,"options"=>$alst));?>
</td></tr>
<tr><td>Description</td>
<td>
<?php echo $this->Form->input("description",array('type'=>"textarea","rows"=>3,'div'=>false,'label'=>false));?>
</td></tr>
<tr><td></td><td>
<?php echo $this->Form->button('submit',array('type'=>'submit','div'=>false,'label'=>false,'formnovalidate'=>true));?>
</td></tr>
<?php echo $this->Form->end();?>
</table>