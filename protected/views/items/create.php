<?php
/* @var $this ItemController */
/* @var $model ListItems */


$this->menu=array(
	array('label'=>'List Items', 'url'=>array('index')),
);
?>

<h1>Add List Item</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>