<?php

class Controller extends CController
{

	public function init()
	{
		parent::init();

		$this->pageTitle = ''; // don't forget to set title in VIEWs!
	}

}
