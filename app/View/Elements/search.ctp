<table  style="text-align: left"><!-- this is to show how to use the element with input parameter from view -->
<!-- $formname and $fieldname are two parameters passed from view index.ctp -->
<?php echo $this->Form->create($formname,array('div'=>false));?>
<th>Form</th><th>Content</th><th>Action</th>
<tr><td><?php echo $formname?></td>
<td><?php echo $this->Form->input($fieldname, array('div'=>false)); ?></td>
<td><?php echo $this->Form->end(array('div'=>false));?></td></tr>
</table>