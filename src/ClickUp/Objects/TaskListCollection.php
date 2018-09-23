<?php

namespace ClickUp\Objects;

/**
 * @method TaskList   getByKey(int $listId)
 * @method TaskList   getByName(string $listName)
 * @method TaskList[] objects()
 * @method TaskList[] getIterator()
 */
class TaskListCollection extends AbstractObjectCollection
{
	public function __construct(Project $project, $array)
	{
		parent::__construct($project->client(), $array);
		foreach ($this as $taskList) {
			$taskList->setProject($project);
		}
	}

	/**
	 * @return string
	 */
	protected function objectClass()
	{
		return TaskList::class;
	}
}
