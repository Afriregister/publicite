<?php

namespace App\DTO;

use Illuminate\Http\Request;

class ChannelDto
{

    public function __construct(
        public readonly int $media_id,
        public readonly int $platform_id,
        public readonly string $name,
        public readonly ?Int $status = null,
    ) {
    }

    public static function fromRequest(Request $request): ChannelDto
    {
        return new self(
            $request->input('media_id'),
            $request->input('platform_id'),
            $request->input('name'),
            $request->input('status') ?? null
        );
    }

    public function toArray()
    {
        return [
            "media_id" => $this->media_id,
            "platform_id" => $this->platform_id,
            "name" => $this->name,
            "status" => $this->status
        ];
    }
}
