<?php
/* @var $this FactController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Facts',
);

$this->menu=array(
	array('label'=>'Create Fact','url'=>array('create')),
	array('label'=>'Manage Fact','url'=>array('admin')),
);
?>

<h1>Facts</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>