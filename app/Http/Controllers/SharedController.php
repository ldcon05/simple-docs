<?php

namespace App\Http\Controllers;


use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

use App\Shared;

class SharedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($documentId)
    {   
        $userCtrl = new UserController();
        $shared = new Shared();

        return view('shared.admin', [
            'users' => $userCtrl->getUsers(),
            'documentId' => $documentId,
            'shared' =>  $shared->where('documentId', $documentId)->get(),
        ]); 
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

        //Find shared record 
        $findShared = Shared::where([
            ['userId', $request->userId],
            ['documentId', $request->documentId]
        ])->first();

        $shared = (isset($findShared->id)) ? $findShared : new Shared();
        $status = (isset($findShared->id)) ? false : true;

        //Save
        $shared->view = $request->view === 'true' ? 1 : 0;
        $shared->edit = $request->edit === 'true' ? 1 : 0;
        $shared->userId = $request->userId;
        $shared->documentId = $request->documentId;
        $shared->save();

        return [
            'shared' => $shared,
            'email' => $shared->user->email,
            'status' => $status,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $shared = new Shared();
        // return $shared->find($id)->document;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shared = new Shared();
        $shared->find($id)->delete();
        
        return true;
    }
}
