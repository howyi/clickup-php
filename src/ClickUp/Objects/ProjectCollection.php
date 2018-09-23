<?php

namespace ClickUp\Objects;

/**
 * @method Project   getByKey(int $projectId)
 * @method Project   getByName(string $projectName)
 * @method Project[] objects()
 * @method Project[] getIterator()
 */
class ProjectCollection extends AbstractObjectCollection
{
	public function __construct(Space $space, $array)
	{
		parent::__construct($space->client(), $array);
		foreach ($this as $project) {
			$project->setSpace($space);
			if ($project->overrideStatuses() === false) {
				$project->setStatuses($space->statuses());
			}
		}
	}

	/**
	 * @return string
	 */
	protected function objectClass()
	{
		return Project::class;
	}
}
