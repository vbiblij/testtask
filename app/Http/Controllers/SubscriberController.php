<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubscriberRequest;
use App\Subscriber;
use App\Bunche;

class SubscriberController extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     
    public function index()
    {
        //
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Bunche $bunche)
    {
		return view('subscriber.create', compact('bunche'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SubscriberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Bunche $bunche, Subscriber $subscriber, SubscriberRequest $request)
    {
		$data = $request->all();
		$data['bunche_id'] = $bunche->id;
		$subscriber->create($data);
		return redirect()->route('bunche.show', [$bunche->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bunche $bunche, Subscriber $subscriber)
    {        
		return view('subscriber.edit', ['bunche' => $bunche, 'subscriber' => $subscriber]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SubscriberRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubscriberRequest $request, Bunche $bunche, Subscriber $subscriber)
    {		             
        $subscriber->update($request->all());
        return redirect()->route('bunche.show', [$bunche->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bunche $bunche, Subscriber $subscriber)
    {        
        $subscriber->delete();
		return redirect()->route('bunche.show', [$bunche->id]);
    }
}
