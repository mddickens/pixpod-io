<?php

namespace App\Filament\Pages\Auth;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Model;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
	protected function getForms(): array
	{
		return [
			'form' => $this->form(
				$this->makeForm()
					->schema([
						$this->getNameFormComponent(),
						$this->getEmailFormComponent(),
						$this->getPasswordFormComponent(),
						$this->getPasswordConfirmationFormComponent(),
					])
					->statePath('data'),
			),
		];
	}

	protected function handleRegistration(array $data): Model
	{
		$user = $this->getUserModel()::create($data);
		$user->role = UserRole::Shop->value;
		return $user;
	}
}
