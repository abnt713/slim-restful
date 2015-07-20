<?php

namespace SlimRestful;

class SlimRestful{
	
	private $app;
	private $prefixes;
	
	public function __construct(\Slim\Slim $app){
		$this->app = $app;
		$this->prefixes = array();
	}
	
	public function getSlimApp(){
		return $this->app;
	}
	
	public function getPrefixes(){
		return $this->prefixes;
	}
	
	public function createPrefix($routePrefix){
		$prefix = new Prefix($routePrefix);
		$this->addSRPrefix($prefix);
		
		return $prefix;
	}
	
	public function addPrefix(Prefix $prefix){
		$this->addSRPrefix($prefix);
	}
	
	public function removePrefix($routePrefix){
		if(isset($this->prefixes[$routePrefix])){
			unset($this->prefixes[$routePrefix]);
			return true;
		}else{
			return false;
		}
	}
	
	public function run(){
		$runner = new Runner();
		$runner->run($this);
	}
	
	private function addSRPrefix(Prefix $prefix){
		$this->prefixes[$prefix->getRoutePrefix()] = $prefix;
		$prefix->setSlimRestfulInstance($this);
	}
	
	public function changeRoutePrefix($oldRoutePrefix, $newRoutePrefix, $changePrefixInstance = false){
		/* I'll think about this later :P */
	}
	
}