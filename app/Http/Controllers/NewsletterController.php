<?php

namespace App\Http\Controllers;

use App\Models\newsletter;
use App\Http\Requests\StorenewsletterRequest;
use App\Http\Requests\UpdatenewsletterRequest;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorenewsletterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorenewsletterRequest $request)
    {
        newsletter::create([
            'email' => $request->email
        ]);
        return redirect()->back()->with('success', 'You have successfully subscribed to our newsletter');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatenewsletterRequest  $request
     * @param  \App\Models\newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatenewsletterRequest $request, newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(newsletter $newsletter)
    {
        //
    }
}
