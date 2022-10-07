<?php

namespace App\Http\Controllers;

use App\Models\TransactionCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = TransactionCategory::all();
        return Inertia::render('TransactionCategory/Index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('TransactionCategory/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required'],
            'description' => ['required'],
            'type' => ['required'],
            'noncash' => ['required'],
        ]);
        TransactionCategory::create(
            $request->only('category', 'description', 'type', 'noncash')
        );
        return redirect()->route('category.index')->with('message', 'data berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionCategory  $transactionCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionCategory $transactionCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionCategory  $transactionCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionCategory $transactionCategory)
    {
        return Inertia::render('TransactionCategory/Edit', compact('transactionCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionCategory  $transactionCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionCategory $transactionCategory)
    {
        $request->validate([
            'category' => ['required'],
            'description' => ['required'],
            'type' => ['required'],
            'noncash' => ['required']
        ]);
        $transactionCategory->update($request->all());
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionCategory  $transactionCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionCategory $transactionCategory)
    {
        $transactionCategory->delete();
        return redirect()->back();
    }
}
