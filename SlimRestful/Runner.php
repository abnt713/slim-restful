<?php
	

namespace SlimRestful;	

class Runner{
	
	private $methods;
	
	public function __construct(){
		$this->methods = array(
			'get', 'post', 'put', 'delete', 'options', 'patch'
		);
	}
	
	public function run($srInstance){
		$slimApp = $srInstance->getSlimApp();
		$allPrefixes = $srInstance->getPrefixes();
		foreach($allPrefixes as $prefix){
			$this->handlePrefix($slimApp, $prefix);
		}
		
		$slimApp->run();
	}
	
	private function handlePrefix($app, $prefix){
		$allResources = $prefix->getResources();
		foreach($allResources as $resroute => $resource){
			$route = $prefix->getRoutePrefix() . $resroute;
			$this->handleResource($app, $route, $resource);
		}
	}
	
	private function handleResource($app, $route, $resource){
		foreach($this->methods as $method){
			$this->addRouteIfMethodExists($app, $route, $resource, $method);
		}
	}
	
	private function addRouteIfMethodExists($app, $route, $resource, $method){
		if(method_exists($resource, $method)){
			$routeArray = array($route);
			$middlewares = $resource->getMiddlewares();
			$function = array(array($resource, $method));
			
			$params = array_merge($routeArray, $middlewares, $function);
			$appInstance = call_user_func_array(array($app, $method), $params);
			$appInstance->conditions($resource->getConditions());
		}
	}
	
}