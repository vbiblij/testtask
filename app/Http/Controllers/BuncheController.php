<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bunche;
use App\Http\Requests\BuncheRequest;
use Illuminate\Support\Facades\Auth;

class BuncheController extends Controller
{
    /**
     * Display a buncheing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Bunche $bunche)
    {
        $bunches = $bunche->where('created_by', Auth::user()->id)->orderBy('id', 'asc')->get();
		return view('bunche.index', compact('bunches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bunche.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Bunche $bunche, BuncheRequest $request)
    {
        $bunche->create($request->all());
		return redirect()->route('bunche.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bunche $bunche)
    {
        return view('bunche.subscribers', ['bunche' => $bunche, 'subscribers' => $bunche->subscribers()->where('created_by', Auth::user()->id)->orderBy('id', 'asc')->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bunche $bunche)
    {
        return view('bunche.edit', compact('bunche'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BuncheRequest $request, Bunche $bunche)
    {       
        $bunche->update($request->all());
        return redirect()->route('bunche.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bunche $bunche)
    {
        $bunche->delete();
        return redirect()->route('bunche.index');
    }
}
