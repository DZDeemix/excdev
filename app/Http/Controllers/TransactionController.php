<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        return Transaction::query()
            ->when($request->get('sortBy'), function (Builder $builder) use ($request) {
                $builder->orderBy($request->get('sortBy'), $request->get('sortDirection'));
            })
            ->when($request->get('search'), function (Builder $builder) use ($request) {
                $builder->where('description', 'like', "%{$request->get('search')}%");
            })->get();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        return view('transactions.show');
    }

    public function getTransactionsByUserId(Request $request)
    {
        $user = Auth::user();

        return $user->load(['balance.transactions' => function ($builder) use ($request) {
            $builder->orderBy('created_at', 'DESC')
                ->when($request->get('limit'), function (Builder $builder) use ($request) {
                    $builder->limit((int) $request->get('limit'));
                })
            ;
        }]);
    }
}
