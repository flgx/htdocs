<?php namespace Backoffice\Managers;


abstract class BaseManager
{
	public $entity;

	protected $data;
	protected $scenario;
	protected $validation;
	protected $uploadFile = false;

	public function __construct($entity = null, $data = [], $scenario = null) 
	{  
		$this->initialize();
		
		$this->entity 	= $entity;
		$this->scenario = $scenario;
		$this->rules  	= $this->getRules();
		$this->data   	= array_only($data, array_keys($this->rules));
	}

	abstract public function getRules();

	public function initialize(){}

	public function setScenario($scenario)
	{
		$this->scenario = $scenario;
	}

	public function getEntity()
	{
		return $this->entity;
	}

	public function isValid()
	{   
		$this->validation = \Validator::make($this->data, $this->getRules());

		if($this->validation->fails())
		{   
			throw new ValidationException("Valiation Fail", $this->validation->messages());			
		}
	}

    public function prepareData($data)
    {
        return $data;
    }
    
	public function save()
	{ 
        $this->isValid();
        $this->entity->fill($this->prepareData($this->data));

        $this->entity->save();

        if($this->uploadFile) {
        	if( ! $this->upload() ) {
        		throw new ValidationException("Validation Fail", "No se ha podido guardar el archivo");
        	}
        }

        return true;
	}

	//TODO:: manejar multiples archivos, opcion de base de datos no siempre puede ir a una base y borrar la foto vieja si corresponde
	public function upload()
	{
		$field 		 = $this->getUploadField();
		$newName  	 = $this->getUploadNewName();
		//$destination = 'assets/images/location';	
		$destination = $this->getUploadDestination();

		if (\Input::hasFile($field))
		{
		    \Input::file($field)->move($destination, $newName);
		}
		
		$this->entity->fill([$field => $newName]);
		$this->entity->save();

		return true;
	}

}