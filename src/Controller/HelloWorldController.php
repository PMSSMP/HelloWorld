<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Access;
use \Datetime;
use Psr\Log\LoggerInterface;

class HelloWorldController extends AbstractController
{
    /**
     * @Route("/hello/world", name="hello_world")
     */
    public function index(Request $request, LoggerInterface $logger): Response
    {
        
        $prefLanguage = $request->attributes->get('preferedLanguage');
        $ip = $request->server->get('REMOTE_ADDR');
        $timeStamp = new DateTime('NOW');

        try 
        {
            //throw new \Exception("test");
            
            $this->logAccess($prefLanguage, $ip, $timeStamp);
        } 
        catch (\Exception $ex) 
        {
            $logger->error("Error while writing to Database: " . $ex);
        }
     


        $totalAccesses = $this->getDoctrine()
            ->getRepository(Access::class)
            ->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();
        if($prefLanguage == "de")  
        {
            $greeting = "Hallo Welt";
            $time = $timeStamp->format('d.m.Y H:i:s');
            $accessCounter = "Aufrufe: " . $totalAccesses;
        } 
        else
        {
            $greeting = "Hello World";
            $time = $timeStamp->format('m.d.Y H:i:s');
            $accessCounter = "Accesses: ". $totalAccesses;
        }
        
        
        return $this->render('hello_world/index.html.twig', [
            'greeting' => $greeting,
            'time' =>  $time,
            'accessCounter' => $accessCounter
        ]);
        
    }

    private function logAccess($prefLanguage, $ip, $timeStamp)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $access = new Access();
        $access->setIp($ip);
        $access->setPreferedLanguage($prefLanguage);
        $access->setTimeStamp($timeStamp);

        $entityManager->persist($access);
        $entityManager->flush();
    }
}
