<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CancionController extends AbstractController
{
    public function canciones(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function cancion(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function cancionesPlaylist(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function anadirCancionToPlaylist(Request $request)
    {
        if($request->isMethod('POST')) {}
        if($request->isMethod('DELETE')) {}
    }
}
