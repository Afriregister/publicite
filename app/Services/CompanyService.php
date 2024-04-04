<?php

namespace App\Services;

use App\DTO\CompanyDto;
use App\Models\Company;

class CompanyService
{

    public function all()
    {
        return Company::all()->sortByDesc('id');
    }

    public function findById($id)
    {
        return Company::findOrfail($id);
    }

    public function create(CompanyDto $CompanyDto)
    {
        return Company::create($CompanyDto->toArray());
    }

    public function update(Company $Company, CompanyDto $dto)
    {
        return $Company->update($dto->toArray());
    }

    public function destroy($id)
    {
        return Company::destroy($id);
    }
}
