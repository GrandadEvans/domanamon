<?php

declare(strict_types=1);

namespace Domanamon\Http\Controllers;

use DebugBar\DebugBar;
use Domanamon\Domain;
use Domanamon\Http\Requests\Domains\StoreRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
        // Display the page
        return view('Domains.index')
            ->with('domains', auth()->user()->domains);
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
     * @param \Domanamon\Http\Requests\Domains\StoreRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $user = auth()->user();

        // persist the new domain
        $domain = new Domain([
            'url' => $request->domain
        ]);

        // Associate the user with the domain
        $user->domains()->save($domain);

        if ($request->wantsJson()) {
            \DebugBar::info($request->wantsJson());
            return response()
                ->view('Domains.index')
                ->with('domains', $user->domains)
                ->with('success', 'Domain Added.');
        }

        debugbar()->info($request->wantsJson());
        return redirect(route('domains.index'), 303);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd([
            __METHOD__,
            Route::currentRouteName()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Domain $domains)
    {
        return view('Domains.edit')
            ->with('domain', $domains);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd([
            __METHOD__,
            Route::current()
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \Domanamon\Domain $domains
     *
     * @return string|\Illuminate\Http\Response
     */
    public function destroy(Domain $domains)
    {
        try {
            $domains->delete();
        }
        catch (Exception $e)
        {
            /**
             * @todo Change error message to user friendly one and log error
             */
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([], 204);
    }
}
