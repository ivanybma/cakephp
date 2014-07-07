<h2>Reader ID: <?php echo $reader['Reader']['id'];?></h2>
<?php // print_r($reader)?>
<h3>Total number of Book: <?php echo $btotal;?></h3>
<div style="width:580px;background-color:#f99f0f;float:left;">
<table border='1'>
<?php foreach ($reader['Book'] as $read)
{
echo "<tr><th>ID:</th><th>".$read['id']."</th><th>".$this->Html->link('Delete',array("action"=>"sbdelete",$read['BooksReader']['id'],$reader['Reader']['id']))."</th></tr>";
echo "<tr><td>Title</td><td>ISBN</td><td>Description</td><td>Author id</td></tr>";
echo "<tr><td>".$read['title']."</td><td>".$read['isbn']."</td><td>"
.$read['description']."</td><td>".$this->Html->link($read['author_id'],array('controller'=>'authors','action'=>'view',$read['author_id']))."</td></tr>";
}
?>
<?php print_r($ddta)?>
<br>
<?php print_r($bkid);?> <!--  the book id which is owned by this reader -->
<br>
<?php print_r($blst)?> <!--  the book id which is not yet owned by this reader -->
<br>

</table>
</div>
<div style="width:500px;background-color:#990011;float:left;">
<?php echo $this->Form->create('Reader');
echo $this->Form->input('Reader.id',array("type"=>'hidden','value'=>$reader['Reader']['id']));
?>
<table border='1' style="height:40px;width:300px">
<tr><td>
<?php 
echo $this->Form->input('Add new book',array('type'=>'submit',"div"=>false,"label"=>false)); ?></td>
<td></td><td>
<?php 
echo $this->Form->input('Book.id', array("type"=>'select',"div"=>false,
"label"=>false,"empty"=>'Choose a book',"options"=>$blst));
?>
</td></tr>
</table>
<?php echo $this->Form->end();?>
</div>