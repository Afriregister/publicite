<?php

namespace App\Http\Controllers\Admin;

use App\DTO\CompanyDto;
use App\Services\companyService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyStoreRequest;
use App\Http\Requests\Admin\CompanyUpdateRequest;
use App\Services\UserService;

class CompanyController extends Controller
{
    protected $companyService;
    protected $userService;

    public function __construct(CompanyService $company, UserService $user)
    {
        $this->companyService = $company;
        $this->userService = $user;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = $this->companyService->all();

        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = $this->userService->all()->where('role', 'company');

        return view('admin.companies.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyStoreRequest $request)
    {
        $company = $this->companyService->create(CompanyDto::fromRequest($request));

        return redirect()->route('admin.companies.index')->with('info', __('Company') . ' ' . __('added'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $company = $this->companyService->findById($id);

        $users = $this->userService->all()->where('role', 'company');

        return view('admin.companies.edit', compact('company', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $company = $this->companyService->findById($id);

        $users = $this->userService->all()->where('role', 'company');

        return view('admin.companies.edit', compact('company', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, $id)
    {
        $company = $this->companyService->findById($id);

        $this->companyService->update($company, CompanyDto::fromRequest($request));

        return redirect()->route('admin.companies.index')->with('info', __('Company') . ' ' . __('updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->companyService->destroy($id);

        return back()->with('info', __('Company') . ' ' . __('deleted'));
    }
}
