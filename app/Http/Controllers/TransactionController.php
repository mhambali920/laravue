<?php

namespace App\Http\Controllers;

use App\Models\TransactionCategory;
use App\Models\Cashless;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transactions = [];
        $dates = Transaction::distinct('date')->orderBy('date', 'DESC')->pluck('date');
        foreach ($dates as $date) {
            $perDates = Transaction::with(['rCategory'])->where('date', $date)->get();
            $transactions[$date] = $perDates;
        }
        // $transactions = Transaction::with(['rCategory'])->get();

        return Inertia::render('Transaction/Index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = TransactionCategory::all();
        return Inertia::render('Transaction/Create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['payment_method' => 'required']);
        // dd($request->payment_method);
        // jika payment method tunai maka save ke tabel transaksi
        if ($request->payment_method == "1") {
            $request->validate([
                'category_id' => 'required',
                'date' => 'required',
                'amount' => 'required|integer',
            ]);
            $data = [
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
                'contact_name' => $request->contact_name,
                'date' => $request->date,
                'amount' => $request->amount,
                'description' => $request->description
            ];
            Transaction::create($data);
            return redirect()->route('transaction.index')->banner('Transaction added successfuly');
        }
        // jika non tunai save ke tabel cashless
        $request->validate([
            'category_id' => 'required',
            'date' => 'required',
            'amount' => 'required|integer',
            'contact_name' => 'required',
            'due_date' => 'required'
        ]);
        $data = [
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'contact_name' => $request->contact_name,
            'date' => $request->date,
            'amount' => $request->amount,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ];
        Cashless::create($data);
        return redirect()->route('transaction.index')->banner('Data transaksi telah di catat ke Pi/Utang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transaction.index')->dangerBanner('Data deleted successfully');
    }

    public function getTransaction(Transaction $transaction)
    {
        $data = [];
        $tanggal = $transaction->distinct('date')->pluck('date');
        foreach ($tanggal as $item) {
            $pertanggal = $transaction->with(['rCategory'])->where('date', $item)->get()->toArray();
            $data[$item] = $pertanggal;
        }
        return $data;
    }
}
