<?php
namespace App/Form;
class Form{
	private $data;
	public $surround = 'p';
	
	public function __construct($data){
		$this->data = $data;
	}
	
	public function surround($tag){
		
	}
	public function input($name){
		
		return $this->surround('<input type="text" name="'. $name .'">');
	}
	public function submit(){
		return $this->surround('<button type="submit"> Envoyer </button>');
	}
}

?>