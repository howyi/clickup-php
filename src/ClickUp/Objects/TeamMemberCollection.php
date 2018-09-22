<?php

namespace ClickUp\Objects;

/**
 * @method TeamMember   getById(int $id)
 * @method TeamMember[] objects()
 * @method TeamMember[] getIterator()
 */
class TeamMemberCollection extends UserCollection
{
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
}
