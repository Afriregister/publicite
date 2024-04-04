<?php

namespace App\DTO;

use Illuminate\Http\Request;

class PlatformDto
{

    public function __construct(
        public readonly string $name,
        public readonly ?Int $status = null,
        public readonly array $formats,
        public readonly array $cycles
    ) {
    }

    public static function fromRequest(Request $request): PlatformDto
    {
        foreach (config('app.supported_locales') as $key => $val) {
            $data['name'][$key]  = $request->input('name_' . $key);
        }

        return new self(
            json_encode($data['name']),
            $request->input('status'),
            $request->input('formats'),
            $request->input('cycles')
        );
    }

    public function toArray()
    {
        return [
            "name" => $this->name,
            "status" => $this->status,
            "formats" => $this->formats,
            "cycles" => $this->cycles
        ];
    }
}
