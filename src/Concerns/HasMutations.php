<?php
namespace NovaTrust\Concerns;

use NovaTrust\Helpers\PermissionContainer;

trait HasMutations 
{
	public function setNameAttribute(string $name)
	{
		$this->attributes['name'] = str_slug($name, '-');
	}

	public function setDisplayNameAttribute(string $displayName = null)
	{
		$this->attributes['display_name'] = PermissionContainer::displayName(
			$displayName ?: $this->name
		);
	}

	public function setDescriptionAttribute(string $description = null)
	{
		$this->attributes['description'] =  PermissionContainer::displayName(
			$description ?: $this->display_name
		);
	}
}