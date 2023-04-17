<?php

  include_once('./models/Books.php');
  include_once('./models/Authors.php');
  include_once('./models/Publishers.php');

  class BooksController extends Controller {
    public function index() {
        return view('books/index', 
          ['books' => Books::GetAllBooks(),
          'title' => 'Información de libros']
      );
    }

    public function show($id) {
      $book = Books::GetBookById($id);
      return view('books/show',
        ['book'=>$book,
         'title'=>'Detalle de libro']);
    }

    public function create() {
      return view('books/create',
        ['title'=>'Nuevo libro',
         'authors' => Authors::GetAllAuthors(),
         'publishers' => Publishers::GetAllPublishers()]);
    }

    public function store() {
      $title = Input::get('title');
      $edition = Input::get('edition');
      $copyright = Input::get('copyright');
      $language = Input::get('language');
      $pages = Input::get('pages');
      $author_id = Input::get('author_id');
      $publisher_id = Input::get('publisher_id');
      $item = ['title'=>$title,'edition'=>$edition,
               'copyright'=>$copyright,'language'=>$language,
               'pages'=>$pages,'author_id'=>$author_id,'publisher_id'=>$publisher_id];
      $respuesta = Books::CreateBook($item);
      $mensaje = "{$respuesta["Code"]} - {$respuesta["message"]}";
      return "<script type=\"text/javascript\">alert(\"{$mensaje}\");window.location = '/books';</script>";
      //return redirect('/authors');
    }  

    public function edit($id) {
      $book = Books::GetBookById($id);
      return view('books/edit',
        ['book'=>$book,
         'title'=>'Editar editorial',
         'authors' => Authors::GetAllAuthors(),
         'publishers' => Publishers::GetAllPublishers()]);
    }  

    public function update($_,$id) {
      $title = Input::get('title');
      $edition = Input::get('edition');
      $copyright = Input::get('copyright');
      $language = Input::get('language');
      $pages = Input::get('pages');
      $author_id = Input::get('author_id');
      $publisher_id = Input::get('publisher_id');
      $item = ['id'=>$id,
               'title'=>$title,'edition'=>$edition,
               'copyright'=>$copyright,'language'=>$language,
               'pages'=>$pages,'author_id'=>$author_id,'publisher_id'=>$publisher_id];
      $respuesta = Books::UpdateBook($item);
      $mensaje = "{$respuesta["Code"]} - {$respuesta["message"]}";
      return "<script type=\"text/javascript\">alert(\"{$mensaje}\");window.location = '/books';</script>";
      //return redirect('/books');
    }  

    public function destroy($id) {  
      $respuesta = Books::DeleteBook($id);
      $mensaje = "{$respuesta["Code"]} - {$respuesta["message"]}";
      return "<script type=\"text/javascript\">alert(\"{$mensaje}\");window.location = '/books';</script>";
      //return redirect('/books');
    }

  }
?>