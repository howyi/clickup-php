<?php

namespace ClickUp\Objects;

/**
 * @method Status   getByKey(int $orderindex)
 * @method Status   getByName(string $statusName)
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
