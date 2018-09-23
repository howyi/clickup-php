<?php

namespace ClickUp\Objects;

use ClickUp\Client;

/**
 * @method Task   getByKey(int $spaceId)
 * @method Task   getByName(string $spaceName)
 * @method Task[] objects()
 * @method Task[] getIterator()
 */
class TaskCollection extends AbstractObjectCollection
{
	public function __construct(Client $client, $array, $teamId)
	{
		parent::__construct($client, $array);
		$this->setTeamId($teamId);
	}

	/**
	 * @return string
	 */
	protected function objectClass()
	{
		return Task::class;
	}

	public function setTeamId($teamId) {
		foreach ($this as $task) {
			$task->setTeamId($teamId);
		}
	}
}
