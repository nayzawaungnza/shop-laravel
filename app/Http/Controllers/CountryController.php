<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::when(request('key'),function($query){
            $query->where('name','like','%'. request('key').'%');
            })
            ->orderBy('created_at','desc')
            ->paginate(5);
        $countries->appends(request()->all());

    return view('admin.country.index',compact('countries'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->countryValidationCheck($request);
        Country::create($data);

        return redirect()->route('admin#countrylist')->with(['create'=>'Country Created Success']);
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
        $country = Country::findOrFail($id);
        return view('admin.country.edit',compact('country'));
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
        $data = $this->countryValidationCheckUpdateData($request);
        //dd($data);

        Country::where('id',$id)->update($data);
        return redirect()->route('admin#countrylist')->with(['update'=>'Country Updated Success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Country::where('id',$id)->delete();
        return back()->with(['delete'=>'Country deleted...']);
    }


    private function countryValidationCheck($request){
        Validator::make($request->all(),[
            'countryName' => 'required|min:4|unique:countries,name,'.$request->id,
            'countryIso' => 'required|min:2|unique:countries,iso_code,'.$request->id,
        ],
        [
            'countryName.required' => 'Enter Country Name',
            'countryIso.required' => 'Enter Country ISO Code',
        ])->validate();

        return [
            'name' => $request->countryName,
            'iso_code' => $request->countryIso,

        ];

    }

    //Get States
    public function getStates(Request $request)
        {
            $states = State::where("country_id",$request->country_id)->pluck("name","id");
            return response()->json($states);
        }


    private function countryValidationCheckUpdateData($request){
        Validator::make($request->all(),[
            'countryName' => 'required|min:4|unique:countries,name,'.$request->id,
            'countryIso' => 'required|min:2|unique:countries,iso_code,'.$request->id,
        ],
        [
            'countryName.required' => 'Enter Country Name',
            'countryIso.required' => 'Enter Country ISO Code',
        ])->validate();

        return [
            'name' => $request->countryName,
            'iso_code' => $request->countryIso,
            'updated_at' => Carbon::now(),

        ];

    }

}
