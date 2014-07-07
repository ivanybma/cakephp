<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
	<?php /*echo $cakeDescription*/ ?> <?php if(false) { ?>:<?php } ?>
	<?php /* echo $title_for_layout; */?> 
	<?php echo $this->fetch('title'); ?>
	</title>
	<?php
//		echo $this->Html->meta('icon');
	//	echo $this->Html->css('cake.generic');
        echo $this->fetch('base');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
	?>
</head>
<body>
<table class='t1st'>
<tr> <!------heading------->
<td class='headl'></td><td class='headc'></td>
<td class='headr'>
<?php echo $this->fetch('loginof');?>
</td>
</tr>
<tr><!-----menu bar------->
<td class='menul'>
</td>
<td class='menuc'>
<?php echo $this->fetch('dmenu');?>
</td>
<td class='menur'></td>
</tr>
<tr><!-----main content------->
<td class='mainl'>
<?php echo $this->fetch('dtree');?>
</td>
<td class='mainc'>
<div id="content">
<?php echo $this->fetch('content'); ?>
</div>
</td>
<td class='mainr'></td>
</tr>
<tr><!-----trailer bar------->
<td class='traill'></td>
<td class='trailc'></td>
<td class='trailr'></td>
</tr>
<tr><!-----ending------->
<td class='endl'></td>
<td class='endc'></td>
<td class='endr'></td>
</tr>
</table>




</body>
</html>
