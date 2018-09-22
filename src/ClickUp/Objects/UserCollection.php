<?php

namespace ClickUp\Objects;

/**
 * @method User   getById(int $id)
 * @method User   getByName(string $username)
 * @method User[] objects()
 * @method User[] getIterator()
 */
class UserCollection extends AbstractObjectCollection
{
	/**
	 * @return string
	 */
	public function nameKey()
	{
		return 'username';
	}

	/**
	 * @return string
	 */
	protected function objectClass()
	{
		return User::class;
	}
}
