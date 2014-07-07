
<h2>Book ID: <?php echo $bk['Book']['id'];?></h2>
<?php // print_r($bk)?>
<p>Reader list</p>
<table border='1'>
<thead>
<th>ID</th><th>Name</th><th>Email</th>
</thead>
<?php foreach($bk['Reader'] as $rlst): ?>
<tr>
<td><?php echo $this->Html->link($rlst['id'],array('controller'=>'readers', 'action'=>'view',$rlst['id'])) ?></td>
<td><?php echo $rlst['name'] ?></td>
<td><?php echo $rlst['email'] ?></td>
</tr>
<?php endforeach; ?>
</table>   