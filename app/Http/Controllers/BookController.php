<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\Books as BookCollectionResource;

class BookController extends Controller
{
    //
    public function index(){
        // $books = new BookCollectionResource(Book::paginate()); // Book disini merujuk pada nama model
        // return $books;
        // return 'tesssst';
        $cat = \App\Book::all();
        return $cat;
    }

    public function cetak($judul)
    { 
        return $judul;
    }

    public function view($id)
    {
        $book = new BookResource(Book::find($id));
        return $book;
    }
    
    public function top($count)
    {
        $criteria = Book::select('*')
        ->orderBy('views', 'DESC')
        ->limit($count)
        ->get();
        return new BookCollectionResource($criteria);
    }

    public function All()
    {
        $book = new BookCollectionResource(Book::get());
        return $book;
    }
}
