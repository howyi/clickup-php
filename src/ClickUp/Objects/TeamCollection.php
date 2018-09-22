<?php

namespace ClickUp\Objects;

/**
 * @method Team   getByKey(int $teamId)
 * @method Team   getByName(string $teamName)
 * @method Team[] objects()
 * @method Team[] getIterator()
 */
class TeamCollection extends AbstractObjectCollection
{
	/**
	 * @return string
	 */
	protected function objectClass()
	{
		return Team::class;
	}
}
