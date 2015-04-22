<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Drink;
use Illuminate\Contracts\View\Factory;

class AdminController extends Controller {

	//
	public function index(){


		$db = new Drink;

		$drinks = $db->getAllDrinks();

		// var_dump($drinks);

		$data = array('drinks' => $drinks, 'page_title' => "Cocktails");

		return view('pages.about', $data);

	}


	/*
	*  Add a new Cocktail 
	*   	
	*
	*/

	public function addDrink(){

		$dr = new Drink;


		$data = [];
		//$data['ingredients'] = 
		$data['page_title'] = "Add a cocktail";
		$data['glasses'] = $dr->getUniqueGlasses();


		return view('admin.add_drink', $data);


	}

	public function createDrink(){

		$dr = new Drink;

		$dr->drink_name 	= Request::input('drink_name');
		$dr->glass      	= Request::input('glass');
		$dr->is_top_drink 	= Request::input('top_drink');

		$dr->save();

	}


	public function register(){
		return view('auth.register');
	}


}
