<?php

namespace App\Http\Controllers;

use App\Models\Lend;
use App\Models\Stock;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->test;
        $query = Lend::orderBy('created_at','desc');
        if ($request->test) {
             $query->where('return_date', null);
         }
         if ($request->id) {
            $query->where('id' , $request->id);
         }
        // 商品検索結果を取得
        $lends= $query->paginate(10);
        
        // $lends = Lend::orderBy('created_at','desc')->get();
        // $lends = Lend::member()->lends()->orderBy('created_at','desc')->paginate(20);

    //   $query = Product::select('m.name', 'l.document_id', 'l.lend_date')
    //   ->
    // $stocks_list = collect([]);
    // $members = Member::all();
    // foreach ($members as $member) {
    //     $stocks = $member->stocks()->get();
    //     $stocks_list->add($stocks);
        
    // }
    // dd($stocks_list);
    // $stock = Stock::find(1);
    // dd($stock->members())
    return view('lends/return/lend_index', ['lends' => $lends]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lend = new Lend;
        return view('lends/lend_create', ['lend' => $lend]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $this->validate($request, [
        //     'member_id' => 'required|exists:members,id',
        //     'stock_id' => 'required|exists:stocks,id',
        //     'lend_date' => 'required|date',
        //     'due_date' => 'required|date',
        //     'return_date' => 'date',
        //     'remark' => 'max:150'
        // ]);
        $this->validate($request, [
            'member_id' => 'required|exists:members,id',
            // 'stock_id' => 'required|exists:stocks,id',
            'stock_id' => ['required','exists:stocks,id',Rule::unique('lends', 'stock_id')->
            where('member_id', $request->member_id)
        ],
            'lend_date' => 'required|date',
            'due_date' => 'required|date',
            'return_date' => 'date',
            'remark' => 'max:150',
        ]);

        
        
        
        $lender = new Lend;
        $lender->member_id = $request->member_id;
        $lender->stock_id = $request->stock_id;
        $lender->lend_date = $request->lend_date;
        $lender->due_date = $request->due_date;
        $lender->return_date = $request->return_date;
        $lender->remark = $request->remark;
        // dd($lender);
        $lender->save();


        // stocks()->attach($request->document_id);

        // $lend = $request->user()->lends()->create($request->all());
        $lend = new Lend;
        return redirect(route('lends.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }
    public function show(Lend $lend)
    {
        //
        return view('showのview', ['lend' => $lend]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lend $lend)
    {
        //
        return view('editのviewが本当にあるのなら',['lend' => $lend]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lend $lend)
    {
        //
        // $this->validate($request, [
        //     'member_id' => 'required|exists:members,id',
        //     'document_id' => 'required|exists:stocks,id',
        //     'lend_date' => 'required|date',
        //     'due_date' => 'required|date',
        //     'return_date' => 'date',
        //     'remark' => 'max:150'
        // ]); 
        
        // $lend->update($request->all());
        $lendr = Lend::find($request->id);
        
        $lendr->return_date = $request->return_date;
        $lendr->save();
        // return redirect(route('showのview', $lend));

        $lends = Lend::orderBy('created_at','desc')->paginate(10);
        return view('lends/return/lend_index', ['lends' => $lends]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lend $lend)
    {
        // 貸出台帳を削除する機能がある場合はここを
        $lend->delete();
        return redirect(route('home'));

    }

    public function lend_check(Request $request)
    {
        
        // 借りている本が5冊以上または返却期限が過ぎている本があると貸せない
        // $query = Lend::orderBy('created_at','desc')->where('member_id',$request->member_id)->where('return_date',null)->get();

        // $query2 = Lend::orderBy('created_at','desc')->where('member_id',$request->member_id)
        // ->where('return_date',null)->whereRaw('DATEDIFF(due_date, due_date) <= 0')->get();

        // $query3 = Lend::select("select count(*) as 'date' from
        //  lends where member_id = ?", [$request->member_id] ,
        //  "and return_date IS NULL AND DATEDIFF(due_date,CURRENT_DATE()) <= 0;" )->get();

        //  $query4 = Lend::orderBy('created_at','desc')->where('member_id',$request->member_id)->where('return_date',null);

        // dd($query->count()); // 5以上だと貸せない
        // dd($request->member_id);
        // dd($query3);
        $this->validate($request, [
            'member_id' => 'required|exists:members,id',
            // 'stock_id' => 'required|exists:stocks,id',
            'stock_id' => ['required','exists:stocks,id',Rule::unique('lends', 'stock_id')->
            where('member_id', $request->member_id)
        ],
            'lend_date' => 'required|date',
            'due_date' => 'required|date',
            'return_date' => 'date',
            'remark' => 'max:150',
        ]);
        $lend = $request;
        return view('lends/lend_check', ['lend' => $lend]);
    }
    public function return_check(Lend $lend)
    {
        //デバッグ用
        // dd($stock);

        // $this->validate($request, [
        //     'member_id' => 'required|exists:members,id',
        //     'document_id' => 'required|exists:stock,id',
        //     'lend_date' => 'required|date',
        //     'due_date' => 'required|date',
        //     'return_date' => 'date',
        //     'remark' => 'max:150'
        // ]);
        
        return view('lends/return/return', ['lend' => $lend]);
    }
}
