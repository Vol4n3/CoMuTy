<?php
/**
 * Created by PhpStorm.
 * User: Julien COEURVOLAN
 * Date: 14/03/2017
 * Time: 17:47
 */

namespace JCV\CommunityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller implements DefaultRoutingControllerInterface{


    public function viewAllAction(request $req)
    {
        return $this->render('CommunityBundle:Home:index.html.twig');
    }

    public function viewOneAction(request $req,$id)
    {
        return $this->render('CommunityBundle:Home:index.html.twig');
    }

    public function postAction(request $req)
    {
        return $this->render('CommunityBundle:Home:index.html.twig');
    }

    public function getAllAction(request $req)
    {
        return $this->render('CommunityBundle:Home:index.html.twig');
    }

    public function getOneAction(request $req,$id)
    {
        return $this->render('CommunityBundle:Home:index.html.twig');
    }

    public function putAction(request $req,$id)
    {
        return $this->render('CommunityBundle:Home:index.html.twig');
    }

    public function deleteAction(request $req,$id)
    {
        return $this->render('CommunityBundle:Home:index.html.twig');
    }
}