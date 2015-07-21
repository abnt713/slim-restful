<?php

namespace SlimRestful;

class SlimRestful{

	private $app;
	private $prefixes;

	public function __construct(\Slim\Slim $app){
		$this->app = $app;
		$this->prefixes = new \SlimRestful\Utils\OrderedArray();
	}

	public function getSlimApp(){
		return $this->app;
	}

	public function getPrefixes(){
		return $this->prefixes->getElements;
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

	public function callLoader($loader, $params = array()){
		$loader->load($this, $params);
	}

	private function addSRPrefix(Prefix $prefix){
		$this->prefixes->addElement($prefix->getRoutePrefix(), $prefix);
		$prefix->setSlimRestfulInstance($this);
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
	}

}
