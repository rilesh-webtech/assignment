<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use File;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_path = public_path().'/books/default-book-data.xml';
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
                }
            }
        }else{
            $message = 'Books are not found on folder at '.date('Y-m-d H:i:s').' for storing';
            Log::info($message);
        }
    }
}
