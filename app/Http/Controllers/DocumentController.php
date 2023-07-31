<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Stock;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // クエリを組み立てる
        $ISBN_number = $request->ISBN_number;
        $query = Document::orderBy('ISBN_number');
        if ($request->ISBN_number) {
             $query->where('ISBN_number', $request->ISBN_number);
         }
        $documents= $query->paginate(10);
        return view('documents/top', [
        'documents' => $documents
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
        return view('documents.create');
    }

    public function confirm(Request $request)
    {
        //確認画面の表示
        $this->validate($request, [
            'ISBN_number' => 'required|unique:documents',
            'document_name' => 'required',
            'code' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publisher_date' => 'required',
        ]);

        return view('documents.confirm', ['request'=>$request]);
    }

    public function edit_confirm(Request $request)
    {
        //確認画面の表示
        return view('documents.confirm', ['request'=>$request]);
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
        $document = new \App\Models\Document;
        $document->ISBN_number = $request->ISBN_number;
        $document->document_name = $request->document_name;
        $document->code = $request->code;
        $document->author = $request->author;
        $document->publisher = $request->publisher;
        $document->publisher_date = $request->publisher_date;
        $document->save();
        return view('check.complete');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ISBN_number)
    {
        //詳細画面表示
        $document = \App\Models\Document::where('ISBN_number', $ISBN_number)->first();
        return view('documents.show', ['document' => $document]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ISBN_number)
    {
        //編集画面の表示
        $document = \App\Models\Document::where('ISBN_number', $ISBN_number)->first();
        return view('documents.edit', ['document' => $document]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ISBN_number)
    {
        //更新処理
        $document =\App\Models\Document::where('ISBN_number', $ISBN_number)->first();
        $document->ISBN_number = $request->ISBN_number;
        $document->document_name = $request->document_name;
        $document->code = $request->code;
        $document->author = $request->author;
        $document->publisher = $request->publisher;
        $document->publisher_date = $request->publisher_date;
        $document->save();
        // $document->update($request->all());
        return view('documents.store');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ISBN_number)
    {
        // $document = \App\Models\Document::where('ISBN_number', $ISBN_number)->first();
        // $document->delete();
        \App\Models\Document::where('ISBN_number', $ISBN_number)->delete();
        return redirect(route('documents.index'));
    }
}
