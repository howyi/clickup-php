<?php

namespace ClickUp;

use ClickUp\Objects\TaskCollection;
use ClickUp\Objects\TaskFinder;
use ClickUp\Objects\Team;
use ClickUp\Objects\TeamCollection;
use ClickUp\Objects\User;

class Client
{
	private $guzzleClient;

	public function __construct($apiToken)
	{
		$this->guzzleClient = new \GuzzleHttp\Client([
			'base_uri' => 'https://api.clickup.com/api/v1/',
			'headers' => [
				'Authorization' => $apiToken,
			]
		]);
	}

	public function client()
	{
		return $this;
	}

	/**
	 * @return User
	 */
	public function user()
	{
		return new User(
			$this,
			$this->get('user')['user']
		);
	}

	/**
	 * @return TeamCollection
	 */
	public function teams()
	{
		return new TeamCollection(
			$this,
			$this->get('team')['teams']
		);
	}

	/**
	 * @param int $teamId
	 * @return Team
	 */
	public function team($teamId)
	{
		return new Team(
			$this,
			$this->get("team/$teamId")['team']
		);
	}

	/**
	 * @param int $projectId
	 * @param array $body
	 * @return array
	 */
	public function createTaskList($projectId, $body)
	{
		return $this->post(
			"project/$projectId/list",
			$body
		);
	}

	/**
	 * @param int   $taskListId
	 * @param array $body
	 * @return array
	 */
	public function editTaskList($taskListId, $body)
	{
		return $this->put(
			"list/$taskListId",
			$body
		);
	}

	/**
	 * @param int $teamId
	 * @return TaskFinder
	 */
	public function taskFinder($teamId)
	{
		return new TaskFinder($this, $teamId);
	}

	/**
	 * @param int $taskListId
	 * @param array $body
	 * @return array
	 */
	public function createTask($taskListId, $body)
	{
		return $this->post(
			"list/$taskListId/task",
			$body
		);
	}

	public function editTask($taskId, $body)
	{
		return $this->put(
			"task/$taskId",
			$body
		);
	}

	/**
	 * @param string $method
	 * @param array  $params
	 * @return mixed
	 */
	public function get($method, $params = [])
	{
		return \GuzzleHttp\json_decode($this->guzzleClient->request('GET', $method, ['query' => $params])->getBody(), true);
	}

	/**
	 * @param string $method
	 * @param array $body
	 * @return mixed
	 */
	public function post($method, $body = [])
	{
		return \GuzzleHttp\json_decode($this->guzzleClient->request('POST', $method, ['json' => $body])->getBody(), true);
	}

	/**
	 * @param string $method
	 * @param array $body
	 * @return mixed
	 */
	public function put($method, $body = [])
	{
		return \GuzzleHttp\json_decode($this->guzzleClient->request('PUT', $method, ['json' => $body])->getBody(), true);
	}
}
