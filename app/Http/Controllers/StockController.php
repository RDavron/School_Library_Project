<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // クエリを組み立てる
        $id = $request->id;
        $query = Stock::orderBy('id');
        if ($request->id) {
             $query->where('id', $request->id);
         }
        // 商品検索結果を取得
        $stocks= $query->paginate(10);
        return view('stocks/top', [
        'stocks' => $stocks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //新規作成画面を表示
        $stock = new Stock;
        return view('stocks.create');
    }

    public function confirm(Request $request)
    {
        //確認画面の表示
        $this->validate($request, [
            'id' => 'required|unique:stocks',
            'ISBN_number' => 'required|exists:documents,ISBN_number',
            'arrival_date' => 'required'
            // 'id' => 'required'
        ]);
            
        // dd(12345);
        return view('stocks.confirm', ['request'=>$request]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //登録する
        
        $stock = new \App\Models\Stock;
        $stock->id = $request->id;
        $stock->ISBN_number = $request->ISBN_number;
        $stock->arrival_date = $request->arrival_date;
        $stock->save();
        return view('check.complete');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //詳細画面を表示
    //     $stock = \App\Models\Stock::find('id');
    //     return view('stocks.show', ['stock' => $stock]);
    // }

    public function edit($id)
    {
        //編集画面の表示
        $stock = \App\Models\Stock::find($id);
        return view('stocks.edit', ['stock' => $stock]);
    }

    public function update(Request $request, $id)
    {
        //廃棄年月日と廃棄理由の入力確認
        $stock = \App\Models\Stock::find($id);
        $stock->waste_date = $request->waste_date;
        $stock->remark = $request->remark;
        $stock->save();
        return view('stocks.update', ['stock' => $stock]);
    }
}