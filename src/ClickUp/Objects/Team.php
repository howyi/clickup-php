<?php

namespace ClickUp\Objects;

class Team extends AbstractObject
{
	/* @var int $id*/
	private $id;

	/* @var string $name */
	private $name;

	/* @var string $color */
	private $color;

	/* @var string $avatar */
	private $avatar;

	/* @var TeamMemberCollection $members */
	private $members;

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
	public function avatar()
	{
		return $this->avatar;
	}

	/**
	 * @return TeamMemberCollection
	 */
	public function members()
	{
		return $this->members;
	}

	/**
	 * @return SpaceCollection
	 */
	public function spaces()
	{
		return $this->client()->space($this->id());
	}

	/**
	 * @param array $array
	 */
	public function fromArray($array)
	{
		$this->id = $array['id'];
		$this->name = $array['name'];
		$this->color = $array['color'];
		$this->avatar = $array['avatar'];
		$this->members = new TeamMemberCollection(
			$this->client(),
			$array['members']
		);
	}
}
