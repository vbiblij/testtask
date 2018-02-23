<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CampaignRequest;
use App\Campaign;
use Illuminate\Support\Facades\Auth;
use Mailgun\Mailgun;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign)
    {
        $campaigns = $campaign->where('created_by', Auth::user()->id)->orderBy('id', 'asc')->get();
		return view('campaign.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CampaignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Campaign $campaign, CampaignRequest $request)
    {
        $campaign->create($request->all());
		return redirect()->route('campaign.index');
    }

    /*send*/
    public function send(Campaign $campaign)
    {
		$mgClient = new Mailgun('key-6747512b8357a8133d9e6623797068fd');
		$domain = "sandboxdd01dd4c11434f8da4061ce354d8b07b.mailgun.org";
		
		$subscribers = $campaign->bunche()->find($campaign->bunche_id)->subscribers()->orderBy('id', 'asc')->get();
		
		$to = [];
		foreach ($subscribers as $subscriber){
			array_push($to, $subscriber->email);
		}
		
		$result = $mgClient->sendMessage($domain, array(
			'from'    => Auth::user()->email,
			'to'      => implode(', ', $to),
			'subject' => $campaign->name,
			'text'    => $campaign->template()->find($campaign->template_id)->content
		));
		
		//$client = new \Http\Adapter\Guzzle6\Client();

		/*$mailgun = Mailgun::create('pubkey-37a777558322be83a55b5819fbee7682');
		Mailgun::sendMessage($domain, array(
			'from'    => Auth::user()->email,
			'to'      => implode(', ', $to),
			'subject' => $campaign->name,
			'text'    => $campaign->template()->find($campaign->template_id)->content
		));*/
			
		/*$mgClient = new Mailgun('pubkey-37a777558322be83a55b5819fbee7682' ,$client);	
			

		# Make the call to the client.
		$result = $mgClient->sendMessage($domain, array(
			'from'    => Auth::user()->email,
			'to'      => implode(', ', $to),
			'subject' => $campaign->name,
			'text'    => $campaign->template()->find($campaign->template_id)->content
		));*/
	}
	
    /*preview*/
    public function preview(Campaign $campaign)
    {
		$from = Auth::user()->email;
		$template = $campaign->template()->find($campaign->template_id);		
		$subscribers = $campaign->bunche()->find($campaign->bunche_id)->subscribers()->orderBy('id', 'asc')->get();
		
		$to = [];
		foreach ($subscribers as $subscriber){
			array_push($to, $subscriber->email);
		}
		
        return view('campaign.preview', ['campaign' => $campaign, 'to' => implode(', ', $to), 'template' => $template, 'from' => $from]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        return view('campaign.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('campaign.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CampaignRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CampaignRequest $request, Campaign $campaign)
    {       
        $campaign->update($request->all());
        return redirect()->route('campaign.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()->route('campaign.index');
    }
}
