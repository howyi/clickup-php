<?php

namespace ClickUp\Objects;

class Project extends AbstractObject
{
	/* @var int $id*/
	private $id;

	/* @var string $name */
	private $name;

	/* @var array $taskLists */
	private $taskLists;

	/* @var bool $overrideStatuses */
	private $overrideStatuses;

	/* @var StatusCollection $statuses */
	private $statuses;

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
	 * @return array
	 */
	public function taskLists()
	{
		return $this->taskLists;
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

	/**
	 * @param StatusCollection $statuses
	 */
	public function setStatuses(StatusCollection $statuses)
	{
		$this->statuses = $statuses;
	}

	/**
	 * @param array $array
	 */
	public function fromArray($array)
	{
		$this->id = $array['id'];
		$this->name = $array['name'];
		$this->taskLists = $array['lists'];
		$this->overrideStatuses = isset($array['override_statuses']) ? $array['override_statuses'] : false;
		if (isset($array['override_statuses']) and $array['override_statuses']) {
			$this->statuses = new StatusCollection(
				$this->client(),
				$array['statuses']
			);
		}
	}
}
