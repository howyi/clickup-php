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
	/**
	 * @return string
	 */
	protected function objectClass()
	{
		return Project::class;
	}

	public function setSpace(Space $space) {
		foreach ($this as $project) {
			$project->setSpaceId($space->id());
			$project->setSpace($space);
			if ($project->overrideStatuses() === false) {
				$project->setStatuses($space->statuses());
			}
		}
	}


	public function setSpaceId($spaceId) {
		foreach ($this as $project) {
			$project->setSpaceId($spaceId);
		}
	}
}
