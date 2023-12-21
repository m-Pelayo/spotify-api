<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TipoDescargaController extends AbstractController
{
    public function tiposDescarga(Request $request)
    {
        if($request->isMethod('GET')) {}
    }
}
