<?php

namespace App\Services;

use App\DTO\PlatformDto;
use App\Models\AdsFormat;
use App\Models\Platform;

class PlatformService
{
    public function all()
    {
        return Platform::all()->sortByDesc('id');
    }

    public function findById(Int $id): Platform
    {
        return Platform::findOrfail($id);
    }

    public function create(PlatformDto $dto): Platform
    {
        $platform = Platform::create([
            "name" => $dto->name,
            "status" => $dto->status
        ]);

        //we attach the formats
        foreach ($dto->formats as $format) {

            $platform->formats()->attach($format);
        }

        //we attach the cycles
        foreach ($dto->cycles as $cycle) {
            $platform->cycles()->attach($cycle);
        }

        return $platform;
    }

    public function update(Platform $platform, PlatformDto $dto)
    {
        $platform->update([
            "name" => $dto->name,
            "status" => $dto->status
        ]);

        $platform->formats()->sync($dto->formats);

        $platform->cycles()->sync($dto->cycles);
    }

    public function destroy($id)
    {
        $platform = Platform::findById($id);

        //delete formats and cycles
        $platform->formats()->detach();
        $platform->cycles()->detach();

        return Platform::destroy($id);
    }
}
