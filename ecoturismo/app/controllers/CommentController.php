<?php

use Backoffice\Repositories\CommentRepository;
use Backoffice\Managers\CommentManager;

class CommentController extends \BaseController {

	private $commentRepository;

	public function __construct(CommentRepository $commentRepository)
	{
		$this->commentRepository = $commentRepository;
	}

	/**
	 * Display a Modulesting of the resource.
	 * GET /comment
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('backoffice.comment.index');
	}

	/**
	 * Display a List of the resource.
	 * GET /comment/list
	 *
	 * @return Response
	 */
	public function lists()
	{   
		$input 	  	= $this->getListRequest();		
		$comments 	= $this->commentRepository->find($input['take'], $input['skip'], $input['sort'], $input['filter']);
		$total    	= $this->commentRepository->count($input['filter']);

		return $this->makeListResponse($comments, $total);
	}

	public function block($id)
	{
		$comment = $this->commentRepository->findById($id);
		$manager = new CommentManager($comment, Input::all(), 'block');

		$manager->save();

		return Response::json(['success'=> true]);
	}

	public function unblock($id)
	{
		$comment = $this->commentRepository->findById($id);
		$manager = new CommentManager($comment, Input::all(), 'unblock');

		$manager->save();

		return Response::json(['success'=> true]);
	}

}