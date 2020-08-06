<?php


namespace App\Controller;


use App\SomeService\SomeServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function index(SomeServiceInterface $service)
    {
        dump(
            // Appel du service spécifique à l'env
            $service->doSomething(),

            $this->getParameter("some_parameter"),
            $this->getParameter("some_other_parameter")
        );
        return new Response("<html><head></head><body></body></html>");
    }

}
