<?php

namespace ClickUp\Objects;

use ClickUp\Client;

trait TaskFinderTrait
{
	/**
	 * @return TaskFinder
	 */
	public function tasks()
	{
		return (new TaskFinder(
			$this->client(),
			$this->teamId()
		))->addParams($this->taskFindParams());
	}

	/**
	 * @return int
	 */
	abstract public function teamId();

	/**
	 * @return Client
	 */
	abstract public function client();

	/**
	 * @return array
	 */
	protected function taskFindParams()
	{
		return [];
	}
}
