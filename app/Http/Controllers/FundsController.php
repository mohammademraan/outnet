<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFundsRequest;
use App\Models\Funds;
use App\Models\User;
use Illuminate\Http\Request;

class FundsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::findOrFail($id);

        return view('admin.add-debit', compact('user'));
    }

    /**
     * Show recharge (deposit) history for a user.
     */
    public function rechargeHistory($id)
    {
        $user = User::findOrFail($id);
        $funds = Funds::where('user_id', $id)
            ->where('type', 'deposit')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.recharge-history', compact('user', 'funds'));
    }

    /**
     * Show redemption (withdraw) history for a user.
     */
    public function redemptionHistory($id)
    {
        $user = User::findOrFail($id);
        $funds = Funds::where('user_id', $id)
            ->where('type', 'withdrawal')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.redemption-history', compact('user', 'funds'));
    }

    /**
     * Show all pending recharge (deposit) requests.
     */
    public function rechargeRequests()
    {
        $funds = Funds::with('user')
            ->where('type', 'deposit')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.recharge-request', compact('funds'));
    }

    /**
     * Show all pending redemption (withdrawal) requests.
     */
    public function redemptionRequests()
    {
        $funds = Funds::with('user')
            ->where('type', 'withdrawal')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.redemption-request', compact('funds'));
    }

    /**
     * Approve a pending fund request (set status to active).
     */
    public function approve($id)
    {
        $fund = Funds::findOrFail($id);
        $fund->status = 'active';
        $fund->save();

        return redirect()->back()->with('success', 'Fund request approved.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:deposit,withdrawal,commission',
        ]);

        $funds = new Funds();
        $funds->user_id = $request->input('id');
        $funds->amount = $request->input('amount');
        $funds->type = $request->input('type');
        // Admin-added funds are pre-approved — explicitly active, not pending
        $funds->status = 'active';
        $funds->save();

        return redirect('/administration')->with('funds_success', 'Your funds has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Funds $funds)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Funds $funds)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFundsRequest $request, Funds $funds)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funds $funds)
    {
    }
}
