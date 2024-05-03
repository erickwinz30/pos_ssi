<?php

namespace App\Http\Controllers;

use App\Models\PosSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PosSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->checkSession()) {
            return redirect()->route('point-of-sales.index');
        }

        return view('point-of-sales.index');
    }

    public function checkSession() {
        return PosSession::where('user_id', Auth::user()->id)->whereNull('end_at')->exists();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PosSession::create([
            'user_id' => $request->user_id,
            'initial_cash' => $request->initial_cash,
            'start_at' => now()->timezone('Asia/Jakarta'),
        ]);

        return redirect()->route('point-of-sales.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PosSession $posSession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PosSession $posSession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PosSession $posSession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PosSession $posSession)
    {
        //
    }
}
