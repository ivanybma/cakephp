<?php
print_r($vv);
echo "<br>";
print_r($psubq);
echo "<br>";
print_r($subq);
echo "<br>";
print_r($cpsubq);
echo "<br>";
print_r($tst);
echo "<br>";
print_r($tst2);
echo "<br>";
print_r($formdata);
echo "<br>";
print_r($errormsg);
echo "<br>";
//the following foreach show how to extract all the field name and matching error msg
foreach($errormsg as $key=>$msg)
{
	echo "Field: ".$key.":<br>";
	foreach($msg as $msgi)
	{echo $msgi;}
	echo "<br>";
}
echo "<br>";
//print_r($error); this is validation msg extracted from $this->modelname->invalidFields(), 
// but it seems it get the duplicate msg issue, not yet know the reason, 
// so I now use $this->modelname->validationErrors instead

echo $this->Form->create('Reader');
//input element name must the same as the table field, or else it cannot be saved to table
echo $this->Form->input('name',array('div'=>false,'label'=>'Reader Name','error'=>false));
//if we don't hope the validation msg be shown defaultly by cakephp just after the field, we can use 'error'=>false to block it
//and show the error msg by ourself according to the controller passed parameter(extracted by $this->modename->validationErrors)
echo $this->Form->input('email', array('rows' => '3','div'=>false, 'label'=>'Reader contact Email','error'=>false));
//if need to block the HTML5 auto validation, just need to add the formnovalidate true in the submit button
echo $this->Form->button('Add', array('type'=>'submit','div'=>false, 'name'=>'Add','formnovalidate' => true));
echo $this->Form->button('Cancel', array('type'=>'button','div'=>false, 'name'=>'Cancel1'));
echo $this->Form->end();

?>