<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class IdiomaController extends AbstractController
{
    public function idiomas(Request $request)
    {
        if($request->isMethod('GET')) {}
    }
}
