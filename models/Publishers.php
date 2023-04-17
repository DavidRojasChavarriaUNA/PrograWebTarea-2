<?php

include_once('Books.php');

class Publishers extends Model{

    protected static $table = 'publishers';

    public static function GetAllPublishers(){
        return self::all();
    }

    public static function GetPublisherById($id){
        $publishers = self::find($id);
        $publisher = null;
        if(!empty($publishers)){
            $publisher = $publishers[0];
            $books = Books::where('publisher_id', $publisher['id']);
            $publisher['publisherBooks'] = [];
            if(!empty($books)){
                foreach($books as $book){
                    $newBookData = [
                        'book_id' => $book['id'],
                        'title' => $book['title']
                    ];
                    array_push($publisher['publisherBooks'], $newBookData);
                }
            }
        }
        //echo json_encode($publisher);
        return $publisher;
    }

    public static function CreatePublisher($item){
        try {
            self::create($item);
            return ["Code" => 0, "message" => "Editorial creada con éxito."];
        }
        catch (Exception $e) {
            return ["Code" => 99, "message" => "No se pudo crear la editorial, {$e->getMessage()}."];
        }
    }

    public static function UpdatePublisher($item){
        try {
            self::update($item["id"], $item);
            return ["Code" => 0, "message" => "Editorial modificada con éxito."];
        }
        catch (Exception $e) {
            return ["Code" => 99, "message" => "No se pudo modificar la editorial, {$e->getMessage()}."];
        }
    }

    public static function DeletePublisher($id){
        $books = Books::where('publisher_id', $id);
        if(count($books)> 0){
            return ["Code" => 99, "message" => "No se puede borrar la editorial, existen libros asociados a la editorial."];
        }
        self::destroy($id);
        return ["Code" => 0, "message" => "Editorial borrada con éxito."];
    }

}

?>