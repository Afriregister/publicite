<?php

namespace App\Services;

use App\DTO\ChannelDto;
use App\Models\Channel;
use App\Models\Media;

class ChannelService
{
    public function all()
    {
        return Channel::all()->sortByDesc('id');
    }

    public function findById(Int $id): Channel
    {
        return Channel::findOrfail($id);
    }

    public function create(ChannelDto $dto): Channel
    {
        // find the user_id of the media

        $media = Media::findOrFail($dto->media_id);

        $data = $dto->toArray();
        $data['user_id'] = $media->user_id;

        $channel = Channel::create($data);

        return $channel;
    }

    public function update(Channel $channel, ChannelDto $dto)
    {
        $media = Media::findOrFail($dto->media_id);

        $data = $dto->toArray();
        $data['user_id'] = $media->user_id;

        $channel->update($data);
        
        return $channel;  
    }

    public function destroy($id)
    {
        return Channel::destroy($id);
    }
}
