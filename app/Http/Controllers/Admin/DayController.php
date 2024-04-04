<?php

namespace App\Http\Controllers\Admin;

use App\Models\Day;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $days = Day::all();

        return view("admin.days.index",compact('days'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.days.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $langs = [];
        $tab = [];

        foreach (config('app.supported_locales') as $key => $value) {
            $name = 'name_' . $key;
            $langs[$name] = 'required|string|max:255';
            $tab[$key] = $request->input($name);
        }

        $validate = $request->validate($langs);

        $data['name'] = json_encode($tab);

        $day = Day::create($data);

        $msg = __('Day') . ' ' . __('added');

        return redirect()->route('admin.days.index')->with('info', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $day = Day::findOrFail($id);

        return view('admin.days.edit',compact('day'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $day = Day::findOrfail($id);

        $langs = [];
        $tab = [];

        foreach (config('app.supported_locales') as $key => $value) {
            $name = 'name_' . $key;
            $langs[$name] = 'required|string|max:255';
            $tab[$key] = $request->input($name);
        }

        $validate = $request->validate($langs);

        $data['name'] = json_encode($tab);

        $day->update($data);

        $msg = __('Day') . ' ' . __('updated');

        return redirect()->route('admin.days.index')->with('info', $msg);
    }#

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $day = Day::findOrFail($id);

        $day->delete();

        $info = __('Day').' '.__('deleted');

        return back()->with('info',$info);
    }
}
