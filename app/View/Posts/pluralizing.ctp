<h1>Name pluralization</h1>
<?php
echo $this->Form->create(false); // with false, the value of element under this form will directly under request->data array, request method will be get
//if with a model name(non false), then value of element under form will be contained as subarray under request->array, and the request method will be post
echo $this->Form->input('word',array('div'=>false));
echo $this->Form->end('Save Post',array('div'=>false));
echo $this->Form->button('test',array('type'=>'button', 'onclick'=>"alert('ddd')"));
if ($prst!=="")
{echo $this->form->input('abc', array('value'=>$prst));}
else
{echo $this->form->input('abc');}

?>