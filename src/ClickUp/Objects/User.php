<?php

namespace ClickUp\Objects;

use ClickUp\Client;

class User extends AbstractObject
{
	/* @var int $id */
	private $id;

	/* @var string $username */
	private $username;

	/* @var string $color */
	private $color;

	/* @var string $profilePicture */
	private $profilePicture;

	/* @var string $initials */
	private $initials;

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
	public function username()
	{
		return $this->username;
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
	public function profilePicture()
	{
		return $this->profilePicture;
	}

	/**
	 * @return string
	 */
	public function initials()
	{
		return $this->initials;
	}

	/**
	 * @param array $array
	 */
	public function fromArray($array)
	{
		$this->id = $array['id'];
		$this->username = $array['username'];
		$this->color = $array['color'];
		$this->profilePicture = $array['profilePicture'];
		$this->initials = $array['initials'];
	}
}
