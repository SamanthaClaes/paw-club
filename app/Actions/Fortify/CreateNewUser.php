<?php

namespace App\Actions\Fortify;

use App\enum\UserRole;
use App\Jobs\ProcessImageJob;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array<string, string> $input
     *
     * @throws ValidationException
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'image' => ['nullable', 'image', 'max:10240'],
            'is_petsitter' => ['nullable', 'boolean:'],
            'password' => $this->passwordRules(),

        ])->validate();
        $imagePath = null;

        if (isset($input['image'])) {

            $fileName = 'user_' . uniqid() . '.jpg';

            $imagePath = $input['image']->storeAs(
                'user/original',
                $fileName,
                's3'
            );

            ProcessImageJob::dispatch(
                $fileName,
                $imagePath
            );
        }
        return (User::create([
            'last_name' => $input['last_name'],
            'first_name' => $input['first_name'],
            'email' => $input['email'],
            'image' => $imagePath,
            'password' => Hash::make($input['password']),
            'role' => null,
            'is_petsitter' => !empty($input['is_petsitter']),
        ]));
    }
}
