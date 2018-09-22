<?php

namespace ClickUp\Objects;

/**
 * @method User   getById(int $id)
 * @method User[] objects()
 * @method User[] getIterator()
 */
class UserCollection extends AbstractObjectCollection
{
	/**
	 * @return string
	 */
	protected function objectClass()
	{
		return User::class;
	}
}
