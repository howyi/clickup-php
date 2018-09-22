<?php

namespace ClickUp\Objects;

use ClickUp\Client;

/**
 * @method TeamMember   getById(int $id)
 * @method TeamMember[] objects()
 * @method TeamMember[] getIterator()
 */
class TeamMemberCollection extends UserCollection
{
	public function __construct(Team $team, $array)
	{
		parent::__construct($team->client(), $array);
		$this->setTeam($team);
	}

	/**
	 * @return string
	 */
	protected function objectClass()
	{
		return TeamMember::class;
	}

	/**
	 * @param array $array
	 */
	public function fromArray($array)
	{
		foreach ($array as $key => $value) {
			$array[$key] = $value['user'];
		}
		parent::fromArray($array);
	}

	public function setTeam(Team $team) {
		foreach ($this as $teamMember) {
			$teamMember->setTeam($team);
		}
	}
}
