<?php
/* @var $this QuoteController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Quotes',
);

$this->menu=array(
	array('label'=>'Create Quote','url'=>array('create')),
	array('label'=>'Manage Quote','url'=>array('admin')),
);
?>

<h1>Quotes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>