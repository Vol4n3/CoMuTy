<?php

namespace JCV\CommunityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class HomeController extends Controller
{
    public function indexAction(Request $req)
    {
        $blogs = $this->getDoctrine()
            ->getRepository('CommunityBundle:Blog')
            ->findAll();

        return $this->render('CommunityBundle:Home:index.html.twig',['blogs' => $blogs]);
    }
}
