<?php

namespace App\DTO;

use Illuminate\Http\Request;

class CompanyDto
{
    public function __construct(
        public readonly int $user_id,
        public readonly string $name,
        public readonly ?string $tin = null,
        public readonly ?string $country = null,
        public readonly ?string $city = null,
        public readonly ?string $address = null,
        public readonly ?string $phonenumber = null,
        public readonly ?string $email = null,
        public readonly ?string $website = null,
    ) {
    }

    public static function fromRequest(Request $request): CompanyDto
    {
        return new self(
            $request->input('user_id'),
            $request->input('name'),
            $request->input('tin'),
            $request->input('country'),
            $request->input('city'),
            $request->input('address'),
            $request->input('phonenumber'),
            $request->input('email'),
            $request->input('website'),
        );
    }

    public function toArray()
    {
        return [
            "user_id" => $this->user_id,
            "name" => $this->name,
            "tin" => $this->tin,
            "country" => $this->country,
            "city" => $this->city,
            "address" => $this->address,
            "phonenumber" => $this->phonenumber,
            "email" => $this->email,
            "website" => $this->website,
        ];
    }
}
