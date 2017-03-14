<?php

namespace JCV\CommunityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class HomeController extends Controller
{
    public function indexAction(Request $req)
    {
        return $this->render('CommunityBundle:Home:index.html.twig');
    }
}
