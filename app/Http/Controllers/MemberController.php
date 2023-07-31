<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validate($request,[
            'keyword' => 'required',
        ]);

        $members = Member::query();

        $keyword = $request->input('keyword');
        if(!empty($keyword)) {
            $members->where('email', 'LIKE', "%{$keyword}%")->get();
            $posts = $members->paginate(5);
            return view('search.members', ['posts' => $posts]);
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function form()
    {
        return view('search.form');
    }

    public function create()
    {
        return view('members.create_account');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('back')){
            return redirect()->route("members.create")->withInput();
        }
        
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:members',
            'tel' => 'required',
        ]);

        $inputs = new \App\Models\Member;
        $inputs->name = $request->name;
        $inputs->email = $request->email;
        $inputs->address = $request->address;
        $inputs->tel = $request->tel;
        $inputs->birthday = $request->birthday;
        $inputs->save();
        return view('check.complete');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return view('search.show', ['member' => $member]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = \App\Models\Member::find($id);
        return view('members.edit',['member' => $member]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->has('back')){
            return redirect()->route("members.edit",$id)->withInput();
        }

        $this->validate($request,[
            'name' => 'required',
            'email'=> Rule::unique('members')->ignore($id),
            'tel' => 'required',
        ]);

        $member = \App\Models\Member::find($id);
        $member->name = $request->name;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->tel = $request->tel;
        $member->birthday = $request->birthday;
        $member->update();
        return view('members.complete');

    }

    public function confirm_create(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:members',
            'tel' => 'required',
        ]);

        return view('check.create',[
            'inputs' => $request->all(),
        ]);
    }

    public function confirm_edit(Request $request, $member_id)
    {
        $this->validate($request,[
            'name' => 'required',
            'email'=> Rule::unique('members')->ignore($member_id),
            'tel' => 'required',
        ]);

        return view('check.edit',
        [
            'member' => $request->all(),
            'member_id' => $member_id
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = \App\Models\Member::find($id);
        $member ->delete();
        return redirect(route('home'));
    }
}
