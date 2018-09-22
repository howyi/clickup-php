<?php

namespace ClickUp\Objects;

use ClickUp\Client;

abstract class AbstractObject
{
    /* @var Client $client */
	private $client;

	/* @var array $extra */
	private $extra;

	/**
	 * @param Client $client
	 */
	public function __construct(Client $client, $array)
	{
		$this->setClient($client);
		$this->fromArray($array);
		$this->setExtra($array);
	}

	abstract public function fromArray($array);

	/**
	 * @return Client
	 */
	public function client()
	{
		return $this->client;
	}

	public function setClient(Client $client)
	{
		$this->client = $client;
	}

	public function setExtra($array)
	{
		$this->extra = $array;
	}

	public function extra()
	{
		return $this->extra;
	}
}
