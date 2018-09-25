<?php

namespace ClickUp\Objects;

class Task extends AbstractObject
{
	use TaskFinderTrait;

	/* @var string $id*/
	private $id;

	/* @var string $name */
	private $name;

	/* @var string $description */
	private $description;

	/* @var Status $status */
	private $status;

	/* @var string $orderindex */
	private $orderindex;

	/* @var \DateTimeImmutable $dateCreated */
	private $dateCreated;

	/* @var \DateTimeImmutable $dateUpdated */
	private $dateUpdated;

	/* @var TeamMember $creator */
	private $creator;

	/* @var TeamMemberCollection $assignees */
	private $assignees;

	/* @var array $tags */
	private $tags;

	/* @var string|null $parentTaskId */
	private $parentTaskId;

	/* @var Task|null $parentTask */
	private $parentTask = null;

	/* @var int $priority */
	private $priority;

	/* @var \DateTimeImmutable $dueDate */
	private $dueDate;

	/* @var \DateTimeImmutable $startDate */
	private $startDate;

	/* @var int $points */
	private $points;

	/* @var string $timeEstimate */
	private $timeEstimate;

	/* @var int $taskListId */
	private $taskListId;

	/* @var TaskList|null $taskList */
	private $taskList = null;

	/* @var int $projectId */
	private $projectId;

	/* @var Project|null $project */
	private $project = null;

	/* @var int $spaceId */
	private $spaceId;

	/* @var Space|null $project */
	private $space = null;

	/* @var int $teamId */
	private $teamId;

	/* @var Team|null $project */
	private $team = null;

	/* @var string $url */
	private $url;

	/**
	 * @return int
	 */
	public function id()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function name()
	{
		return $this->name;
	}

	public function description()
	{
		return $this->description;
	}

	public function status()
	{
		return $this->status;
	}

	public function orderindex()
	{
		return $this->orderindex;
	}

	public function dateCreated()
	{
		return $this->dateCreated;
	}

	public function dateUpdated()
	{
		return $this->dateUpdated;
	}

	public function creator()
	{
		return $this->creator;
	}

	public function assignees()
	{
		return $this->assignees;
	}

	public function tags()
	{
		return $this->tags;
	}

	public function parentTaskId()
	{
		return $this->parentTaskId;
	}

	public function isSubTask()
	{
		return !is_null($this->parentTaskId());
	}

	/**
	 * @return Task|null
	 */
	public function parentTask()
	{
		if (is_null($this->parentTaskId())) {
			return null;
		}
		if (is_null($this->parentTask)) {
			$this->parentTask = $this
				->tasks()
				->getByTaskId($this->parentTaskId());
		}
		return $this->parentTask;
	}

	public function priority()
	{
		return $this->priority;
	}

	public function dueDate()
	{
		return $this->dueDate;
	}

	public function startDate()
	{
		return $this->startDate;
	}

	public function points()
	{
		return $this->points;
	}

	public function timeEstimate()
	{
		return $this->timeEstimate;
	}

	public function taskListId()
	{
		return $this->taskListId;
	}

	/**
	 * @return TaskList
	 */
	public function taskList()
	{
		if (is_null($this->taskList)) {
			$this->taskList = $this->project()->taskList($this->taskListId());
		}
		return $this->taskList;
	}

	public function projectId()
	{
		return $this->projectId;
	}

	/**
	 * @return Project
	 */
	public function project()
	{
		if (is_null($this->project)) {
			$this->project = $this->space()->project($this->projectId());
		}
		return $this->project;
	}

	/**
	 * @return int
	 */
	public function spaceId()
	{
		return $this->spaceId;
	}

	/**
	 * @return Space
	 */
	public function space()
	{
		if (is_null($this->space)) {
			$this->space = $this->team()->space($this->spaceId());
		}
		return $this->space;
	}

	public function teamId()
	{
		return $this->teamId;
	}

	public function setTeamId($teamId)
	{
		$this->teamId = $teamId;
	}

	/**
	 * @return Team
	 */
	public function team()
	{
		if (is_null($this->team)) {
			$this->team = $this->client()->team($this->teamId());
		}
		return $this->team;
	}

	/**
	 * @see https://jsapi.apiary.io/apis/clickup/reference/0/task/edit-task.html
	 * @param array $body
	 * @return array
	 */
	public function edit($body)
	{
		return $this->client()->put(
			"task/{$this->id()}",
			$body
		);
	}

	/**
	 * @param $array
	 * @throws \Exception
	 */
	protected function fromArray($array)
	{
		$this->id = $array['id'];
		$this->name = $array['name'];
		$this->description = (string) $array['text_content'];
		$this->status = new Status(
			$this->client(),
			$array['status']
		);
		$this->orderindex = $array['orderindex'];
		$this->dateCreated = $this->getDate($array, 'date_created');
		$this->dateUpdated = $this->getDate($array, 'date_updated');
		$this->creator = new User(
			$this->client(),
			$array['creator']
		);
		$this->assignees = new UserCollection(
			$this->client(),
			$array['assignees']
		);

		// TODO TagCollection
		$this->tags = $array['tags'];
		$this->parentTaskId = $array['parent'];
		$this->priority = $array['priority'];
		$this->dueDate = $this->getDate($array, 'due_date');
		$this->startDate = $this->getDate($array, 'start_date');
		$this->points = isset($array['point']) ? $array['point'] : null;
		$this->timeEstimate = isset($array['time_estimate']) ? $array['time_estimate'] : null;
		$this->taskListId = $array['list']['id'];
		$this->projectId = $array['project']['id'];
		$this->spaceId = $array['space']['id'];
		$this->url = $array['url'];
	}

	/**
	 * @param $array
	 * @param $key
	 * @return \DateTimeImmutable|null
	 * @throws \Exception
	 */
	private function getDate($array, $key)
	{
		if(!isset($array[$key])) {
			return null;
		}
		$unixTime = substr($array[$key], 0, 10);
		return new \DateTimeImmutable("@$unixTime");
	}
}
