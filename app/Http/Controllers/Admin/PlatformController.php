<?php

namespace App\Http\Controllers\Admin;

use App\DTO\PlatformDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlatformStoreRequest;
use App\Http\Requests\Admin\PlatformUpdateRequest;
use App\Models\AdsCycle;
use App\Models\AdsFormat;
use App\Services\PlatformService;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    protected $platformService;

    protected $adsFormatService;

    protected $adsCycleService;

    public function __construct(PlatformService $platformservice, AdsFormat $format, AdsCycle $cycle)
    {
        $this->platformService = $platformservice;

        $this->adsFormatService = $format;

        $this->adsCycleService = $cycle;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platforms = $this->platformService->all();

        return view('admin.platforms.index', compact('platforms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formats = $this->adsFormatService->all()->where('status', '1');
        $cycles = $this->adsCycleService->all()->where('status', '1');

        return view('admin.platforms.create', compact('formats', 'cycles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlatformStoreRequest $request)
    {
        $platform = $this->platformService->create(PlatformDto::fromRequest($request));

        $info = __('Platform') . ' ' . __('added');

        return redirect()->route('admin.platforms.index')->with('info', $info);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $platform = $this->platformService->findById($id);

        $formats = $this->adsFormatService->all()->where('status', '1');
        $cycles = $this->adsCycleService->all()->where('status', '1');

        return view('admin.platforms.edit', compact('platform', 'formats', 'cycles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $platform = $this->platformService->findById($id);

        $formats = $this->adsFormatService->all()->where('status', '1');
        $cycles = $this->adsCycleService->all()->where('status', '1');

        $platform_formats = $platform->formats;

        foreach ($platform_formats as $format) {
            $list_formats[] = $format->id;
        }

        $platform_cycles = $platform->cycles;

        foreach ($platform_cycles as $cycle) {
            $list_cycles[] = $cycle->id;
        }

        return view('admin.platforms.edit', compact('platform', 'formats', 'cycles', 'list_formats', 'list_cycles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlatformUpdateRequest $request, string $id)
    {
        $platform = $this->platformService->findById($id);

        $this->platformService->update($platform, PlatformDto::fromRequest($request));

        $info =  __('Platform') . ' ' . __('updated');

        return redirect()->route('admin.platforms.index')->with('info', $info);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->platformService->destroy($id);

        $info = __('Platform') . ' ' . __('deleted');

        return back()->with('info', $info);
    }
}
