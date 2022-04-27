<?php

namespace App\Http\Controllers;

use App\Http\Resources\DressResource;
use App\Models\Dress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public static $wrap = 'dresses';

    public function index()
    {
        $dresses = Dress::all();

        $my_dresses=array();
        foreach($dresses as $dress){
            array_push($my_dresses,new DressResource($dress));
        }

        return $my_dresses;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function getByDesigner($designer_id){
        $dresses=Dress::get()->where('designer_id',$designer_id);

        if(count($dresses)==0){
            return response()->json('Designer with this id does not exist!');
        }

        $my_dresses=array();
        foreach($dresses as $dress){
            array_push($my_dresses,new DressResource($dress));
        }

        return $my_dresses;
    }

    public function myDresses(Request $request){
        $dresses=Dress::get()->where('user_id',Auth::user()->id);
        if(count($dresses)==0){
            return 'You do not have saved dresses!';
        }
        $my_dresses=array();
        foreach($dresses as $dress){
            array_push($my_dresses,new DressResource($dress));
        }

        return $my_dresses;
    }

    public function getByType($type_id){
        $dresses=Dress::get()->where('type_id',$type_id);

        if(count($dresses)==0){
            return response()->json('ID of this type does not exist!');
        }

        $my_dresses=array();
        foreach($dresses as $dress){
            array_push($my_dresses,new DressResource($dress));
        }

        return $my_dresses;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'model'=>'required|String|max:255',
            'color'=>'required|String|max:255',
            'releaseYear'=>'required|Integer|max:4',
            'designer_id'=>'required',
            'type_id'=>'required'


        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $dress=new Dress;
        $dress->model=$request->model;
        $dress->color=$request->color;
        $dress->releaseYear=$request->releaseYear;
        $dress->user_id=Auth::user()->id;
        $dress->type_id=$request->type_id;
        $dress->designer_id=$request->designer_id;

        $dress->save();

        return response()->json(['Dress is saved successfully!',new DressResource($dress)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dress  $dress
     * @return \Illuminate\Http\Response
     */
    public function show(Dress $dress)
    {
        return new DressResource($dress);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dress  $dress
     * @return \Illuminate\Http\Response
     */
    public function edit(Dress $dress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dress  $dress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dress $dress)
    {
        $validator=Validator::make($request->all(),[
            'model'=>'required|String|max:255',
            'color'=>'required|String|max:255',
            'releaseYear'=>'required|Integer|max:4',
            'designer_id'=>'required',
            'type_id'=>'required'


        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $dress=new Dress;
        $dress->model=$request->model;
        $dress->color=$request->color;
        $dress->releaseYear=$request->releaseYear;
        $dress->user_id=Auth::user()->id;
        $dress->type_id=$request->type_id;
        $dress->designer_id=$request->designer_id;

        $result=$dress->update();

        if($result==false){
            return response()->json('Difficulty with updating!');
        }
        return response()->json(['Dress is updated successfully!',new DressResource($dress)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dress  $dress
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dress $dress)
    {
        $dress->delete();

        return response()->json('Dress '.$auto->model .'is deleted successfully!');
    }
}
