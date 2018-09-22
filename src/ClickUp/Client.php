<?php

namespace ClickUp;

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

	/**
	 * @param int $spaceId
	 * @return ProjectCollection
	 */
	public function projects($spaceId)
	{
		return new ProjectCollection(
			$this,
			$this->get("space/$spaceId/project")['projects']
		);
	}

	public function createList($projectId, $body)
	{
	}

	public function editList($projectId, $body)
	{
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
			$this->get("team/$teamId/task", $params)['tasks']
		);
	}

	public function createTask($listId, $body)
	{
	}

	public function editTask($taskId, $body)
	{
	}

	/**
	 * @param string $method
	 * @param array  $params
	 * @return mixed
	 */
	public function get($method, $params = [])
	{
		dump("request : $method");
		dump($params);
		return \GuzzleHttp\json_decode($this->guzzleClient->request('GET', $method, ['query' => $params])->getBody(), true);
	}

	public function post($method, $body = [])
	{
	}

	public function put($method, $body = [])
	{
	}

	public function delete($method, $params = [])
	{
	}

	public function guzzleClient()
	{
		return $this->guzzleClient;
	}
}
