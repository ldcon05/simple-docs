<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReviewController;
use App\Document;




class DocumentController extends Controller
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::all();
        return view('documents.home', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        return view('documents.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Document
        $document = new Document();
        $document->title = $request->input('title');
        $document->body = $request->input('body');
        $document->tags = $request->input('tags');
        $document->format = $request->input('format');
        $document->userId = Auth::id();
        $document->save();

        //Review
        $reviewCrtl = new ReviewController();
        $reviewCrtl->store($document);

        return redirect()->route('documents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $reviewCrtl = new ReviewController();
        $allDocument[0] = $document;
        $allDocument[1] = $reviewCrtl->index($document->id);;
        return view('documents.editar', compact('allDocument'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //Document

        $document->title = $request->input('title');
        $document->body = $request->input('body');
        $document->tags = $request->input('tags');
        $document->save();

        //Review
        $reviewCrtl = new ReviewController();
        $reviewCrtl->store($document);


        return redirect()->route('documents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
