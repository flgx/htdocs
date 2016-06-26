<?php namespace Backoffice\Repositories;

use Backoffice\Entities\Ranking;

class RankingRepository extends BaseRepository
{
	public function getModel()
	{
		return new Ranking;
	}

	public function calculateRanking($locationId)
	{
		$dataRanking = Ranking::select(\DB::raw('sum(ranking) all_ranking'),\DB::raw('count(ranking) cant_votes'))
							->where('location_id', '=', $locationId)->get()->toArray();

		if(isset($dataRanking[0]['all_ranking'])) {
			return round($dataRanking[0]['all_ranking'] / $dataRanking[0]['cant_votes']);
		}

		return 0;
	}
}