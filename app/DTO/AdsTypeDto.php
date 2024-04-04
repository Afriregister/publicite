<?php

namespace App\DTO;

use Illuminate\Http\Request;

class AdsTypeDto
{

    public function __construct(
        public readonly string $name,
        public readonly ?string $description = null,
        public readonly ?Int $status = null
    ) {
    }

    public static function fromRequest(Request $request): AdsTypeDto
    {
        foreach (config('app.supported_locales') as $key => $val) {
            $data['name'][$key]         = $request->input('name_' . $key);
            $data['description'][$key]  = $request->input('description_' . $key);
        }

        return new self(
            json_encode($data['name']),
            json_encode($data['description']),
            $request->input('status'),
        );
    }

    public function toArray()
    {
        return [
            "name" => $this->name,
            "description" => $this->description,
            "status" => $this->status
        ];
    }
}
