<?php namespace Backoffice\Managers;

use Backoffice\Repositories\LocationRepository;

class ReportManager
{
	protected $locationRepository;
	protected $data;
	protected $rules;

	public function __construct($data)
	{
		$this->locationRepository  	= new LocationRepository;
		$this->data 				= $data;
		$this->rules 				= $this->getRules();
	}

	public function getRules()
	{
		$rules = [
			'report'	=> 'required',
			'start'		=> 'required|date_format:d/m/Y',
			'end'		=> 'required|date_format:d/m/Y',
			'type'		=> 'in:csv',	
		];

		return $rules;
	}

	public function isValid()
	{
		$validation = \Validator::make($this->data, $this->rules);

		if($validation->fails())
		{
			throw new ReportException("Valiation Fail", $validation->messages());			
		}
	}

	public function generate()
	{ 
		$this->isValid();

		$data = $this->getData($this->data['report'], $this->data['start'], $this->data['end']);

		
		return $data;
	}

	public function getData($report, $startDate, $endDate)
	{
		$startDate 	= dateEuropeToMySql($startDate);
		$endDate 	= dateEuropeToMySql($endDate);

		switch($report) {
			case 'views':
					$data = $this->locationRepository->findViewsLocationByReport($startDate, $endDate);		
					array_unshift($data, ['Id', 'Nombre', 'Habilitado', 'Total Visitas', 'Creado']);	
				break;

			case 'ranking':
					$data = $this->locationRepository->findRankingLocationByReport($startDate, $endDate);	
					array_unshift($data, ['Id', 'Nombre', 'Habilitado', 'ranking sobre 5', 'Creado']);			
				break;

			default:
				$data = [];
		}	

		return $data;
	}

}