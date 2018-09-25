<?php

namespace ClickUp\Objects;

class TaskList extends AbstractObject
{
	use TaskFinderTrait;

	/* @var int $id*/
	private $id;

	/* @var string $name */
	private $name;

	/* @var Project $project */
	private $project;

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
	 * Access parent class.
	 *
	 * @return Project
	 */
	public function project()
	{
		return $this->project;
	}

	/**
	 * @param Project $project
	 */
	public function setProject(Project $project)
	{
		$this->project = $project;
	}

	/**
	 * @see https://jsapi.apiary.io/apis/clickup/reference/0/list/edit-list.html
	 * @param array $body
	 * @return array
	 */
	public function edit($body)
	{
		return $this->client()->put(
			"list/{$this->id()}",
			$body
		);
	}

	/**
	 * @see https://jsapi.apiary.io/apis/clickup/reference/0/task/create-task-in-list?console=1.html
	 * @param array $body
	 * @return array
	 */
	public function createTask($body)
	{
		return $this->client()->post(
			"list/{$this->id()}/task",
			$body
		);
	}

	/**
	 * @return int
	 */
	public function teamId()
	{
		return $this->project()->space()->team()->id();
	}

	/**
	 * @return array
	 */
	protected function taskFindParams()
	{
		return ['list_ids' => [$this->id()]];
	}

	/**
	 * @param array $array
	 */
	protected function fromArray($array)
	{
		$this->id = $array['id'];
		$this->name = $array['name'];
	}
}
