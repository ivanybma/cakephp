<h1>Blog posts</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($post2s as $post): ?>
    <tr>
        <td><?php echo $post['Post2']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['Post2']['title'],
array('controller' => 'post2s', 'action' => 'view', $post['Post2']['id'])); ?>
        </td>
        <td><?php echo $post['Post2']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>