<?php
/**
 * Created by PhpStorm.
 * User: Julien COEURVOLAN
 * Date: 14/03/2017
 * Time: 17:47
 */

namespace JCV\CommunityBundle\Controller;

use JCV\CommunityBundle\Entity\Blog;
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
        //todo: Finish post meth
        $jsonPost = $req->getContent();
        $arrayPost = json_decode($jsonPost);
        $blog = new Blog();
        //$blog->setUser();
        $blog->setCreatedAt(new \DateTime("now"));
        $blog->setContent($arrayPost["content"]);
        return $this->json(array("res" => "success"));
    }

    public function getAllAction(request $req)
    {
        $blogs = $this->getDoctrine()
            ->getRepository('CommunityBundle:Blog')
            ->findAll();
        if(!$blogs){
            return $this->json(array("none"));
        }
        return $this->json($blogs);
    }

    public function getOneAction(request $req,$id)
    {
        $blogs = $this->getDoctrine()
            ->getRepository('CommunityBundle:Blog')
            ->find($id);
        if(!$blogs){
            return $this->json(array("none"));
        }
        return $this->json($blogs);
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