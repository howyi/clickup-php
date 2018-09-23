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
	public function __construct(Team $team, $array)
	{
		parent::__construct($team->client(), $array);
		foreach ($this as $space) {
			$space->setTeam($team);
		}
	}

	/**
	 * @return string
	 */
	protected function objectClass()
	{
		return Space::class;
	}
}
