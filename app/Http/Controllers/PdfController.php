<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DocumentController;

use PDF;
use Markdown;

class PdfController extends Controller
{
    public function getDocumentOrReview($type, $id)
    {
        $reviewCrtl = new ReviewController();
        $documentCrtl = new DocumentController();

        $file = ($type === 'review') ? $reviewCrtl->show($id) : 
                                       $documentCrtl->show($id);
        return $file;
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($type, $id)
    {
        return PDF::loadHtml($this->getDocumentOrReview($type, $id)
                                ->body)
                                ->stream('document.pdf');
    }

    public function download($type, $id)
    {
        return PDF::loadHtml($this->getDocumentOrReview($type, $id)
                                ->body)
                                ->download('document.pdf');
    }
}