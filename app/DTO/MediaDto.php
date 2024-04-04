<?php

namespace App\DTO;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class MediaDto
{

    public function __construct(
        public readonly int $user_id,
        public readonly string $name,
        public readonly ?string $short_name = null,
        public $image = null,
        public readonly ?string $country = null,
        public readonly ?string $city = null,
        public readonly ?string $address = null,
        public readonly ?string $phonenumber = null,
        public readonly ?string $email = null,
        public readonly ?string $website = null,
        public readonly ?Int $status = 1
    ) {
    }

    public static function fromRequest(Request $request): MediaDto
    {
        //dd($request->file('image')->getClientOriginalName());

        return new self(
            $request->input('user_id'),
            $request->input('name'),
            $request->input('short_name'),
            $request->file('image'),
            $request->input('country'),
            $request->input('city'),
            $request->input('address'),
            $request->input('phonenumber'),
            $request->input('email'),
            $request->input('website'),
            $request->input('status')

        );
    }

    public function toArray()
    {
        return [
            "user_id" => $this->user_id,
            "name" => $this->name,
            "short_name" => $this->short_name,
            "country" => $this->country,
            "city" => $this->city,
            "address" => $this->address,
            "phonenumber" => $this->phonenumber,
            "email" => $this->email,
            "website" => $this->website,
            "status" => $this->status
        ];
    }
}
