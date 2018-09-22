<?php

namespace ClickUp\Objects;

use ClickUp\Client;

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
	public function get()
	{
		return $this->client->getTasks($this->teamId, $this->params);
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
