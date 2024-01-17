<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Township;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TownshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $townships = Township::when(request('key'),function($query){
            $query->where('name','like','%'. request('key').'%');
            })
            ->orderBy('created_at','desc')
            ->paginate(5);
        $townships->appends(request()->all());

    return view('admin.township.index',compact('townships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        return view('admin.township.create',compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data = $this->townshipValidationCheck($request);

        Township::create($data);
        return redirect()->route('admin#townshiplist')->with(['create'=>'Township Created Success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $township = Township::findOrFail($id);
        $states = State::all();
        return view('admin.township.edit',compact('states','township'));
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
        $data = $this->townshipValidationCheck($request);
        Township::where('id',$id)->update($data);
        return redirect()->route('admin#townshiplist')->with(['update'=>'Township Updated Success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Township::where('id',$id)->delete();
        return back()->with(['delete'=>'Township deleted...']);
    }


    private function townshipValidationCheck($request){
        Validator::make($request->all(),[
            'townshipName' => 'required|min:4|unique:states,name,'.$request->id,
            'state' => 'required',
        ],
        [
            'townshipName.required' => 'Enter Township Name',
            'state.required' => 'Select a State',
        ])->validate();

        return [
            'name' => $request->townshipName,
            'state_id' => $request->state,

        ];

    }
}
