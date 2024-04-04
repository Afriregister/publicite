<?php

namespace App\Http\Controllers\Admin;

use App\Models\Day;
use App\Models\Period;
use App\DTO\ChannelDto;
use App\Models\AdsPrice;
use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Services\AdsTypeService;
use App\Services\ChannelService;
use App\Services\PlatformService;
use App\Services\AdsFormatService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdsPriceDayRequest;
use App\Http\Requests\Admin\ChannelStoreRequest;
use App\Http\Requests\Admin\ChannelUpdateRequest;
use App\Http\Requests\Admin\AdsPricePeriodRequest;

class ChannelController extends Controller
{
    protected $channelService;

    protected $mediaService;

    protected $platformService;

    protected $adsTypeService;

    protected $adsFormatService;

    public function __construct(ChannelService $channel, MediaService $media, PlatformService $platform,
    AdsTypeService $adsType, AdsFormatService $adsFormat)
    {
        $this->channelService = $channel;
        $this->mediaService = $media;
        $this->platformService = $platform;
        $this->adsTypeService = $adsType;
        $this->adsFormatService = $adsFormat;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $channels = $this->channelService->all();

        return view('admin.channels.index',compact('channels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medias = $this->mediaService->all()->where('status',1);
        $platforms = $this->platformService->all()->where('status',1);

        return view('admin.channels.create',compact('medias','platforms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChannelStoreRequest $request)
    {
        $channel = $this->channelService->create(ChannelDto::fromRequest($request));

        $info = __('Channel').' '.__('added');

        return redirect()->route('admin.channels.index')->with('info',$info);
    }



    public function createAdsPrice(Request $request, string $id)
    {
        $channel = $this->channelService->findById($id);

        $adsTypes = $this->adsTypeService->all()->where('status','1');

        $list_ads_type = '';

        foreach($adsTypes as $type)
        {
            $list_ads_type .= '<option value="'.$type->id.'">'.json_decode($type->name,true)[config('app.locale')].'</option>';
        }

        $adsFormats = $this->adsFormatService->all()->where('status','1');

        $list_ads_format = '';

        foreach($adsFormats as $format)
        {
            $list_ads_format .= '<option value="'.$format->id.'">'.json_decode($format->name,true)[config('app.locale')].'</option>';
        }

        $days = Day::all();

        $periods = Period::all();

        $list_periods = '';

        foreach($periods as $period)
        {
            $list_periods .= '<option value="'.$period->id.'">'.json_decode($period->name,true)[config('app.locale')].'</option>';
        }

        return view('admin.channels.adsprice',compact('channel','adsTypes','list_ads_type','adsFormats','list_ads_format','days','periods','list_periods'));
    }

    public function storeAdsPriceDay(AdsPriceDayRequest $request, string $id)
    {

        $channel = $this->channelService->findById($id);

        //delete All ads price per day
        AdsPrice::where('channel_id',$id)->where('period_id',null)->delete();

        // Save new price
        $tot = count($request->input('day_ads_types'));

        for($i=0;$i<$tot;$i++)
        {
            AdsPrice::create([
                'channel_id' => $channel->id,
                'ads_type_id' => $request->input('day_ads_types')[$i],
                'ads_format_id' => $request->input('day_ads_formats')[$i],
                'price' => $request->input('day_price')[$i]
            ]);
        }

        $info = __('Ads price per day').' '.__('updated');

        return back()->with('info',$info);

    }

    public function storeAdsPricePeriod(AdsPricePeriodRequest $request, string $id)
    {
        $channel = $this->channelService->findById($id);

        //delete All ads price per day
        AdsPrice::where('channel_id',$id)->where('period_id','!=',null)->delete();

        // Save new price
        $tot = count($request->input('period_ads_types'));

        for($i=0;$i<$tot;$i++)
        {
            AdsPrice::create([
                'channel_id' => $id,
                'ads_type_id' => $request->input('period_ads_types')[$i],
                'ads_format_id' => $request->input('period_ads_formats')[$i],
                'price' => $request->input('period_price')[$i],
                'period_id' => $request->input('periods')[$i]
            ]);
        }

        $info = __('Ads price per period').' '.__('updated');

        return back()->with('info',$info);

    }


    public function createProgram(string $id)
    {
        $channel = $this->channelService->findById($id);

        $days = Day::all();

        return view('admin.channels.program',compact('channel','days'));

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $channel = $this->channelService->findById($id);

        $medias = $this->mediaService->all()->where('status',1);
        $platforms = $this->platformService->all()->where('status',1);

        return view('admin.channels.edit',compact('channel','medias','platforms'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $channel = $this->channelService->findById($id);

        $medias = $this->mediaService->all()->where('status',1);
        $platforms = $this->platformService->all()->where('status',1);

        return view('admin.channels.edit',compact('channel','medias','platforms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChannelUpdateRequest $request, string $id)
    {
        $channel = $this->channelService->findById($id);

        $this->channelService->update($channel,ChannelDto::fromRequest($request));

        $info = __('Channel').' '.__('updated');

        return redirect()->route('admin.channels.index')->withInfo($info);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->channelService->destroy($id);

        $info = __('Channel').' '.__('deleted');

        return back()->with('info',$info);
    }
}
