<?php
class View
{
    private $model;
	private $viewFile = null;

    public function __construct($model) {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function output(){
        $data = "<p>333" . $this->model->string ."</p>";
        //require_once($this->model->template);
    }
}