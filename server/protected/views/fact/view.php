<?php
/* @var $this FactController */
/* @var $model Fact */
?>

<?php
$this->breadcrumbs=array(
	'Facts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Fact', 'url'=>array('index')),
	array('label'=>'Create Fact', 'url'=>array('create')),
	array('label'=>'Update Fact', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Fact', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Fact', 'url'=>array('admin')),
);
?>

<h1>View Fact #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'fact',
		'date',
		'active',
	),
)); ?>