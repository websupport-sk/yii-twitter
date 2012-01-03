<?php

class SiteController extends Controller
{

	public function actionError()
	{
	    if ($error = Yii::app()->errorHandler->error) {
	    	if (Yii::app()->request->isAjaxRequest) {
	    		echo $error['message'];
			} else {
	        	$this->render('error', $error);
			}
	    }
	}


	public function actionIndex()
	{
		$this->render('index');
	}


	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

}
