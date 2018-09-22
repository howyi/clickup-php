<?php

namespace ClickUp\Objects;

/**
 * @method Project   getById(int $id)
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
			$project->setSpace($space);
			if ($project->overrideStatuses() === false) {
				$project->setStatuses($space->statuses());
			}
		}
	}
}
