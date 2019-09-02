<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tender;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MyTenderController extends Controller
{

  /**
   * @Route("/user/my_tenders/{id}", name="my_tenders", methods={"GET"})
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   * @param $id
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function myTenders($id, Request $request)
  {
    $tenders = $this->getDoctrine()->getRepository(Tender::class)->findAll();

    return $this->render("users/my_tenders.html.twig", ['tenders' => $tenders]);
  }
}
