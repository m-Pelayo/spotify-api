<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ArtistaController extends AbstractController
{
    public function artistas(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function albumsArtista(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function albumByIdAndArtistaId(Request $request)
    {
        if($request->isMethod('GET')) {}
    }
}
