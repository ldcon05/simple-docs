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

        $deleteShared = '';

        //Guaradar
        $shared = new Shared();
        $shared->view = $request->view === 'true' ? 1 : 0; ;
        $shared->edit = $request->edit === 'true' ? 1 : 0;
        $shared->userId = $request->userId;
        $shared->documentId = $request->documentId;
        $shared->save();

        //Eliminar
        $deleteShared = new Shared();
        $buscar = $deleteShared->where([
            ['userId', $shared->userId],
            ['documentId', $shared->documentId]
        ])->get();

        if(count($buscar) > 1) {
            $deleteShared = $buscar[0]->id;
            $buscar[0]->delete();
        }
            

        return [
            'shared' => $shared,
            'email' => $shared->user->email,
            'deleteShared' => $deleteShared
        ] ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shared = new Shared();
        return $shared->find($id)->document;
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
