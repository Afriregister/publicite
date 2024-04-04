<?php

namespace App\Http\Controllers\Admin;

use App\Models\Period;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periods = Period::all();

        return view('admin.periods.index',compact('periods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.periods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $langs = [];
        $tab = [];
        $des = [];

        foreach (config('app.supported_locales') as $key => $value) {
            $name = 'name_' . $key;
            $descr = 'description_'.$key;
            $langs[$name] = 'required|string|max:255';
            $langs[$descr] = 'required|string|max:255';
            $tab[$key] = $request->input($name);
            $des[$key] = $request->input($descr);
        }

        $langs['status'] = 'required|numeric';

        $validate = $request->validate($langs);

        $data['name']           = json_encode($tab);
        $data['description']    = json_encode($des);
        $data['status']         = $request->input('status');


        Period::create($data);

        $msg = __('Period') . ' ' . __('added');

        return redirect()->route('admin.periods.index')->with('info', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $period = Period::findOrFail($id);

        return view('admin.periods.edit',compact('period'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $period = Period::findOrFail($id);

        return view('admin.periods.edit',compact('period'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $period = Period::findOrFail($id);

        $langs = [];
        $tab = [];
        $des = [];

        foreach (config('app.supported_locales') as $key => $value) {
            $name = 'name_' . $key;
            $descr = 'description_'.$key;
            $langs[$name] = 'required|string|max:255';
            $langs[$descr] = 'required|string|max:255';
            $tab[$key] = $request->input($name);
            $des[$key] = $request->input($descr);
        }

        $langs['status'] = 'required|numeric';

        $validate = $request->validate($langs);

        $data['name']           = json_encode($tab);
        $data['description']    = json_encode($des);
        $data['status']         = $request->input('status');


        $period->update($data);

        $info = __('Period').' '.__('updated');

        return redirect()->route('admin.period.index')->with('info',$info);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $period = Period::findOrFail($id);

        $period->delete();

        $info = __('Period').' '.__('deleted');

        return back()->with('info',$info);
    }
}
