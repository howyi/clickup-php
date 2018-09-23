<?php

namespace ClickUp;

use ClickUp\Objects\Project;
use ClickUp\Objects\ProjectCollection;
use ClickUp\Objects\SpaceCollection;
use ClickUp\Objects\TaskCollection;
use ClickUp\Objects\TaskFinderTrait;
use ClickUp\Objects\Team;
use ClickUp\Objects\TeamCollection;
use ClickUp\Objects\User;

class Client
{
	use TaskFinderTrait;

	private $guzzleClient;

	public function __construct($token)
	{
		$this->guzzleClient = new \GuzzleHttp\Client([
			'base_uri' => 'https://api.clickup.com/api/v1/',
			'headers' => [
				'Authorization' => $token,
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
	 * @param $teamId
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
	 * @param int $teamId
	 * @return SpaceCollection
	 */
	public function spaces($teamId)
	{
		$collection = new SpaceCollection(
			$this,
			$this->get("team/$teamId/space")['spaces']
		);
		$collection->setTeamId($teamId);
		return $collection;
	}

	public function space($teamId, $spaceId)
	{
		return $this->spaces($teamId)->getByKey($spaceId);
	}

	/**
	 * @param int $spaceId
	 * @return ProjectCollection
	 */
	public function projects($spaceId)
	{
		$collection = new ProjectCollection(
			$this,
			$this->get("space/$spaceId/project")['projects']
		);
		$collection->setSpaceId($spaceId);
		return $collection;
	}

	/**
	 * @param $spaceId
	 * @param $projectId
	 * @return Project
	 */
	public function project($spaceId, $projectId)
	{
		return $this->projects($spaceId)->getByKey($projectId);
	}

	/**
	 * @param $spaceId
	 * @param $projectId
	 * @return Objects\TaskListCollection
	 */
	public function taskLists($spaceId, $projectId)
	{
		return $this->project($spaceId, $projectId)->taskLists();
	}

	/**
	 * @param $spaceId
	 * @param $projectId
	 * @param $taskListId
	 * @return Objects\TaskList
	 */
	public function taskList($spaceId, $projectId, $taskListId)
	{
		return $this->taskLists($spaceId, $projectId)->getByKey($taskListId);
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
	 * @param $taskListId
	 * @param $body
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
	 * @param int   $teamId
	 * @param array $params
	 * @return TaskCollection
	 */
	public function getTasks($teamId, $params)
	{
		return new TaskCollection(
			$this,
			$this->get("team/$teamId/task", $params)['tasks'],
			$teamId
		);
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
	private function get($method, $params = [])
	{
		return \GuzzleHttp\json_decode($this->guzzleClient->request('GET', $method, ['query' => $params])->getBody(), true);
	}

	/**
	 * @param string $method
	 * @param array $body
	 * @return mixed
	 */
	private function post($method, $body = [])
	{
		return \GuzzleHttp\json_decode($this->guzzleClient->request('POST', $method, ['json' => $body])->getBody(), true);
	}

	/**
	 * @param string $method
	 * @param array $body
	 * @return mixed
	 */
	private function put($method, $body = [])
	{
		return \GuzzleHttp\json_decode($this->guzzleClient->request('PUT', $method, ['json' => $body])->getBody(), true);
	}

	public function guzzleClient()
	{
		return $this->guzzleClient;
	}
}
