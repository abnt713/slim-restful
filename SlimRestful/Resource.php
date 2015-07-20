<?php
	
namespace SlimRestful;

abstract class SlimRestfulResource{
	
	private $conditions;
	private $middlewares;
	
	public function __construct(){
		$this->conditions = array();
		$this->middlewares = array();
	}
	
	public function getConditions(){
		return $this->conditions;
	}
	
	public function addCondition($field, $condition){
		$this->conditions[$field] = $condition;
	}
	
	public function setConditions($conditions){
		$this->conditions = $conditions;
	}
	
	public function getMiddlewares(){
		return $this->middlewares;
	}
	
	public function addMiddleware($middleware){
		$this->middlewares[] = $middleware;
	}
	
	public function setMiddlewares($middlewares){
		$this->middlewares = $middlewares;
	}
	
}