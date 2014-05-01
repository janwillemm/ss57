<?php
/* @var $this SettingController */
/* @var $model Setting */
?>

<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->name=>array('view','id'=>$model->name),
	'Update',
);

$this->menu=array(
	array('label'=>'List Setting', 'url'=>array('index')),
	array('label'=>'Create Setting', 'url'=>array('create')),
	array('label'=>'View Setting', 'url'=>array('view', 'id'=>$model->name)),
	array('label'=>'Manage Setting', 'url'=>array('admin')),
);
?>

    <h1>Update Setting <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>