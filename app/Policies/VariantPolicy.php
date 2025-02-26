<?php

namespace App\Policies;

use App\Models\ItemVariant;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class VariantPolicy
{
	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user): bool
	{
		return true;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, ItemVariant $itemVariant): bool
	{
		return true;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		return is_admin();
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, ItemVariant $itemVariant): bool
	{
		return is_admin();
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, ItemVariant $itemVariant): bool
	{
		return is_admin();
	}

	/**
	 * Determine whether the user can replicate the model.
	 */
	public function replicate(User $user, ItemVariant $itemVariant): bool
	{
		return is_admin();
	}
}
