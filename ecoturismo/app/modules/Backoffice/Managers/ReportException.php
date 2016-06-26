<?php namespace Backoffice\Managers;


class ReportException extends \Exception
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