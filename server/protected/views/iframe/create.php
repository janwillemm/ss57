<?php
/* @var $this IframeController */
/* @var $model Iframe */
?>

<?php
$this->breadcrumbs=array(
	'Iframes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Iframe', 'url'=>array('index')),
	array('label'=>'Manage Iframe', 'url'=>array('admin')),
);
?>

<h1>Create Iframe</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>