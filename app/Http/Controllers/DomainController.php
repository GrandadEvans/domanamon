<?php

declare(strict_types=1);

namespace Domanamon\Http\Controllers;

use Domanamon\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * DomainController constructor.
     *
     * Add any middleware and setup params etc
     */
    public function __construct()
    {
        // We only want authenticated users to access the domains section
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Domains.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Domains.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // persist the new domain
        $domain = new Domain([
            'url' => $request->domain
        ]);

        $user = auth()->user();

        // Associate the user with the domain
        $user->domains()->save($domain);

        // Display the page
        return view('Domains.index')
            ->with('domains', $user->domains)
            ->with('flashMessage', 'You have successfully added your latest domain')
            ;
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
