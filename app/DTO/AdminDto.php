<?php

namespace App\DTO;

use Illuminate\Http\Request;

class AdminDto
{

    public function __construct(
        public readonly ?string $firstname = null,
        public readonly ?string $lastname = null,
        public readonly ?string $email = null,
        public readonly ?string $password = null,
        public readonly ?Int $status = null
    ) {
    }

    public static function fromRequest(Request $request): AdminDto
    {
        return new self(
            $request->input('firstname'),
            $request->input('lastname'),
            $request->input('email'),
            $request->input('password'),
            $request->input('status'),
        );
    }

    public function toArray()
    {
        return [
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            "email" => $this->email,
            "password" => $this->password,
            "status" => $this->status
        ];
    }
}
