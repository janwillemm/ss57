<?php
/* @var $this FactController */
/* @var $model Fact */
?>

<?php
$this->breadcrumbs=array(
	'Facts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Fact', 'url'=>array('index')),
	array('label'=>'Manage Fact', 'url'=>array('admin')),
);
?>

<h1>Create Fact</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>