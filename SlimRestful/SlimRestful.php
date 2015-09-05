<?php

namespace SlimRestful;

class SlimRestful{

	private $app;
	private $prefixes;
	private $rootPrefix;

	public function __construct(\Slim\Slim $app){
		$this->app = $app;
		$this->prefixes = new \SlimRestful\Utils\OrderedArray();
		$this->rootPrefix = new Prefix('');
		$this->addSRPrefix($this->rootPrefix);
	}

	public function getSlimApp(){
		return $this->app;
	}

	public function getApp(){
		return $this->getSlimApp();
	}

	public function getRawPrefixes(){
		return $this->prefixes;
	}

	public function getPrefixes(){
		return $this->prefixes->getElements();
	}

	public function prefix($routePrefix = ''){
		if($routePrefix == ''){
			return $this->rootPrefix;
		}

		$prefix = new Prefix($routePrefix);
		$this->addSRPrefix($prefix);

		return $prefix;
	}

	public function getPrefix($routeIndex){
		return $this->prefixes->getElement($routeIndex);
	}

	public function addPrefix(Prefix $prefix){
		$this->addSRPrefix($prefix);
		return $this;
	}

	public function removePrefix($routePrefix){
		$this->prefixes->removeElement($routePrefix);
		return $this;
	}

	public function getPrefixedResource($routePrefix, $route){
		$prefix = $this->prefixes->getElement($routePrefix);
		if(is_null($prefix)){
			return null;
		}

		return $prefix->getResource($route);
	}

	public function run(){
		$runner = new Runner();
		$runner->run($this);
	}

	public function callLoader($loader, $params = array()){
		$loader->load($this, $params);
		return $this;
	}

	public function changeRoutePrefix($oldRoutePrefix, $newRoutePrefix, $updatePrefixInstance = true){
		$prefix = $this->prefixes->getElement($oldRoutePrefix);
		if(is_null($prefix)){
			return false;
		}

		if($updatePrefixInstance){
			$prefix->setRoutePrefix($newRoutePrefix, false);
		}

		$this->prefixes->removeElement($oldRoutePrefix);
		$this->prefixes->addSimpleElement($newRoutePrefix, $prefix);
		$this->prefixes->updateOrderIndex($oldRoutePrefix, $newRoutePrefix);
		return $this;
	}

	public function addResource($route, Resource $resource){
		$this->rootPrefix->addResource($route, $resource);
	}

	private function addSRPrefix(Prefix $prefix){
		$this->prefixes->addElement($prefix->getRoute(), $prefix);
		$prefix->setSlimRestfulInstance($this);
	}

}
