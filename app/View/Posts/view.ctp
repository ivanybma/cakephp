<!-- File: /app/View/Posts/view.ctp -->
<?php
// app/View/Posts/view.ctp
$this->extend('/Common/view');

//$this->assign('title', $post);

$this->start('sidebar');   //beginning of matching the extended view this->fetch('sidebar')
echo "sidebar start";
?>
<li>
<?php
echo $this->Html->link('edit', array(
    'action' => 'edit',
    $post['Post']['id']
)); ?>
</li>
<?php echo "sidebar end"; $this->end();   //ending of matching the extended view this->fetch('sidebar')
?>
<?php
// The remaining content will be available as the 'content' block
// in the parent view.?>

<h1><?php echo h($post['Post']['title']); ?></h1>

<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>

<p><?php echo h($post['Post']['body']); ?></p>
<?php $this->assign('sidebar','new sidebar');?>
<?php $this->append('sidebar','kdfjkld');?>
<?php $this->append('sidebar');
echo "append content";
$this->end();
?>
<?php $this->start('sidebar');
echo "start again";
$this->end();
?>
<?php $this->prepend('sidebar','prepended content');
echo "prepended by echo";
$this->end();
?>