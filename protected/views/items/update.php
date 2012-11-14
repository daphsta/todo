<?php
/* @var $this TodoController */
/* @var $model Todos */


$this->menu=array(
	array('label'=>'List Items', 'url'=>array('index')),
        array('label'=>'Add new item', 'url'=>array('create')),
);
?>

<h1>Update Item</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>