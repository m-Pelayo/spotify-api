<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CalidadController extends AbstractController
{
    public function calidades(Request $request)
    {
        if($request->isMethod('GET')) {}
    }
}
