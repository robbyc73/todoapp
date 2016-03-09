<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SomeOtherController extends Controller
{
    public function someOtherAction()
    {
        return $this->render('AppBundle:SomeOther:index.html.twig');
    }
}
