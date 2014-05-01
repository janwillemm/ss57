<?php
/* @var $this IframeController */
/* @var $model Iframe */
?>

<?php
$this->breadcrumbs=array(
	'Iframes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Iframe', 'url'=>array('index')),
	array('label'=>'Create Iframe', 'url'=>array('create')),
	array('label'=>'Update Iframe', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Iframe', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Iframe', 'url'=>array('admin')),
);
?>

<h1>View Iframe #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'name',
		'link',
		'end_date',
	),
)); ?>