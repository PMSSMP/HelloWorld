<?php

namespace App\Entity;

use App\Repository\AccessRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccessRepository::class)
 */
class Access
{
     /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=15)
     */
    private $ip;
    
    /**
     * @ORM\Column(type="text", length=10)
     */
    private $preferedLanguage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timeStamp;


    //Getter
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getIp(): ?string
    {
        return $this->id;
    }
    public function getPreferedLangauge(): ?string
    {
        return $this->id;
    } 
    public function getTimeStamp(): ?string
    {
        return $this->id;
    }
    //Setter
    public function setIp($ip)
    {
        $this->ip = $ip;
    }
    public function setPreferedLanguage($preferedLanguage)
    {
        $this->preferedLanguage = $preferedLanguage;
    } 
    public function setTimeStamp($timeStamp)
    {
        $this->timeStamp = $timeStamp;
    }
}
