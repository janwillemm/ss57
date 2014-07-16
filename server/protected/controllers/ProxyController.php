<?php
class ProxyController extends Controller
{

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex($url)
	{
		$proxy = new Proxy();
		$data = $proxy->run($url, "", "");
		echo $data;
		
		foreach (Yii::app()->log->routes as $route) {
        if($route instanceof CWebLogRoute) {
	            $route->enabled = false; // disable any weblogroutes
	        }
	    }
		Yii::app()->end(); 
	}
}
?>