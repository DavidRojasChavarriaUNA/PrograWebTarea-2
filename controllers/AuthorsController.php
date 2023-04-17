<?php

  include_once('./models/Authors.php');

  class AuthorsController extends Controller {

    public function index() {
        return view('authors/index', 
          ['authors' => Authors::GetAllAuthors(),
          'title' => 'Información de autores']
        );
    }

    public function show($id) {
      $author = Authors::GetAuthorById($id);
      return view('authors/show',
        ['author'=>$author,
         'title'=>'Detalle del autor']);
    }

    public function create() {
      return view('authors/create',
        ['title'=>'Nuevo autor']);
    }

    public function store() {
      $author = Input::get('author');
      $nationality = Input::get('nationality');
      $birth_year = Input::get('birth_year');
      $fields = Input::get('fields');
      $item = ['author'=>$author,'nationality'=>$nationality,
               'birth_year'=>$birth_year,'fields'=>$fields];
      $respuesta = Authors::CreateAuthor($item);
      $mensaje = "{$respuesta["Code"]} - {$respuesta["message"]}";
      return "<script type=\"text/javascript\">alert(\"{$mensaje}\");window.location = '/authors';</script>";
      //return redirect('/authors');
    }  

    public function edit($id) {
      $author = Authors::GetAuthorById($id);
      return view('authors/edit',
        ['author'=>$author,
         'title'=>'Editar autor']);
    }  

    public function update($_,$id) {
      $author = Input::get('author');
      $nationality = Input::get('nationality');
      $birth_year = Input::get('birth_year');
      $fields = Input::get('fields');
      $item = ['id'=>$id,
               'author'=>$author,'nationality'=>$nationality,
               'birth_year'=>$birth_year,'fields'=>$fields];
      $respuesta = Authors::UpdateAuthor($item);
      $mensaje = "{$respuesta["Code"]} - {$respuesta["message"]}";
      return "<script type=\"text/javascript\">alert(\"{$mensaje}\");window.location = '/authors';</script>";
      //return redirect('/authors');
    }  

    public function destroy($id) {  
      $respuesta = Authors::DeleteAuthor($id);
      $mensaje = "{$respuesta["Code"]} - {$respuesta["message"]}";
      return "<script type=\"text/javascript\">alert(\"{$mensaje}\");window.location = '/authors';</script>";
      //return redirect('/authors');
    }

  }
?>