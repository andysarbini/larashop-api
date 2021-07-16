<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\Books as BookResourceCollection;

class BookController extends Controller
{
    //
    public function index(){
        // $books = new BookCollectionResource(Book::paginate()); // Book disini merujuk pada nama model
        // return $books;
        // return 'tesssst';
        // $cat = \App\Book::all();
        // return $cat;
        $criteria = Book::paginate(6);
        return new BookResourceCollection($criteria);
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
        return new BookResourceCollection($criteria);
    }

    public function All()
    {
        $book = new BookResourceCollection(Book::get());
        return $book;
    }

    public function slug($slug)
    {
        $criteria = Book::where('slug', $slug)->first();
        $criteria->views = $criteria->views + 1;
        $criteria->save();
        return new BookResource($criteria);
        
    }

    public function search($keyword)
    {
        $criteria = Book::select('*')
            ->where('title', 'LIKE', "%".$keyword."%")
            ->orderBy('views', 'DESC')
            ->get();
        return new BookResourceCollection($criteria);
    }
}
