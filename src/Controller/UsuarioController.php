<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UsuarioController extends AbstractController
{
    public function usuarios(Request $request)
    {
        if($request->isMethod('GET')) {}
        if($request->isMethod('POST')) {}
    }

    public function usuario(Request $request)
    {
        if($request->isMethod('GET')) {}
        if($request->isMethod('PUT')) {}
        if($request->isMethod('DELETE')) {}
    }

    public function seguidosUsuario(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function seguirUsuario(Request $request)
    {
        if($request->isMethod('POST')) {}
        if($request->isMethod('DELETE')) {}
    }
}
