<?php

namespace ClickUp\Objects;

/**
 * @method Space   getById(int $id)
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
			$space->setTeam($team);
		}
	}
}
