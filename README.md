# clickup-php

A simple wrapper for [ClickUp](https://clickup.com/) API (v1-BETA).


## Install
```
composer require "howyi/clickup-php"
```

## Usage
 
### Generate client
```php
// create Client (required: API_TOKEN)
$client = new ClickUp\Client('API_TOKEN');
```

### get

```php
// me
$client->user();
// -> \ClickUp\Objects\User


// all affiliated teams
$client->teams()->objects();
// -> \ClickUp\Objects\Team[]

// team by team id
$team = $client->team($teamId);
// team by name
$team = $client->teams()->getByName('team_name');
// -> \ClickUp\Objects\Team


// spaces in team
$team->spaces()->objects();
// -> \ClickUp\Objects\Space[]

// space by space id
$space = $team->space(888);
// space by name
$space = $team->spaces()->getByName('spaaaaace');
// -> \ClickUp\Objects\Space


// projects in space
$space->projects()->objects();
// -> \ClickUp\Objects\Project[]

// project by project id
$project = $space->project(11111);
// project by name
$project = $space->projects()->getByName('super cool project');
// -> \ClickUp\Objects\Project

// lists in project
$project->taskLists()->objects();
// -> \ClickUp\Objects\TaskList[]

// list by list id
$taskList = $project->taskList(9999);
// list by name
$taskList = $project->taskLists()->getByName('T A S K L I S T');
// -> \ClickUp\Objects\TaskList

// tasks by list
$tasks = $taskList->tasks($teamId)->getCollection()->objects();
// -> \ClickUp\Objects\Task[]

// task by task id
$task = $taskList->task(3333);
// -> \ClickUp\Objects\Task
```

### create 
```php
/**
 * create task list in project
 * @see https://jsapi.apiary.io/apis/clickup/reference/0/list/create-list.html
 */
$project->createTaskList(['name' => 'newTaskList']);

/**
 * create task in list
 * @see https://jsapi.apiary.io/apis/clickup/reference/0/task/create-task-in-list?console=1.html
 */
$taskList->createTask(['name' => 'my second task']);
```

### update
```php
/**
 * update task list
 * @see https://jsapi.apiary.io/apis/clickup/reference/0/list/edit-list.html
 */
$taskList->edit(['name' => 'renamed task list']);

/**
 * update task
 * @see https://jsapi.apiary.io/apis/clickup/reference/0/task/edit-task.html
 */
$task->edit(['name' => 'renamed task']);
```
