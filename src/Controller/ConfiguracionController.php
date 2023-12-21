<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ConfiguracionController extends AbstractController
{
    public function configuracionUsuario(Request $request)
    {
        if($request->isMethod('GET')) {}
        if($request->isMethod('PUT')) {}
    }
}
