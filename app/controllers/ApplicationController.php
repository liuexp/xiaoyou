<?php
class ApplicationController
{
  protected function render($name)
  {
    include(__DIR__ . '/../views/' . $name . '.php');
  }
}
