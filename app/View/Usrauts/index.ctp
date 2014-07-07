<h1>Blog user aut</h1>


<table>
    <tr>
        <th>Id</th>
        <th>usrgrp</th>
        <th>cdate</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($usau as $usauth): ?>
    <tr>
        <td><?php echo $usauth['Usraut']['ac']; ?></td>
        <td><?php echo $usauth['Usraut']['usrgrp']; ?></td>
       <td><?php echo $usauth['Usraut']['cdate']; ?></td>
      
    </tr>
    <?php endforeach; ?>
    <?php unset($usauth); ?>
</table>
