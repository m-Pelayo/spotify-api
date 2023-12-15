<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class SuscripcionController extends AbstractController
{
    public function suscripcionesByUserId(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function suscripcionByIdAndUserId(Request $request)
    {
        if($request->isMethod('GET')) {}
    }
}
