<?php

namespace ClickUp\Objects;

abstract class AbstractObjectCollection extends AbstractObject implements \IteratorAggregate
{
	/* @var AbstractObject[] $objects */
	protected $objects;

	/**
	 * @param array $array
	 */
	protected function fromArray($array)
	{
		$class = $this->objectClass();
		foreach ($array as $value) {
			$this->objects[$value[$this->key()]] = new $class(
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
	 * @return string
	 */
	protected function key()
	{
		return 'id';
	}

	/**
	 * @return string
	 */
	protected function nameKey()
	{
		return 'name';
	}

	/**
	 * @param int $id
	 * @return AbstractObject
	 */
	public function getByKey($id)
	{
		if (!isset($this->objects[$id])) {
			throw new \RuntimeException("id:$id not exist.");
		}
		return $this->objects[$id];
	}

	/**
	 * @param string $name
	 * @return AbstractObject
	 */
	public function getByName($name)
	{
		$nameKey = $this->nameKey();
		foreach ($this as $value) {
			if ($name === $value->$nameKey()) {
				return $value;
			}
		}
		throw new \RuntimeException("name:$name not exist.");
	}

	/**
	 * @return AbstractObject[]
	 */
	public function objects()
	{
		return $this->objects ?? [];
	}

	/**
	 * @return \ArrayIterator|\Traversable
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->objects());
	}
}

