<?php

// src/AdBoardBundle/Entity/User.php

namespace AB\AdBoardBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
     /**
     * @ORM\OneToMany(targetEntity="Advert", mappedBy="user")
     */
    private $adverts;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
     */
    private $comments;

    public function __construct() {
        parent::__construct();
        // your own logic
    }


    /**
     * Add adverts
     *
     * @param \AB\AdBoardBundle\Entity\Advert $adverts
     * @return User
     */
    public function addAdvert(\AB\AdBoardBundle\Entity\Advert $adverts)
    {
        $this->adverts[] = $adverts;

        return $this;
    }

    /**
     * Remove adverts
     *
     * @param \AB\AdBoardBundle\Entity\Advert $adverts
     */
    public function removeAdvert(\AB\AdBoardBundle\Entity\Advert $adverts)
    {
        $this->adverts->removeElement($adverts);
    }

    /**
     * Get adverts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdverts()
    {
        return $this->adverts;
    }
}
