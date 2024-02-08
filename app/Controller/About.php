<?php
namespace App\Controller;

use Gaucho\Gaucho;

class About extends Gaucho
{

    function GET()
    {
        $data = [
            'title' => 'Sobre'
        ];
        $this->chaplin('inc/header', $data);
        $this->chaplin('about', $data);
        $this->chaplin('inc/footer', $data);
    }
}