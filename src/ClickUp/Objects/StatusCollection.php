<?php

namespace ClickUp\Objects;

/**
 * @method Status   getById(int $id)
 * @method Status[] objects()
 * @method Status[] getIterator()
 */
class StatusCollection extends AbstractObjectCollection
{
	/**
	 * @return string
	 */
	protected function objectClass()
	{
		return Status::class;
	}

	public function key()
	{
		return 'orderindex';
	}
}
