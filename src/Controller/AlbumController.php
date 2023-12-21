<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AlbumController extends AbstractController
{
    public function albums(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function album(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function cancionesAlbum(Request $request)
    {
        if($request->isMethod('GET')) {}
    }
}
