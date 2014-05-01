<?php
/* @var $this IframeController */
/* @var $model Iframe */
?>

<?php
$this->breadcrumbs=array(
	'Iframes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Iframe', 'url'=>array('index')),
	array('label'=>'Create Iframe', 'url'=>array('create')),
	array('label'=>'View Iframe', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Iframe', 'url'=>array('admin')),
);
?>

    <h1>Update Iframe <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>