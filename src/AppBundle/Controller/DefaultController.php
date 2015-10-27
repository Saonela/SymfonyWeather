<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WeatherBundle\Weather;

class DefaultController extends Controller
{
     /**
       * @Route("/", name="homepage")
      **/
    public function indexAction(Request $request)
    {
        $weather = new Weather();
        $currTemp = $weather->getTemperature();

        return $this->render('default/index.html.twig', array('currTemp' => $currTemp)
        );
    }
}
