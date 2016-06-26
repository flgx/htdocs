<?php namespace Backoffice\Managers;


class ValidationException extends \Exception
{
	protected $erros;

	public function __construct($message, $errors)
	{
		parent::__construct($message);
		
		$this->errors = $errors;
	}

	public function getErrors()
	{
		return $this->errors;
	}

}