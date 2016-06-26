<?php namespace Backoffice\Repositories;

use Backoffice\Entities\Comment;

class CommentRepository extends BaseRepository
{
	public function getModel()
	{
		return new Comment;
	}


	public function findById($id)
	{
		return Comment::find($id);
	}

	public function find($take, $skip, $sort, $filter)
	{ 
		return Comment::select('id', 'user_id', 'location_id', 'comment', 'block', 'created_at')
						->skip($skip)
						->take($take)
						->orderBy($sort['field'], $sort['order'])		
						->get();
	}

	public function findByLocation($locationId)
	{
		return Comment::select('comments.comment', 'comments.created_at',\DB::raw('CONCAT(users.first_name, " ",users.last_name) as user'))
						->join('users','users.id', '=', 'comments.user_id')
						->where('location_id', '=', $locationId)
						->where('block', '=', 0)
						->orderBy('created_at', 'DESC')
						->get()->toArray();
	}

	public function count($filter)
	{
		return  Comment::count();
	}
}