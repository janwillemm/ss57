<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		
		try {
			$data = array_map(array($this, "expose"), SlideGenerator::generateSlides());
			$this->renderJSON($data);
		}
		catch(Exception $e){
			throw $e;
		}
		return;
		
	}

	public function expose($slide){
		if($slide)
			return $slide->expose();
	}

	protected function renderJSON($data)
	{
	    header('Content-type: application/json');
	    echo CJSON::encode($data);

	    foreach (Yii::app()->log->routes as $route) {
	        if($route instanceof CWebLogRoute) {
	            $route->enabled = false; // disable any weblogroutes
	        }
	    }
	    Yii::app()->end();
	}

}