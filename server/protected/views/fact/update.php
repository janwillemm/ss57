<?php
/* @var $this FactController */
/* @var $model Fact */
?>

<?php
$this->breadcrumbs=array(
	'Facts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Fact', 'url'=>array('index')),
	array('label'=>'Create Fact', 'url'=>array('create')),
	array('label'=>'View Fact', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Fact', 'url'=>array('admin')),
);
?>

    <h1>Update Fact <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>