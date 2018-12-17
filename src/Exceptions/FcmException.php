<?php

namespace MuhBayu\Fcm\Exception;
/**
 * FcmException
 */
class FcmException extends Exception
{	
	function __construct($msg=null)
	{
		$this->message = $msg;
	}
	public function errorMessage()
	{
		return 'Error on line '.$this->getLine().' in'.$this->getFile()." $this->message";
	}
}