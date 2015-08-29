<?php

namespace App\Http\Controllers;

use App\categories;
use App\facultyModel;
use App\userModel;
use App\Http\Controllers\Controller;
use App\PkmModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use SSO\SSO;

class PkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $faculties = facultyModel::all();
        $categories = categories::all();
        $status = ["Tidak didanai", "Didanai", "Finalis", "Juara"];

        return view("formtest", ['faculties'=>$faculties, 'categories'=>$categories, 'status'=>$status]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

         //dd(Request::file());
        //
        $pkm = new PkmModel;
        //dd(base_path());
        //TODO validasi
        $validator = Validator::make(Input::all(), [
            'title' => 'required',
            'leader' => 'required',
            'year' => 'required',
            'status' => 'required',
            'category' => 'required',
            'file' => 'required|mimes:pdf',

        ]);

        if ($validator->fails()) {
            return redirect('/pkm/add')
                ->withErrors($validator)
                ->withInput();
        }

        $pkm->title = Input::get('title');
        $pkm->leader = Input::get('leader');
        $pkm->year = Input::get('year');
        $pkm->status = Input::get('status');
        $pkm->category = Input::get('category');
        $userDb = userModel::where('username', Session::get('user')->username)->first();
        $pkm->uploader = $userDb->id;
        $pkm->save();
        $file = Request::file('file');

        if($file->move(base_path().'/public/upload/pkm', $pkm->id.'.'.$file->getClientOriginalExtension())){

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        $pkm = PkmModel::find($id);
        return view("view",['pkm'=>$pkm]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $pkm = PkmModel::find($id);
        $faculties = facultyModel::all();
        $categories = categories::all();
        $status = ["Tidak didanai", "Didanai", "Finalis", "Juara"];
        //dd($categories );
        //TODO complete it
        return view("formedit", ['pkm'=>$pkm, 'faculties'=>$faculties, 'categories'=>$categories, 'status'=>$status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $pkm = PkmModel::find($id);

        //TODO jabarin

        $validator = Validator::make(Input::all(), [
        'title' => 'required',
            'leader' => 'required',
            'year' => 'required',
            'status' => 'required',
            'category' => 'required',
            'file' => 'required|mimes:pdf',

        ]);

        if ($validator->fails()) {
            return redirect('/pkm/add')
                ->withErrors($validator)
                ->withInput();
        }

        $pkm->title = Input::get('title');
        $pkm->leader = Input::get('leader');
        $pkm->year = Input::get('year');
        $pkm->status = Input::get('status');
        $pkm->category = Input::get('category');
        $pkm->save();
        $file = Request::file('file');

        if($file->move(base_path().'/public/upload/pkm', $pkm->id.'.'.$file->getClientOriginalExtension())){

        }
        $pkm->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $pkm = PkmModel::find($id);
        if($pkm==null)
        {
            redirect()->back();
        }
        else
        {
            $pkm->delete();
            redirect();
        }
    }

    public function showall()   {
        $pkmall = PkmModel::paginate(2);
        return view('showall',['pkmall'=>$pkmall]);
    }

    public function search()    {
        $input = Input::get('query');
        $results = PkmModel::where('title', 'LIKE', '%'.$input.'%')->orWhere('leader','LIKE','%'.$input.'%')->get();
        return view('searches',$results);
    }

    public function sort()  {
        $results = PkmModel::orderBy('title','desc')->get();
        return view('sorted',$results);
    }
}