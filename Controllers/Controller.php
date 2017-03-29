<?php namespace Controllers;

	abstract class Controller{
		private $vista;

		public function __construct(Request $request){
			
		}
		public function test(){
			$arrayn = array('lol','lol');
			return $arrayn;
		}
	}
?>