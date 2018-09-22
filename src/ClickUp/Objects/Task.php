<?php

namespace ClickUp\Objects;

class Task extends AbstractObject
{
	/* @var string $id*/
	private $id;

	/* @var string $name */
	private $name;

	/* @var string $description */
	private $description;

	/* @var Status $statuse */
	private $status;

	/* @var string $orderindex */
	private $orderindex;

	/* @var \DateTimeImmutable $createdAt */
	private $createdAt;

	/* @var \DateTimeImmutable $updatedAt */
	private $updatedAt;

	/* @var TeamMember $creater */
	private $creater;

	/* @var TeamMemberCollection $asignees */
	private $asignees;

	/* @var array $tags */
	private $tags;

	/* @var string $parentTaskId */
	private $parentTaskId;

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

	/* @var int $listId */
	private $listId;

	/* @var int $projectId */
	private $projectId;

	/* @var int $spaceId */
	private $spaceId;

	/* @var int $teamId */
	private $teamId;

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

	public function edit()
	{
		// TODO
	}

	/**
	 * @param array $array
	 */
	protected function fromArray($array)
	{
		$this->id = $array['id'];
		$this->name = $array['name'];
		// TODO
	}
}
