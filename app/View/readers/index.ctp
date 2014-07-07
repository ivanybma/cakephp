<?php // echo $rtotal; echo "<br>"?>
<?php //print_r($readers)?>
<table border='1'>
<thead>
<th>ID</th><th>Name</th><th>Email</th>
</thead>
<?php foreach($readers as $read): ?>
<tr>
<td><?php echo $this->Html->link($read['Reader']['id'],array('action'=>'view',$read['Reader']['id'])) ?></td>
<td><?php echo $read['Reader']['name'] ?></td>
<td><?php echo $read['Reader']['email'] ?></td>
<td><?php print_r ($read) ?></td>
</tr>
<?php endforeach; ?>
</table>  
<div>
<?php 
print_r($formdata);
print_r($key);
echo "<br>";
print_r($errormsg);

/*echo $this->Form->postLink(
                    'Add',
                    array('action' => 'add', "sss"),
                    array('confirm' => 'Are you sure?')
                );*/
echo $this->Html->Link('Add',array('action'=>'add'));

//if no special define in the form create param, the default responsive one is current controller
echo $this->Form->create(array('controllers'=>'Readers','action'=>'delete'));
echo $this->Form->input('Reader ID',array('div'=>false,'value'=>'Input an existing reader ID'));
echo $this->Form->button('delete', array('type'=>'submit','div'=>false,'name'=>'delete'));
echo $this->Form->button('Cancel', array('type'=>'submit','div'=>false,'name'=>'cancel2'));
echo $this->Form->end();
?>
</div> 