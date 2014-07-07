<p>Total Author count: <?php echo $atotal;?></p>
<p>Total Book count: <?php echo $btotal;?></p>
<?php // print_r($books)?>
<?php echo $this->Html->link("Add",array("action"=>"add"))?>
<table border='1'>
<thead>
<th>ID</th><th>ISBN</th><th>Title</th><th>Author</th><th>Total Reader</th><th>Action</th>
</thead>
<?php foreach($books as $book): ?>
<tr>
<td><?php echo $this->Html->link($book['Book']['id'],array('action'=>'view',$book['Book']['id']))?></td>
<td><?php echo $book['Book']['isbn'] ?></td>
<td><?php echo $book['Book']['title'] ?></td>
<td><?php echo $book['Author']['name'] ?></td>
<td><?php echo $this->Html->link($book['Book']['reader_count'],array('action'=>'rlist',$book['Book']['id']))?></td>
<td><?php echo $this->Html->link("Delete",array('action'=>'delete',$book['Book']['id']))?></td>
</tr>
<?php endforeach; ?>
</table>   