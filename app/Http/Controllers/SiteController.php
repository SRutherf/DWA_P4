<?php

    namespace App\Http\Controllers;

	use App\User;
	use App\Http\Controllers\Controller;
	use Request; //facade for illuminate\http\facade
	use DB; //database facade
	
	class SiteController extends Controller{
		public static function showWelcome(){
			return view('home');
		}
		
		//public static function showLogin(){
		//	return view('home');
		//}
		
		public static function showSlope(){
			if(\Auth::check()){
				return view('slope');
			}
			else{
				return view('home');
			}
		}
			
		public static function showShop(){
			if(\Auth::check()){
				return view('shop');
			}
			else{
				return view('home');
			}
		}
	}
?>