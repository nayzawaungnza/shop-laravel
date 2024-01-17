<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::when(request('key'),function($query){
            $query->where('name','like','%'. request('key').'%');
            })
            ->orderBy('created_at','desc')
            ->paginate(5);
        $states->appends(request()->all());

    return view('admin.state.index',compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.state.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->stateValidationCheck($request);

        State::create($data);

        return redirect()->route('admin#statelist')->with(['create'=>'State Created Success']);
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
        $state = State::findOrFail($id);
        $countries = Country::all();
        return view('admin.state.edit',compact('countries','state'));
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
        $data = $this->stateValidationCheck($request);

        State::where('id',$id)->update($data);
        return redirect()->route('admin#statelist')->with(['update'=>'State Updated Success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        State::where('id',$id)->delete();
        return back()->with(['delete'=>'State deleted...']);
    }


    public function getTownships($stateId)
        {
            $state = State::findOrFail($stateId);
            $townships = $state->townships()->pluck('name', 'id');
            return response()->json($townships);
        }


    private function stateValidationCheck($request){
        Validator::make($request->all(),[
            'stateName' => 'required|min:4|unique:states,name,'.$request->id,
            'country' => 'required',
        ],
        [
            'stateName.required' => 'Enter State Name',
            'country.required' => 'Choose Country',
        ])->validate();

        return [
            'name' => $request->stateName,
            'country_id' => $request->country,

        ];

    }


}
