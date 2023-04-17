<?php

  class WelcomeController extends Controller {
    public function index() {
        return view('welcome',
        [
         'title'=>'Inicio']
        );
    }
  }
?>