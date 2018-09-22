<?php

namespace ClickUp\Objects;

/**
 * @method Space   getByKey(int $spaceId)
 * @method Space   getByName(string $spaceName)
 * @method Space[] objects()
 * @method Space[] getIterator()
 */
class SpaceCollection extends AbstractObjectCollection
{
	/**
	 * @return string
	 */
	protected function objectClass()
	{
		return Space::class;
	}

	public function setTeam(Team $team) {
		foreach ($this as $space) {
			$space->setTeamId($team->id());
			$space->setTeam($team);
		}
	}

	public function setTeamId($teamId) {
		foreach ($this as $space) {
			$space->setTeamId($teamId);
		}
	}
}
