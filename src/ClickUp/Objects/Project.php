<?php

namespace ClickUp\Objects;

class Project extends AbstractObject
{
	use TaskFinderTrait;

	/* @var int $id*/
	private $id;

	/* @var string $name */
	private $name;

	/* @var TaskListCollection $taskLists */
	private $taskLists;

	/* @var bool $overrideStatuses */
	private $overrideStatuses;

	/* @var StatusCollection|null $statuses */
	private $statuses = null;

	/* @var int $spaceId */
	private $spaceId;

	/* @var Space $space */
	private $space;

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

	/**
	 * @return TaskListCollection
	 */
	public function taskLists()
	{
		return $this->taskLists;
	}

	/**
	 * @param int $taskListId
	 * @return TaskList
	 */
	public function taskList($taskListId)
	{
		return $this->taskLists()->getByKey($taskListId);
	}

	/**
	 * @return bool
	 */
	public function overrideStatuses()
	{
		return $this->overrideStatuses;
	}

	/**
	 * @return StatusCollection
	 */
	public function statuses()
	{
		return $this->statuses;
	}

	public function spaceId()
	{
		return $this->spaceId;
	}

	public function setSpaceId($spaceId)
	{
		$this->spaceId = $spaceId;
	}

	/**
	 * Access parent class.
	 *
	 * @return Space
	 */
	public function space()
	{
		return $this->space;
	}

	/**
	 * @param Space $space
	 */
	public function setSpace(Space $space)
	{
		$this->space = $space;
	}

	/**
	 * @param StatusCollection $statuses
	 */
	public function setStatuses(StatusCollection $statuses)
	{
		$this->statuses = $statuses;
	}

	/**
	 * @see https://jsapi.apiary.io/apis/clickup/reference/0/list/create-list.html
	 * @param array $body
	 * @return array
	 */
	public function createTaskList($body)
	{
		return $this->client()->createTaskList(
			$this->id(),
			$body
		);
	}

	/**
	 * @return int
	 */
	public function teamId()
	{
		return $this->space()->team()->id();
	}

	/**
	 * @return array
	 */
	protected function taskFindParams()
	{
		return ['project_ids' => [$this->id()]];
	}

	/**
	 * @param array $array
	 */
	protected function fromArray($array)
	{
		$this->id = $array['id'];
		$this->name = $array['name'];
		$this->taskLists = new TaskListCollection(
			$this,
			$array['lists']
		);
		$this->overrideStatuses = isset($array['override_statuses']) ? $array['override_statuses'] : false;
		if (isset($array['override_statuses']) and $array['override_statuses']) {
			$this->statuses = new StatusCollection(
				$this->client(),
				$array['statuses']
			);
		}
	}
}
