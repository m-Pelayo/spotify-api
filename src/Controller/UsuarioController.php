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

    public function usuarioById(Request $request)
    {
        if($request->isMethod('GET')) {}
        if($request->isMethod('PUT')) {}
        if($request->isMethod('DELETE')) {}
    }

    public function seguidosUsuarioById(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function seguirUsuarioById(Request $request)
    {
        if($request->isMethod('POST')) {}
        if($request->isMethod('DELETE')) {}
    }
}
