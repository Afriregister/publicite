<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AdminDTO extends ValidatedDTO
{
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $status;


    protected function rules(): array
    {
        return [
            "firstname" => ['required', 'string', 'max:255'],
            "lastname" => ['required', 'string', 'max:255'],
            "email" => ['required', 'email', 'unique:admins,email'],
            "password" => ['required', 'string'],
            "status" => ['required', 'numeric']
        ];
    }

    protected function defaults(): array
    {
        return [
            "status" => 1
        ];
    }

    protected function casts(): array
    {
        return [];
    }
}
