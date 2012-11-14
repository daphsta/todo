<?php
/* @var $this ItemController */
/* @var $data Items */

$actions[] = CHtml::link('update',array('/items/update','id'=>$data->id));

if ($data->completed == ListItems::COMPLETED_NO)
    $actions[] = CHtml::link(
                'complete', 
                array(
                    '/items/setCompleted',
                    'id'=>$data->id
                ),
                array(
                    'onClick'=>'javascript: return confirm(\'Are you sure you want to set this item as completed?\')'
                )
        );

if ($data->deleted == ListItems::DELETED_NO)
    $actions[] = CHtml::link(
                'delete', 
                array(
                    '/items/setDeleted',
                    'id'=>$data->id
                ),
                array(
                    'onClick'=>'javascript: return confirm(\'Are you sure you want to delete this item?\')'
                    )
            );

?>

<div class="view span-18">
        <div class=" list-header clearfix" style="height:40px;">
            <div class="span-12 left content">
                <div><?php echo nl2br(CHtml::encode($data->content)); ?></div>
                <div style="padding: 5px 0 5px 0; font-style: italic;">on <?php echo Yii::app()->dateFormatter->formatDateTime($data->created_at,'medium','short') ?></div>
            </div>
            <div class="span-6 left last actions"><?php echo implode(' | ',$actions); ?></div>
        </div>
</div>