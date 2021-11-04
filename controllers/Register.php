<?php

class Register extends Controller {

	function __construct() {
		parent::__construct();	
	}
	function index() 
	{	
	    $this->view->title = 'Register';
		$this->view->render('Register/index');
	}
	function terms() 
	{	
	    $this->view->title = 'terms';
		$this->view->render('Register/terms');
	}
	function run()
	{
		$data = array();
		$data['REGION']    = $_POST['REGION'];
		$data['WILAYA']    = $_POST['WILAYA'];
		$data['STRUCTURE'] = $_POST['STRUCTURE'];
	    $data['GRADE']     = $_POST['GRADE'];
		$data['LANG']      = $_POST['LANG'];
		$data['login']     = $_POST['login'];
		$data['password']  = $_POST['password'];
		$this->model->run($data);	
	}
	

}