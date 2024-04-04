<?php

namespace App\Http\Controllers\Admin;

use App\DTO\AdsCycleDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdsCycleStoreRequest;
use App\Http\Requests\Admin\AdsCycleUpdateRequest;
use App\Services\AdsCycleService;

class AdsCycleController extends Controller
{
    protected $adsCycleService;

    public function __construct(AdsCycleService $ads)
    {
        $this->adsCycleService = $ads;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adsCycles = $this->adsCycleService->all();

        return view('admin.adscycles.index', compact('adsCycles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.adscycles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdsCycleStoreRequest $request)
    {
        $adsCycle = $this->adsCycleService->create(AdsCycleDto::fromRequest($request));

        return redirect()->route('admin.adscycles.index')->with('info', __('Ads Cycle') . ' ' . __('added'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $adsCycle = $this->adsCycleService->findById($id);

        return view('admin.adscycles.edit', compact('adsCycle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $adsCycle = $this->adsCycleService->findById($id);

        return view('admin.adscycles.edit', compact('adsCycle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdsCycleUpdateRequest $request, $id)
    {
        $adsCycle = $this->adsCycleService->findById($id);

        $this->adsCycleService->update($adsCycle, AdsCycleDto::fromRequest($request));

        return redirect()->route('admin.adscycles.index')->with('info', __('Ads Cycle') . ' ' . __('updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->adsCycleService->destroy($id);

        return back()->with('info', __('Ads Cycle') . ' ' . __('deleted'));
    }
}
