<?php

namespace App\Policies;

use App\Enums\RequestStatus;
use App\Models\OrderRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Symfony\Component\HttpFoundation\RequestStack;

class OrderRequestPolicy
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
	public function view(User $user, OrderRequest $orderRequest): bool
	{
		return is_admin() || $orderRequest->user_id == $user->id;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, OrderRequest $orderRequest): bool
	{
		return is_admin() || $orderRequest->user_id == $user->id;
	}
	
	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user, OrderRequest $orderRequest): bool
	{
		return is_admin() || ($orderRequest->user_id == $user->id && $orderRequest->status == RequestStatus::Checkout->value);
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, OrderRequest $orderRequest): bool
	{
		return is_admin();
	}
}
