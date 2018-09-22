<?php

namespace ClickUp\Objects;

/**
 * @method Task   getByKey(int $spaceId)
 * @method Task   getByName(string $spaceName)
 * @method Task[] objects()
 * @method Task[] getIterator()
 */
class TaskCollection extends AbstractObjectCollection
{
	/**
	 * @return string
	 */
	protected function objectClass()
	{
		return Task::class;
	}
}
