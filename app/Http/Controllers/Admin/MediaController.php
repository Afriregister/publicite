<?php

namespace App\Http\Controllers\Admin;

use App\DTO\MediaDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaStoreRequest;
use App\Http\Requests\Admin\MediaUpdateRequest;
use App\Services\MediaService;
use App\Services\UserService;

class MediaController extends Controller
{
    protected $mediaService;

    protected $userService;

    public function __construct(MediaService $mediaservice, UserService $user)
    {
        $this->mediaService = $mediaservice;

        $this->userService = $user;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medias = $this->mediaService->all();

        return view('admin.media.index', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = $this->userService->all();

        return view('admin.media.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MediaStoreRequest $request)
    {
        $media = $this->mediaService->create(MediaDto::fromRequest($request));

        $info = __('Media') . ' ' . __('added');

        return redirect()->route('admin.media.index')->with('info', $info);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $media = $this->mediaService->findById($id);

        $users = $this->userService->all();

        return view('admin.media.edit', compact('media', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $media = $this->mediaService->findById($id);

        $users = $this->userService->all();

        return view('admin.media.edit', compact('media', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MediaUpdateRequest $request, int $id)
    {
        $media = $this->mediaService->findById($id);

        $this->mediaService->update($media, MediaDto::fromRequest($request));

        $info = __('Media') . ' ' . __('updated');

        return redirect()->route('admin.media.index')->with('info', $info);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->mediaService->destroy($id);

        $info = __('Media') . ' ' . __('deleted');

        return back()->with('info', $info);
    }
}
