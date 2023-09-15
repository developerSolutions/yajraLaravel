<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $users = User::query();
            if(!empty($request->date))
            {
                $brokenDate = explode(' - ', $request->date);
                $startDate = $brokenDate[0];
                $endDate = $brokenDate[1];
              
                $users =  $users->whereDate('created_at','>=', $startDate)->whereDate('created_at','<=',$endDate);
            }
          return DataTables::of($users)
          ->addIndexColumn()
          ->addColumn('date',function($user)
          {
            return $user->created_at->format('Y M d');
          })->
          addColumn('action',function($user)
          {
            return '<a href="'.route('destroy',$user->id).'" class="btn btn-sm btn-danger">Delete</a>';
          })
          ->rawColumns(['action'])
          ->make(true);
        }

        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
       $result = User::where('id',$id)->delete();
       return redirect()->back();
    }
}
