<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
	public function index()
	{
		$v = \Config\Services::parser();
		$data['total']=456;
		$data['totald']=45.56;
		$data['birthdate']='12/29/1989';
		$data['price']=89;
		echo $v->setData($data)->render('welcome_message');
}
	//--------------------------------------------------------------------

}
