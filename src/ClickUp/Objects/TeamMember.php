<?php

namespace ClickUp\Objects;

class TeamMember extends User
{
	// /* @var int $role */
	// private $role;

	/* @var Team $team */
	private $team;

	// /**
	//  * @return int
	//  */
	// public function role()
	// {
	// 	return $this->role;
	// }
	//
	// /**
	//  * @param array $array
	//  */
	// public function fromArray($array)
	// {
	// 	$this->role = $array['role'];
	// 	parent::fromArray($array);
	// }

	/**
	 * Access parent class.
	 *
	 * @return Team
	 */
	public function team()
	{
		return $this->team;
	}

	/**
	 * @param Team $team
	 */
	public function setTeam(Team $team)
	{
		$this->team = $team;
	}
}
