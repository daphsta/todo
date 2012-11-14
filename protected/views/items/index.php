<?php
/* @var $this ItemController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Add new item', 'url'=>array('create')),
);
?>

<h1><?php echo Yii::app()->user->name ? Yii::app()->user->name . '\'s' : 'My' ?> To-do list</h1>
<h4><?php echo $status == ListItems::STATUS_COMPLETED ? 'Completed':'Active' ?> Items</h4>

<?php if ($provider->totalItemCount): ?>
    <div class="span-18 list-container">
        <div class="list-header">
            <div class="span-12 left content">Item</div>
            <div class="span-6 left last actions">Actions</div>
        </div>
        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$provider,
            'itemView'=>'_view',
            'enablePagination'=>false,
            'template'=>'{items}{pager}'

        )); ?>
    </div>
<?php elseif (Yii::app()->user->id): ?>
    <p>Add new Items, and start creating your To-do list!</p>
<?php else: ?>
    <p>Login now to Create and Manage your To-do List!</p>
<?php endif; ?>

