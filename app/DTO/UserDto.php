<?php

namespace App\DTO;

use Illuminate\Http\Request;

class UserDto
{

    public function __construct(
        public readonly ?string $firstname = null,
        public readonly ?string $lastname = null,
        public readonly ?string $role = null,
        public readonly ?string $parent_id = null,
        public readonly ?string $email = null,
        public readonly ?string $password = null,
        public readonly ?string $country = null,
        public readonly ?string $city = null,
        public readonly ?string $address = null,
        public readonly ?string $phonenumber = null,
        public readonly ?Int $status = null
    ) {
    }

    public static function fromRequest(Request $request): UserDto
    {
        return new self(
            $request->input('firstname'),
            $request->input('lastname'),
            $request->input('role'),
            $request->input('parent_id'),
            $request->input('email'),
            $request->input('password'),
            $request->input('country'),
            $request->input('city'),
            $request->input('address'),
            $request->input('phonenumber'),
            $request->input('status'),
        );
    }

    public function toArray()
    {
        return [
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            "role" => $this->role,
            "parent_id" => $this->parent_id,
            "email" => $this->email,
            "password" => $this->password,
            "country" => $this->country,
            "city" => $this->city,
            "address" => $this->address,
            "phonenumber" => $this->phonenumber,
            "status" => $this->status
        ];
    }
}
