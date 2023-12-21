<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class SuscripcionController extends AbstractController
{
    public function suscripcionesUsuario(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function suscripcionByIdAndUsuarioId(Request $request)
    {
        if($request->isMethod('GET')) {}
    }
}
