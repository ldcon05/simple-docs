<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DocumentController;

use PDF;
use Markdown;

class PdfController extends Controller
{
    public function getDocument($id) {
        $documentCrtl = new DocumentController();
        $document = $documentCrtl->show($id); 
        return ($document->format === 'md') ? 
                    Markdown::convertToHtml($document->body) :
                    $document->body;
        
    }

    public function getReview($id) {
        $reviewCrtl = new ReviewController();
        $review = $reviewCrtl->show($id);
        return ($review->document->format === 'md') ? 
                    Markdown::convertToHtml($review->body) :
                    $review->body; 
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($type, $id)
    {
        return PDF::loadHtml(($type == 'review') ? 
                              $this->getReview($id) : 
                              $this->getDocument($id)
                            )
                            ->stream('document.pdf');
    }

    public function download($type, $id)
    {
        return PDF::loadHtml(($type == 'review') ? 
                                $this->getReview($id) : 
                                $this->getDocument($id)
                            )
                            ->stream('document.pdf');
    }
}