<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class UserScope implements Scope
{
	/**
	 * Apply the scope to a given Eloquent query builder.
	 * 
	 * If a user is logged in and they are a shop, this scope restricts records to theirs only
	 * If a job is running outside of a logged in user context, there are no restrictions and the
	 * job has to apply the necessary restrictions in the job
	 */
	public function apply(Builder $builder, Model $model): void
	{
		if (($user = Auth::user()) && $user->is_shop) {
			$builder->where('user_id', $user->id);
		}
	}
}
