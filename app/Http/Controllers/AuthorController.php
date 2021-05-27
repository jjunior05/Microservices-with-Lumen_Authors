<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return the list of authors
     * @return illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        return response()->json($authors, Response::HTTP_OK);
    }

    /**
     * Create one new author
     * @return illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Obtains and show on author
     * @return illuminate\Http\Response
     */
    public function show($author)
    {
    }

    /**
     * Update an existing author
     * @return illuminate\Http\Response
     */
    public function update(Request $request, $author)
    {
    }

    /**
     * Delete an existing author
     * @return illuminate\Http\Response
     */
    public function destroy($author)
    {
    }
}
