<?php

namespace SlimRestful;

abstract class Resource{

	private $prefix;
	private $route;
	private $conditions;
	private $middlewares;

	public function __construct(){
		$this->prefix = null;
		$this->route = null;
		$this->conditions = array();
		$this->middlewares = array();
	}

	public function setPrefix($prefix){
		$this->prefix = $prefix;
		return $this;
	}

	public function setRoute($route){
		$this->route = $route;
		return $this;
	}

	public function getRoute(){
		return $this->route;
	}

	public function getApp(){
		return $this->getApi()->getSlimApp();
	}

	public function getApi(){
		return $this->getPrefix()->getSlimRestfulInstance();
	}

	public function getPrefix(){
		return $this->prefix;
	}

	public function getConditions(){
		return $this->conditions;
	}

	public function addCondition($field, $condition){
		$this->conditions[$field] = $condition;
		return $this;
	}

	public function setConditions($conditions){
		$this->conditions = $conditions;
		return $this;
	}

	public function getMiddlewares(){
		return $this->middlewares;
	}

	public function addMiddleware($middleware){
		$this->middlewares[] = $middleware;
		return $this;
	}

	public function mergeMiddlewares($middlewares){
		$merged = array_merge($this->middlewares, $middlewares);
		$this->middlewares = $merged;
		return $this;
	}

	public function setMiddlewares($middlewares){
		$this->middlewares = $middlewares;
		return $this;
	}

	protected function render($template, $data = array(), $status = null){
		$this->getApp()->render($template, $data, $status);
	}

}
