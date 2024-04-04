<?php

namespace App\Http\Controllers\Admin;

use App\DTO\AdsFormatDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdsFormatStoreRequest;
use App\Http\Requests\Admin\AdsFormatUpdateRequest;
use App\Services\AdsFormatService;

class AdsFormatController extends Controller
{
    protected $adsFormatService;

    public function __construct(AdsFormatService $ads)
    {
        $this->adsFormatService = $ads;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adsFormats = $this->adsFormatService->all();

        return view('admin.adsformats.index', compact('adsFormats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.adsformats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdsFormatStoreRequest $request)
    {
        $adsFormat = $this->adsFormatService->create(AdsFormatDto::fromRequest($request));

        return redirect()->route('admin.adsformats.index')->with('info', __('Ads format') . ' ' . __('added'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $adsFormat = $this->adsFormatService->findById($id);
        return view('admin.adsformats.edit', compact('adsFormat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $adsFormat = $this->adsFormatService->findById($id);

        return view('admin.adsformats.edit', compact('adsFormat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdsFormatUpdateRequest $request, $id)
    {
        $adsFormat = $this->adsFormatService->findById($id);

        $this->adsFormatService->update($adsFormat, AdsFormatDto::fromRequest($request));

        return redirect()->route('admin.adsformats.index')->with('info', __('Ads format') . ' ' . __('updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->adsFormatService->destroy($id);

        return back()->with('info', __('Ads format') . ' ' . __('deleted'));
    }
}
