<?php

include_once('Books.php');

class Authors extends Model{

    protected static $table = 'authors';

    public static function GetAllAuthors(){
        return self::all();
    }

    public static function GetAuthorById($id){
        $authors = self::find($id);
        $author = null;
        if(!empty($authors)){
            $author = $authors[0];
            $books = Books::where('author_id', $author['id']);
            $author['authorBooks'] = [];
            if(!empty($books)){
                foreach($books as $book){
                    $newBookData = [
                        'book_id' => $book['id'],
                        'title' => $book['title']
                    ];
                    array_push($author['authorBooks'], $newBookData);
                }
            }
        }
        return $author;
    }

    public static function CreateAuthor($item){
        try {
            self::create($item);
            return ["Code" => 0, "message" => "Autor creado con éxito."];
        }
        catch (Exception $e) {
            return ["Code" => 99, "message" => "No se pudo crear el autor, {$e->getMessage()}."];
        }
    }

    public static function UpdateAuthor($item){
        try {
            self::update($item["id"], $item);
            return ["Code" => 0, "message" => "Autor modificado con éxito."];
        }
        catch (Exception $e) {
            return ["Code" => 99, "message" => "No se pudo modificar el autor, {$e->getMessage()}."];
        }
    }

    public static function DeleteAuthor($id){
        $books = Books::where('author_id', $id);
        if(count($books)> 0){
            return ["Code" => 99, "message" => "No se puede borrar el autor, existen libros asociados al autor."];
        }
        self::destroy($id);
        return ["Code" => 0, "message" => "Autor borrado con éxito."];
    }

}

?>