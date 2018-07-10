<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class FilterController extends Controller
{
    /**
     * Find documents by author .
     *
     * @param  string  $author
     * @return Response
     */
    public function filterDocuments($author, $tags, $created_at, $updated_at )
    {
        $where = [];

        if ($author != '-')
            $where[] = ['users.email', $author];

        if ($tags != '-')
            $where[] = ['tags', 'like', '%' . $tags . '%'];

        if ($created_at != '-')
            $where[] = ['documents.created_at', 'like', '%' . $created_at . '%'];

        if ($updated_at != '-')
            $where[] = ['documents.updated_at', 'like', '%' . $updated_at . '%' ]; 


        $documents = DB::table('documents')
                        ->join('users', 'documents.userId', '=', 'users.id')
                        ->select('documents.*', 'users.email', 'users.name')
                        ->where('userId', Auth::id())
                        ->where($where)
                        ->get();

        $sharedDocuments = DB::table('shareds')
                        ->join('documents', 'shareds.documentId', '=', 'documents.id')
                        ->join('users', 'documents.userId', '=', 'users.id')
                        ->select('shareds.*', 'users.email', 'users.name', 'documents.*')
                        ->where('shareds.userId', Auth::id())
                        ->where($where)
                        ->get();
        return [
            'documents' => $documents,
            'sharedDocuments' => $sharedDocuments
        ];
    }
}