<?php

namespace ClickUp\Objects;

abstract class AbstractObjectCollection extends AbstractObject implements \IteratorAggregate
{
	/* @var AbstractObject[] $objects */
	protected $objects;

	/**
	 * @param array $array
	 */
	public function fromArray($array)
	{
		$class = $this->objectClass();
		foreach ($array as $value) {
			$this->objects[$value['id']] = new $class(
				$this->client(),
				$value
			);
		}
	}

	/**
	 * @return string
	 */
	abstract protected function objectClass();

	/**
	 * @param int $id
	 * @return AbstractObject
	 */
	public function getById($id)
	{
		return $this->objects[$id];
	}

	/**
	 * @return AbstractObject[]
	 */
	public function objects()
	{
		return $this->objects;
	}

	/**
	 * @return \ArrayIterator|\Traversable
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->objects());
	}
}

