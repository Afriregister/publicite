<?php

namespace App\Services;

use App\DTO\AdsCycleDto;
use App\Models\AdsCycle;

class AdsCycleService
{

    public function all()
    {
        return AdsCycle::all()->sortByDesc('id');
    }

    public function findById($id)
    {
        return AdsCycle::findOrfail($id);
    }

    public function create(AdsCycleDto $AdsCycleDto)
    {
        return AdsCycle::create($AdsCycleDto->toArray());
    }

    public function update(AdsCycle $adsCycle, AdsCycleDto $dto)
    {
        return $adsCycle->update($dto->toArray());
    }

    public function destroy($id)
    {
        return AdsCycle::destroy($id);
    }
}
