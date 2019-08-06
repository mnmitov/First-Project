<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
  /**
   * @Route("/", name="homepage")
   */
  public function indexAction(Request $request)
  {
    return $this->render('default/index.html.twig', [
      'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
    ]);

  }


  /**
   * @Route ("/create", name="create")
   */
  public function create(Request $request)
  {
    $form = $this->createForm(UserType::class);
    return $this->render('default/create.html.twig',
      ['form' => $form->createView()
      ]);
  }
}
