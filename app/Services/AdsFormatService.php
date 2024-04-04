<?php

namespace App\Services;

use App\DTO\AdsFormatDto;
use App\Models\AdsFormat;

class AdsFormatService
{

    public function all()
    {
        return AdsFormat::all()->sortByDesc('id');
    }

    public function findById($id)
    {
        return AdsFormat::findOrfail($id);
    }

    public function create(AdsFormatDto $adsFormatDto)
    {
        return AdsFormat::create($adsFormatDto->toArray());
    }

    public function update(AdsFormat $adsFormat, AdsFormatDto $dto)
    {
        return $adsFormat->update($dto->toArray());
    }

    public function destroy($id)
    {
        return AdsFormat::destroy($id);
    }
}
