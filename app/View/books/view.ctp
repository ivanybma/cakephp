<?php print_r($books);?>
<h2>Book ID: <?php echo $books['Book']['id'];?></h2>
<h3><?php echo $btotal;?></h3>
<table border='1'>
<tr><td>Title</td><td><?php echo $books['Book']['title'];?></td></tr>
<tr><td>ISBN</td><td><?php echo $books['Book']['isbn'];?></td></tr>
<tr><td>Description</td><td><?php echo $books['Book']['description'];?></td></tr>
<tr><td>Author id</td><td><?php echo $books['Book']['author_id'];?></td></tr>
</table>

<table border='1'>
<tr><th>Reader id</th><th>Reader Name</th><th>Book count</th></tr>
<?php foreach($books['Reader'] as $rd)
{
?>
<tr>
<td><?php echo $rd['id'] ?></td>
<td><?php echo $rd['name']?></td>
<td><?php echo 0?></td>
</tr>	
<?php 	
}?>
</table>


