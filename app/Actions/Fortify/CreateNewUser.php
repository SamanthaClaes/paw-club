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
     * @param  array<string, string>  $input
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
            'image'=>['nullable', 'image'],
            'adress'=>['required', 'string', 'max:255'],
            'zip'=>['required', 'max_digits:5'],
            'phone'=>['nullable', 'digits:10'],
            'location'=>['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),

        ])->validate();
        $imagePath = null;

        if (isset($input['image'])) {

            $fileName = 'owner_' . uniqid() . '.jpg';

            $imagePath = $input['image']->storeAs(
                'owner/original',
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
            'image'=>$imagePath,
            'adress' => $input['adress'],
            'zip' => $input['zip'],
            'location' => $input['location'],
            'phone' => $input['phone'],
            'password' => Hash::make($input['password']),
            'role' => null,
        ]));
    }
}
