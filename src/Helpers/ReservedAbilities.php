<?php

namespace NovaTrust\Helpers;
 
 
class ReservedAbilities
{  
	const VIEW_ANY         = 'viewAny';
	const VIEW             = 'view';
	const CREATE           = 'create';
	const UPDATE           = 'update';
	const DELETE           = 'delete';
	const ATTACH           = 'attach';
	const DETACH           = 'detach';
	const FORCE_DELETE     = 'forceDelete';
	const ADD              = 'add';  
	
	const VIEW_OWN         = 'viewOwn';
	const CREATE_OWN       = 'createOwn';
	const UPDATE_OWN       = 'updateOwn';
	const DELETE_OWN       = 'deleteOwn';
	const ATTACH_OWN       = 'attachOwn';
	const DETACH_OWN       = 'detachOwn';
	const FORCE_DELETE_OWN = 'forceDeleteOwn';
	const ADD_OWN          = 'addOwn'; 

	/**
	 * Array of reserved abilities.
	 * 
	 * @return array
	 */
	static public function all()
	{
		return array_merge(
			static::ownershipAbilities(), static::superiorAbilities()
		);
	}

	/**
	 * Array of suprior abilities.
	 * 
	 * @return array
	 */
	static public function superiorAbilities()
	{
		return [
			static::VIEW_ANY, 
			static::VIEW, 
			static::CREATE, 
			static::UPDATE, 
			static::DELETE, 
			static::ATTACH, 
			static::DETACH, 
			static::FORCE_DELETE, 
			static::ADD,
		];
	}

	/**
	 * Array of ownership abilities.
	 * 
	 * @return array
	 */
	static public function ownershipAbilities()
	{
		return [ 
			static::VIEW_OWN, 
			static::CREATE_OWN, 
			static::UPDATE_OWN, 
			static::DELETE_OWN, 
			static::ATTACH_OWN, 
			static::DETACH_OWN, 
			static::FORCE_DELETE_OWN, 
			static::ADD_OWN,
		];
	} 
}