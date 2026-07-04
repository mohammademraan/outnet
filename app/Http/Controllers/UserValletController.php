<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVallet;
use Illuminate\Http\Request;

class UserValletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Get the associated wallet information
        $valletInformation = UserVallet::where('user_id', $user->id)->first();

        // Return the view with user and wallet information
        return view('admin.wallet-information', compact('user', 'valletInformation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::findOrFail($id);

        return view('admin.add-user-wallet', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'vallet_address' => 'required|string',
            'type' => 'required|string',
            'phone' => 'required|string',
        ]);

        $vallet = new UserVallet();
        $vallet->user_id = $request->input('user_id');
        $vallet->vallet_address = $request->input('vallet_address');
        $vallet->type = $request->input('type');
        $vallet->phone = $request->input('phone');
        $vallet->save();

        return redirect('/administration')->with('walletCreateSuccess', 'Wallet information saved.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        // Retrieve wallet information using Eloquent
        $valletInformation = UserVallet::where('user_id', $id)->first();

        // Check if wallet information exists
        if (!$valletInformation) {
            return redirect()->back()->with('error', 'Wallet information not found.');
        }

        // Return the wallet information to the Blade template for editing
        return view('admin.edit-wallet-information', compact('valletInformation', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(UserVallet $userVallet)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'vallet_address' => 'required|string',
            'type' => 'required|string',
            'phone' => 'required|string',
        ]);

        // Retrieve the wallet record by user_id
        $wallet = UserVallet::where('user_id', $request->input('user_id'))->firstOrFail();

        // Update the wallet information
        $wallet->vallet_address = $request->input('vallet_address');
        $wallet->type = $request->input('type');
        $wallet->phone = $request->input('phone');
        $wallet->save();

        // Redirect back with a success message
        return redirect('/administration')->with('walletUpdateSuccess', 'Wallet information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserVallet $userVallet)
    {
    }
}
