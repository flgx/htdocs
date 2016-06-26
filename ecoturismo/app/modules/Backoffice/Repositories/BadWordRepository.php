<?php namespace Backoffice\Repositories;

use Backoffice\Entities\BadWord;

class BadWordRepository extends BaseRepository
{
	const _CONFIG_ID = 1;

	public function getModel()
	{
		return new BadWord;
	}

	public function findConfig()
	{
		return BadWord::find(self::_CONFIG_ID);
	}

	public function exists($text)
	{
		$badWordsConfig = $this->findConfig();
		$text 			= strtolower($text);
		$badWords 		= explode(",", $badWordsConfig->words);

		foreach($badWords as $badWord)
		{
			if(stristr($text, $badWord) !== FALSE) {
				return true;
			}
		}
		
		return false;
	}
}