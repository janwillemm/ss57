<?php
/* @var $this IframeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Iframes',
);

$this->menu=array(
	array('label'=>'Create Iframe','url'=>array('create')),
	array('label'=>'Manage Iframe','url'=>array('admin')),
);
?>

<h1>Iframes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>