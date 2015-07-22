<?php
	
namespace SlimRestful;

class Prefix{
	
	private $slimRestfulInstance;
	private $routePrefix;
	private $resources;
	private $middlewares;
	
	public function __construct($routePrefix){
		$this->routePrefix = $routePrefix;
		$this->resources = array();
		$this->middlewares = array();
	}
	
	public function getRoutePrefix(){
		return $this->routePrefix;
	}
	
	public function setSlimRestfulInstance($srInstance){
		$this->slimRestfulInstance = $srInstance;
		return $this;
	}
	
	public function getSlimRestfulInstance(){
		return $this->slimRestfulInstance;
	}
	
	public function addResource($route, Resource $resource){
		$resource->setRoute($route);
		$resource->setPrefix($this);
		$this->resources[$route] = $resource;
		return $resource;
	}
	
	public function removeResource($route){
		unset($this->resources[$route]);
		return $this;
	}
	
	public function addMiddleware($middleware){
		$this->middlewares[] = $middleware;
		return $this;
	}
	
	public function preRun(){
		foreach($this->resources as $resource){
			$resource->mergeMiddlewares($this->middlewares);
		}
	}
	
	public function getResource($route){
		return (isset($this->resources[$route]) ? $this->resources[$route] : null);
	}
	
	public function getResources(){
		return $this->resources;
	}
	
	public function setRoutePrefix($routePrefix, $updateSlimRestfulInstance = true){
		if($updateSlimRestfulInstance){
			$this->slimRestfulInstance->changeRoutePrefix($this->routePrefix, $routePrefix, false);	
		}
		$this->routePrefix = $routePrefix;
		return $this;
	}
	
}