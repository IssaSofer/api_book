<?php 

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as Base;
use App\Book;
use Validator;


class BookController extends Base
{
	public function index() {
		$books = Book::all();
		return $this->sendResponse($books->toArray(), 'Book read succesfully');
	}



	public function store(Request $request) {
		$input = $request->all();
		$val = Validator::make($input,[
			'name' => 'required',
			'datails' => 'required'
			]);

		if($val -> fails()){
			return $this->sendError('error validation', $val ->errors());
		}

		$book = Book::create($input);
		return $this->sendResponse($book->toArray,'Book Create Succesfully');

	}

	public function show($id) {

		$book = Book::find($id);

		if(is_null($book)){
			return $this->sendError('Book not found');
		}

		
		return $this->sendResponse($book->toArray,'Book read Succesfully');

	}


	public function update(Request $request, Book $book) {
		$input = $request->all();
		$val = Validator::make($input,[
			'name' => 'required',
			'datails' => 'required'
			]);

		if($val -> fails()){
			return $this->sendError('error validation', $val ->errors());
		}

		$book->name = $input['name'];
		$book->datails = $input['datails'];
		return $this->sendResponse($book->toArray,'Book Update Succesfully');

	}

	public function destroy($id, book $book)
	{
		$book->delete();
		return $this->sendResponse($book->toArray, 'Book Delete Succesfully');
	}

}