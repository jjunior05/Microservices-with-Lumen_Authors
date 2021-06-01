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
        $authors = Author::orderBy('id', 'DESC')->get();
        return $this->successResponse($authors);
    }

    /**
     * Create one new author
     * @return illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = [
            'name' => 'required|max:255',
            'gender' => 'required|in:male,female',
            'country' => 'required',
        ];
        $messages = [
            'name.required' => 'Campo Name é obrigatório!',
            'name.max' => 'Campo Name deve possuir no máximo 10 caracteres!',
            'gender.required' => 'Campo Gender é obrigatório!',
            'gender.in' => 'Gender somente male ou female!',
            'country.required' => 'Campo Country é obrigatório!',
        ];


        $this->validate($request, $validate, $messages);

        $author = Author::create($request->all());

        return $this->successResponse($author, Response::HTTP_CREATED);
    }

    /**
     * Obtains and show on author
     * @return illuminate\Http\Response
     */
    public function show($author)
    {
        $author = Author::findOrFail($author);

        return $this->successResponse($author);
    }

    /**
     * Update an existing author
     * @return illuminate\Http\Response
     */
    public function update(Request $request, $author)
    {


        $validate = [
            'name' => '|max:255',
            'gender' => '|in:male,famale',

        ];
        $messages = [
            'name.max' => 'Campo Name deve possuir no máximo 10 caracteres!',
            'gender.in' => 'Gender somente male ou female!',
            'country.required' => 'Campo Country é obrigatório!',
        ];

        $this->validate($request, $validate, $messages);

        $author = Author::findOrFail($author);

        $author->fill($request->all());

        if ($author->isClean()) {
            return $this->errorResponse('Não foi possível alterar nenhum valor com as informações informadas.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $author->save();

        return $this->successResponse($author);
    }


    /**
     * Delete an existing author
     * @return illuminate\Http\Response
     */
    public function destroy($author)
    {
        $author = Author::findOrFail($author);
        if (!$author) {
            return $this->errorResponse('Não foi possível encontrar nenhum author com esse ID', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $author->delete();

        return $this->successResponse($author);
    }
}
