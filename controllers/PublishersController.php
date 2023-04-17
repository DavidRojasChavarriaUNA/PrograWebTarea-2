<?php

  include_once('./models/Publishers.php');

  class PublishersController extends Controller {
    public function index() {
        return view('publishers/index', 
          ['publishers' => Publishers::GetAllPublishers(),
          'title' => 'Información de editoriales']
        );
    }
    public function show($id) {
      $Publisher = Publishers::GetPublisherById($id);
      return view('publishers/show',
        ['publisher'=>$Publisher,
         'title'=>'Detalle de la editorial']);
    }

    public function create() {
      return view('publishers/create',
        ['title'=>'Nueva editorial']);
    }

    public function store() {
      $publisher = Input::get('publisher');
      $country = Input::get('country');
      $founded = Input::get('founded');
      $genere = Input::get('genere');
      $item = ['publisher'=>$publisher,'country'=>$country,
               'founded'=>$founded,'genere'=>$genere];
      $respuesta = Publishers::CreatePublisher($item);
      $mensaje = "{$respuesta["Code"]} - {$respuesta["message"]}";
      return "<script type=\"text/javascript\">alert(\"{$mensaje}\");window.location = '/publishers';</script>";
      //return redirect('/authors');
    }  

    public function edit($id) {
      $Publisher = Publishers::GetPublisherById($id);
      return view('publishers/edit',
        ['publisher'=>$Publisher,
         'title'=>'Editar editorial']);
    }  

    public function update($_,$id) {
      $publisher = Input::get('publisher');
      $country = Input::get('country');
      $founded = Input::get('founded');
      $genere = Input::get('genere');
      $item = ['id'=>$id,
               'publisher'=>$publisher,'country'=>$country,
               'founded'=>$founded,'genere'=>$genere];
      $respuesta = Publishers::UpdatePublisher($item);
      $mensaje = "{$respuesta["Code"]} - {$respuesta["message"]}";
      return "<script type=\"text/javascript\">alert(\"{$mensaje}\");window.location = '/publishers';</script>";
      //return redirect('/publishers');
    }  

    public function destroy($id) {  
      $respuesta = Publishers::DeletePublisher($id);
      $mensaje = "{$respuesta["Code"]} - {$respuesta["message"]}";
      return "<script type=\"text/javascript\">alert(\"{$mensaje}\");window.location = '/publishers';</script>";
      //return redirect('/publishers');
    }

  }
?>