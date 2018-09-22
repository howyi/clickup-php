<?php

namespace ClickUp\Objects;

/**
 * @method Team   getById(int $id)
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
