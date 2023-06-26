<?php

namespace ClickUp;

use ClickUp\Objects\TaskFinder;
use ClickUp\Objects\Team;
use ClickUp\Objects\TeamCollection;
use ClickUp\Objects\User;

class Client
{
    private $guzzleClient;

    public function __construct($apiToken)
    {
        $this->guzzleClient = new \GuzzleHttp\Client([
            'base_uri' => 'https://api.clickup.com/api/v1/',
            'headers' => [
                'Authorization' => $apiToken,
            ]
        ]);
    }

    public function client()
    {
        return $this;
    }

    /**
     * @return User
     */
    public function user()
    {
        return new User(
            $this,
            $this->get('user')['user']
        );
    }

    /**
     * @return TeamCollection
     */
    public function teams()
    {
        return new TeamCollection(
            $this,
            $this->get('team')['teams']
        );
    }

    /**
     * @param int $teamId
     * @return Team
     */
    public function team($teamId)
    {
        return new Team(
            $this,
            $this->get("team/$teamId")['team']
        );
    }

    /**
     * @param int $teamId
     * @return TaskFinder
     */
    public function taskFinder($teamId)
    {
        return new TaskFinder($this, $teamId);
    }

    /**
     * @param string $method
     * @param array  $params
     * @return mixed
     */
    public function get($method, $params = [])
    {
        $response = $this->guzzleClient->request('GET', $method, ['query' => $params]);
        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $method
     * @param array $body
     * @return mixed
     */
    public function post($method, $body = [])
    {
        return \GuzzleHttp\json_decode($this->guzzleClient->request('POST', $method, ['json' => $body])->getBody(), true);
    }

    /**
     * @param string $method
     * @param array $body
     * @return mixed
     */
    public function put($method, $body = [])
    {
        return \GuzzleHttp\json_decode($this->guzzleClient->request('PUT', $method, ['json' => $body])->getBody(), true);
    }

    /**
     * multipart
     *
     * @param  mixed $method
     * @param  mixed $body
     * @return void
     */
    public function multipart($method, array $body = [])
    {
        return $this->guzzleClient->request('POST', $method, $body, true);
    }
}
