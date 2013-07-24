<?php

class Brain{

	private $nnLayers = array();
	
	public function Brain($json){
		$nnArray = json_decode($json);
		
		$this->addNeuronsToLayers($nnArray);
	}
	
	
	private function addNeuronsToLayers($json){
		foreach($json->layers as $layerIdx=>$layer){
			if($layerIdx==0){ // input layer
				$layerTmp = array();
				foreach($layer as $k=>$v){
					$layerTmp[$k] = array();
				}
				$this->nnLayers[] = $layerTmp;
			}elseif($layerIdx<count($json->layers)){ // hidden layers
				$layerTmp = array();
				foreach($layer as $k=>$v){
					$layerTmp[$k] = new BrainNeuron($v->bias,$v->weights);
				}
				$this->nnLayers[] = $layerTmp;
			}
			
		}
	}
	
	public function run($input){
		foreach($this->nnLayers as $layerIdx=>$layer){
			if($layerIdx==0){
				continue; // skip input layer
			}elseif($layerIdx<count($this->nnLayers)-1){ // hidden leyers
				$nxtInput = array();
				foreach($layer as $nodeIdx=>$node){
					$nxtInput[$nodeIdx] = $node->run($input);
				}
				$input = $nxtInput;
			}else{ // output layer
				$nxtInput = array();
				foreach($layer as $nodeIdx=>$node){
					$nxtInput[$nodeIdx] = $node->run($input);
				}
				return $nxtInput;
			}
			
			
		}
	}
}

class BrainNeuron{
	private $bias;
	private $weights;
	
	public function BrainNeuron($bias,$weights){
		$this->bias = $bias;
		$this->weights = $weights;
	}
	
	public function run($input){
		$sum = $this->bias;
		foreach($this->weights as $k=>$v){
			$sum += $input[$k] * $v;
		}
		return 1 / (1 + exp ( $sum * -1 ));
	}
}