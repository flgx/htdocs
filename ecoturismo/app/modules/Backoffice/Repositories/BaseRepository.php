<?php namespace Backoffice\Repositories;


abstract class BaseRepository
{

	protected $model;

	public function __construct()
	{
		$this->model = $this->getModel();
	}

	abstract public function getModel();
}