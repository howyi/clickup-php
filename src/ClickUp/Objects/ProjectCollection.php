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

	public function setStatuses(StatusCollection $statuses) {
		foreach ($this as $project) {
			if ($project->overrideStatuses() === false) {
				$project->setStatuses($statuses);
			}
		}
	}
}
