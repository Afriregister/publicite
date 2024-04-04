<?php

namespace App\Services;

use App\DTO\AdsTypeDto;
use App\Models\AdsType;

class AdsTypeService
{

    public function all()
    {
        return AdsType::all()->sortByDesc('id');
    }

    public function findById($id)
    {
        return AdsType::findOrfail($id);
    }

    public function create(AdsTypeDto $adsTypeDto)
    {
        return AdsType::create($adsTypeDto->toArray());
    }

    public function update(AdsType $adsType, AdsTypeDto $dto)
    {
        return $adsType->update($dto->toArray());
    }

    public function destroy($id)
    {
        return AdsType::destroy($id);
    }
}
