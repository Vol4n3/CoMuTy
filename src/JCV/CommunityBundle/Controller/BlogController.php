<?php
/**
 * Created by PhpStorm.
 * User: Julien COEURVOLAN
 * Date: 14/03/2017
 * Time: 17:47
 */

namespace JCV\CommunityBundle\Controller;

use JCV\CommunityBundle\Entity\Blog;
use JCV\CommunityBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller implements DefaultRoutingControllerInterface{

    public function viewAllAction(request $req)
    {
        $user = $this->getDoctrine()
            ->getManager()
            ->getRepository('CommunityBundle:User')
            ->find(1);
        dump($user);
        return $this->render('CommunityBundle:Home:index.html.twig');
    }

    public function viewOneAction(request $req,$id)
    {
        return $this->render('CommunityBundle:Home:index.html.twig');
    }

    public function postAction(request $req)
    {
        /**
         * @var User $user
         */

        $user = $this->getDoctrine()
            ->getManager()
            ->getRepository('CommunityBundle:User')
            ->find(1);
        if($user === null){
            return $this->json(array("res" => "must be log"));
        }

        $jsonPost = $req->request->all();
        $type = $req->getContentType();
        return $this->json(array("res" => $jsonPost,"type" => $type));
        $jsonDecode = json_decode($jsonPost,true);
        $blog = new Blog();
        $blog->setTitle($jsonDecode["title"]);
        $blog->setDescription($jsonDecode["description"]);
        $blog->setUser($user);
        $blog->setCreatedAt(new \DateTime("now"));
        $blog->setUpdatedAt(new \DateTime("now"));
        $blog->setPosition(1);
        $blog->setContent($jsonDecode["content"]);
        $em = $this->getDoctrine()->getManager();
        $em->persist($blog);
        $em->flush();
        return $this->json(array("res" => "ok"));
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