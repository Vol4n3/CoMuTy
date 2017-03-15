<?php

namespace JCV\CommunityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="JCV\CommunityBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Blogs
     * @ORM\OneToMany(targetEntity="Blog", mappedBy="user")
     */
    private $blogs;

    public function __construct()
    {
        parent::__construct();
        $this->features = new ArrayCollection();
    }
}

