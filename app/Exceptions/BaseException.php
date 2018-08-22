<?php
namespace App\Exceptions;

/**
 * 
 */
abstract class BaseException extends \Exception
{
	
	public function __construct($messsage, $code)
	{
		parent::__construct($messsage, $code);
	}

	public function getErrors()
	{
		return $this->getMessage();
	}
}
