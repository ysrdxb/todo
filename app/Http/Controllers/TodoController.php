<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use Illuminate\Support\Facades\Auth;
use DB;
use Redirect;
use Session;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'details' => 'required',            
        ]);

        $tasks = Tasks::create([
            'title'      =>  request('name'),
            'details'   =>  request('details'),
            'user_id'   =>  Auth::User()->id,
        ]);
        Session::flash('message', "New todo added");
        return Redirect::back();
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
    public function completed(Request $request)
    {
        DB::table('tasks')
        ->where('tid', request('tid'))
        ->update(['completed' => request('mark')]);
        if($request->input('mark')==1){
           Session::flash('message', "Marked as complete!");
        }else{
           Session::flash('message', "Marked as incomplete!");            
        }
        return Redirect::back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'details' => 'required',           
        ]);
            DB::table('tasks')
            ->where('tid', request('tid'))
            ->update(['title' => request('name'), 'details' => request('details')]);
        Session::flash('message', "Updated Successfully!");
        return Redirect::back();    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        DB::table('tasks')->where('tid', $id)->delete();
        Session::flash('message', "Deleted Successfully!");
        return Redirect::back();    }
}
