<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends BaseController  
{
    
public function index()
{
    $books = Book::all();
    return $this->sendResponse($books->toArray(), 'Books read succesfully');
}

 
public function store(Request $request)
{
    $input = $request->all();
    $validator =    Validator::make($input, [
    'name'=> 'required',
    'details'=> 'required' 
    ] );

    if ($validator -> fails()) {
        return $this->sendError('error validation', $validator->errors());
    }

    $book = Book::create($input);
    return $this->sendResponse($book->toArray(), 'Book  created succesfully');
    
}






public function show(  $id)
{
    $book = Book::find($id);
    if (   is_null($book)   ) {
        # code...
        return $this->sendError(  'book not found ! ');
    }
    return $this->sendResponse($book->toArray(), 'Book read succesfully');
    
}



// update book 
public function update(Request $request , Book $book)
{
    $input = $request->all();
    $validator =    Validator::make($input, [
    'name'=> 'required',
    'details'=> 'required' 
    ] );

    if ($validator -> fails()) {
        # code...
        return $this->sendError('error validation', $validator->errors());
    }
    $book->name =  $input['name'];
    $book->details =  $input['details'];
    $book->save();
    return $this->sendResponse($book->toArray(), 'Book  updated succesfully');
    
}





// delete book 
public function destroy(Book $book)
{
 
    $book->delete();

    return $this->sendResponse($book->toArray(), 'Book  deleted succesfully');
    
}



    
}