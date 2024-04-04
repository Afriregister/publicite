<?php

namespace App\Http\Controllers\Admin;

use App\DTO\AdsTypeDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdsTypeStoreRequest;
use App\Http\Requests\Admin\AdsTypeUpdateRequest;
use App\Services\AdsTypeService;

class AdsTypeController extends Controller
{
    protected $adsTypeService;

    public function __construct(AdsTypeService $adstype)
    {
        $this->adsTypeService = $adstype;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adsTypes = $this->adsTypeService->all();

        return view('admin.adstypes.index', compact('adsTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.adstypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdsTypeStoreRequest $request)
    {
        $this->adsTypeService->create(AdsTypeDto::fromRequest($request));

        $info = __('Ads type') . ' ' . __('added');

        return redirect()->route('admin.adstypes.index')->with('info', $info);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $adsType = $this->adsTypeService->findById($id);

        return view('admin.adstypes.edit', compact('adsType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $adsType = $this->adsTypeService->findById($id);

        return view('admin.adstypes.edit', compact('adsType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdsTypeUpdateRequest $request, $id)
    {
        $adsType = $this->adsTypeService->findById($id);

        $this->adsTypeService->update($adsType, AdsTypeDto::fromRequest($request));

        $info = __('Ads type') . ' ' . __('updated');

        return redirect()->route('admin.adstypes.index')->with('info', $info);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->adsTypeService->destroy($id);

        $info = __('Ads type') . ' ' . __('deleted');

        return back()->with('info', $info);
    }
}
