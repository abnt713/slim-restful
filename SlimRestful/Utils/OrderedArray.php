<?php

namespace SlimRestful\Utils;

class OrderedArray{

    private $order;
    private $elements;

    public function __construct(){
        $this->order = array();
        $this->elements = array();
    }

    public function getElements(){
        return $this->elements;
    }
    
    public function getOrder(){
        return $this->order;
    }
    
    public function getElement($index){
        return (isset($this->elements[$index]) ? $this->elements[$index] : null);
    }

    public function addElement($index, $element){
        $this->addSimpleElement($index, $element);
        $this->order[] = $index;
    }
    
    public function updateOrderIndex($oldOrderIndex, $newOrderIndex){
        $i = $this->getOrderIndex($oldOrderIndex);
        $this->order[$i] = $newOrderIndex;
    }
    
    public function addSimpleElement($index, $element){
        $this->elements[$index] = $element;
    }
    
    public function removeElement($index){
        // $i = $this->getOrderIndex($index);
        unset($this->elements[$index]);
    }
    
    private function getOrderIndex($routeIndex){
        foreach($this->order as $i => $index){
            if($index == $routeIndex){
                return $i;
            }
        }
    }
}
