<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


	public function getListRequest()
	{
		//Sort
		$fieldCol = Input::get('iSortCol_0', '');
		$field 	  = Input::get('mDataProp_'.$fieldCol, 'id');
		$order 	  = Input::get('sSortDir_0', 'DESC');
		$sort 	  = ['field'=>$field, 'order'=>$order];
		
		//Take
		$take = intval(Config::get('app.list.take'));

		//Skip
		$skip = intval(Input::get('iDisplayStart',0));

		$filter = '';	

		return ['sort'=>$sort, 'take'=>$take, 'skip'=>$skip, 'filter'=>$filter];
	}


	/**
	 * Genera la respuesta para las listas
	 * @param  array $list
	 * @param  int $total 
	 * @return Response       
	 */
	public function makeListResponse($list, $total)
	{
		$data = [
			'aaData' 				=> $list,
			"iTotalRecords" 		=> count($list),
		    "iTotalDisplayRecords" 	=> $total,
		];

		return Response::json($data);
	}
}
