<?php

include_once('Authors.php');
include_once('Publishers.php');

class Books extends Model{

    protected static $table = 'books';

    public static function GetAllBooks(){
        return self::all();
    }

    public static function GetBookById($id){
        $books = self::find($id);
        $book = null;
        if(!empty($books)){
            $book = $books[0];
            $author = Authors::find($book['author_id']);
            $authorName = "";
            if(!empty($author)){
                $authorName = $author[0]['author'];
            }
            $book['author'] = $authorName;
            $publisher = Publishers::find($book['publisher_id']);
            $publisherName = "";
            if(!empty($publisher)){
                $publisherName = $publisher[0]['publisher'];
            }
            $book['publisher'] = $publisherName;
        }
        return $book;
    }

    public static function CreateBook($item){
        try {
            self::create($item);
            return ["Code" => 0, "message" => "Libro creado con éxito."];
        }
        catch (Exception $e) {
            return ["Code" => 99, "message" => "No se pudo crear el libro, {$e->getMessage()}."];
        }
    }

    public static function UpdateBook($item){
        try {
            self::update($item["id"], $item);
            return ["Code" => 0, "message" => "Libro modificado con éxito."];
        }
        catch (Exception $e) {
            return ["Code" => 99, "message" => "No se pudo modificar el libro, {$e->getMessage()}."];
        }
    }

    public static function DeleteBook($id){
        self::destroy($id);
        return ["Code" => 0, "message" => "Libro borrado con éxito."];
    }

}

?>