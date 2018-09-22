<?php

namespace ClickUp\Objects;

class TeamMember extends User
{
	/* @var int $id */
	private $role;

	/**
	 * @return int
	 */
	public function role()
	{
		return $this->role;
	}

	/**
	 * @param array $array
	 */
	public function fromArray($array)
	{
		$this->role = $array['role'];
		parent::fromArray($array);
	}
}
