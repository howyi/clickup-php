<?php

namespace ClickUp\Objects;

class Status extends AbstractObject
{
	/* @var int $id */
	private $id;

	/* @var string $name */
	private $name;

	/* @var string $color */
	private $color;

	/* @var string $type */
	private $type;

	/**
	 * @return int
	 */
	public function id()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function name()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function color()
	{
		return $this->color;
	}

	/**
	 * @return string
	 */
	public function type()
	{
		return $this->type;
	}

	/**
	 * @param array $array
	 */
	protected function fromArray($array)
	{
		$this->id = $array['orderindex'];
		$this->name = $array['status'];
		$this->color = $array['color'];
		$this->type = $array['type'];
	}
}
