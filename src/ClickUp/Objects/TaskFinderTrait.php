<?php

namespace ClickUp\Objects;

use ClickUp\Client;

trait TaskFinderTrait
{
	/**
	 * @param int|null $teamId
	 * @return TaskFinder
	 */
	public function tasks($teamId = null)
	{
		if (is_null($teamId)) {
			$teamId = $this->teamId();
		}
		return (new TaskFinder(
			$this->client(),
			$teamId
		))->addParams($this->taskFindParams());
	}

	/**
	 * @return int|null
	 */
	public function teamId()
	{
		return null;
	}

	/**
	 * @return Client
	 */
	abstract public function client();

	/**
	 * @return array
	 */
	public function taskFindParams()
	{
		return [];
	}
}
