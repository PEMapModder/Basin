<?php

namespace SOFe\Basin;

class TransferAgentsManager{
	private $main;
	private $agents = [];
	private $defaultAgent;
	public function __construct(Basin $main){
		$this->main = $main;
	}
	/**
	  * Registers a TransferAgent
	  *
	  * @return The Agent's saved name. This may be different from the Agent's real name due to collision.
	  */
	public function registerTransferAgent(TransferAgent $agent){
		if($agent->isReady()){
			if(isset($this->agents[$agent->getName()])){
				throw new \Exception("Tried to register ".$agent->getName()." twice.");
			}
			$this->agents[$agent->getName()] = $agent;
			return $agent->getName();
		}
		return false;
	}
	public function setDefaultAgent(string $agentName){
		if(!isset($this->agents[$agentName])){
			return false;
		}
		$this->defaultAgent = $agentName;
		return true;
	}
	public function getAgent(string $agentName){
		if(!isset($this->agents[$agentName])){
			return false;
		}
		return $this->agents[$agentName];
	}
	public function getDefaultAgent(){
		return $this->agents[$this->defaultAgent];
	}
}