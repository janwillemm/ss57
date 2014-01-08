<?php
require_once("../login.php");
$dbc = DatabaseConnection::getInstance();
$settings = $dbc->getAll($dbc->DBNAME_SETTINGS);
if($_POST['save']){
	$settings = array_map("updateSetting", $settings);
}

$page = '<form class="form-horizontal" role="form" action="' . $_SERVER['PHP_SELF'] . '" method="post">';

foreach($settings as $setting){
	$page .= makeHtmlForSetting($setting);
}

$page .= '<input type="hidden" value="save" name="save" />';
$page .= '<button type="submit" class="btn btn-default" >Save</button>';
$page .= '</form>';

echo $page;



function updateSetting($setting){
	DatabaseConnection::getInstance()->updateSetting($setting['name'], $_POST[$setting['name']]);
	$setting['value'] = $_POST[$setting['name']];
	return $setting;
}

function makeHtmlForSetting($setting){
	$html  = '<div class="form-group">';
	$html 	.= '<label for="' . $setting['name'] . '">' . $setting['name'] . '</label>';
	$html 	.= '<div class="col-sm-10">';
	$html 		.= '<input type="text" class="form-control" id="' . $setting['name'] . '" name="' . $setting['name'] . '" placeholder="' . $setting['comment'] . '" value="' . $setting['value'] . '">';
	$html 	.= '</div>';
	$html .= '</div>';
	return $html;
}


?>