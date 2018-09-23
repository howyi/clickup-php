<?php

namespace ClickUp\Objects;

/**
 * @method TeamMember   getByKey(int $userId)
 * @method TeamMember   getByName(string $username)
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
	protected function fromArray($array)
	{
		foreach ($array as $key => $value) {
			$array[$key] = $value['user'];
		}
		parent::fromArray($array);
	}

	private function setTeam(Team $team) {
		foreach ($this as $teamMember) {
			$teamMember->setTeam($team);
		}
	}
}
