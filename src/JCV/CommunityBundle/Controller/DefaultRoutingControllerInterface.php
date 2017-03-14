<?php
/**
 * Created by PhpStorm.
 * User: Julien COEURVOLAN
 * Date: 14/03/2017
 * Time: 17:37
 */

namespace JCV\CommunityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

interface DefaultRoutingControllerInterface
{
    public function viewAllAction(request $req);
    public function viewOneAction(request $req,$id);
    public function postAction(request $req);
    public function getAllAction(request $req);
    public function getOneAction(request $req,$id);
    public function putAction(request $req,$id);
    public function deleteAction(request $req,$id);

}