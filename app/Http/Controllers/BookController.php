<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request;
use File;
class BookController extends Controller
{       

    /** Store books from xml files **/
    
    public function xml_books_store()
    {       
        /** Get date for storing books of current day **/
        $date = date('Y-m-d');

        /** File name  **/
        $file_name = 'books.xml';
        
        /** File bath by Date **/
        $file_path = public_path().'/books/'.str_replace('-','/',$date).'/books.xml';

        if (File::exists($file_path)){
            
            /** Function defined on helper file **/
            $books = get_xml_file_to_array($file_path);

            foreach ($books['Book'] as $key => $book) {
                
                $author_name = $book['Author'];
                
                $author = Author::where('name',$author_name)->first();
                
                /** Check author if not present Insert new author **/
                if (!$author) {
                    $author = new Author;
                    $author->name = $book['Author'];
                    $author->save();
                }
                
                $book_data = Book::where('author_id',$author->id)->where('title',$book['Title'])->first();
                
                /** If check book does not exist then insert new book **/
                if (!$book_data) {
                    $book_data = new Book;
                    $book_data->title = $book['Title'];
                    $book_data->publish_on = date('Y-m-d',strtotime($book['PublishDate']));
                    $book_data->description = $book['Description'];
                    $book_data->author_id = $author->id;
                    $book_data->save();
                }else{
                    /** Update book data **/
                    $book_data->description = $book['Description'];
                    $book_data->author_id = $author->id;
                    $book_data->save();
                }
            }
        }else{
            $message = 'Books are not found on folder at '.date('Y-m-d H:i:s').' for storing';
            Log::info($message);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        /** Show all books **/
        $all_books = Book::with('author')->get();
        return view('books.allbooks', ['books' => $all_books, 'title'=>'']);
    }

    public function search(Request $request)
    {   
        /** Show books based on seach **/
        if ($request->title) {
          $all_books = Book::with('author')->where('title', 'LIKE', "%{$request->title}%")->get();  
        }else{
            return redirect('/');
        }
        return view('books.allbooks', ['books' => $all_books, 'title'=>$request->title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        //
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
