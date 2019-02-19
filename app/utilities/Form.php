<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 16/02/2019
 * Time: 21:18
 */

namespace App\Utilities;


class Form
{
    private $data;
    public $surround;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    private function surround($html)
    {
        return "<{$this->surround}>{$html}</$this->surround>";
    }

    private function getValue($index)
    {
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    public function input($type, $name)
    {
        return $this->surround(

            '<input type="' . $type .'" name="' . $name .'" value="' . $this->getValue($name) .'">Envoyez</input>'
        );
    }

    public function submit()
    {
        echo '<button type="submit">Envoyez</button>';
    }
}