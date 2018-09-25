<?php

namespace ClickUp\Objects;

use ClickUp\Client;

/**
 * @see https://jsapi.apiary.io/apis/clickup/reference/0/task/get-tasks.html
 */
class TaskFinder
{
	/* @var Client $client */
	private $client;

	/* @var int $teamId */
	private $teamId;

	/* @var array $params */
	private $params = [];

	/**
	 * @param Client $client
	 * @param int    $teamId
	 */
	public function __construct(Client $client, $teamId)
	{
		$this->client = $client;
		$this->teamId = $teamId;
	}

	/**
	 * @return TaskCollection
	 */
	public function getCollection()
	{
		return new TaskCollection(
			$this->client,
			$this->client->get("team/{$this->teamId}/task",  $this->params)['tasks'],
			$this->teamId
		);
	}

	/**
	 * @param $taskId
	 * @return Task
	 */
	public function getByTaskId($taskId)
	{
		return $this
			->includeSubTask()
			->includeClosed()
			->addParams(['task_ids' => [$taskId]])
			->getCollection()
			->getByKey($taskId);
	}

	public function includeSubTask($include = true)
	{
		$this->addParams(['subtasks' => $include]);
		return $this;
	}

	public function includeClosed($include = true)
	{
		$this->addParams(['include_closed' => $include]);
		return $this;
	}

	public function addParams($params)
	{
		$this->params = array_merge_recursive($this->params, $params);
		return $this;
	}

	public function resetParams()
	{
		$this->params = [];
	}
}
