<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tender;
use AppBundle\Entity\User;
use AppBundle\Form\TenderType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MyTenderController extends Controller
{

  /**
   * @Route("/user/my_tenders/{id}", name="my_tenders")
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   * @param $id
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function myTenders($id, Request $request)
  {
    $tenders = $this->getDoctrine()->getRepository(Tender::class)->find($id);

    return $this->render("users/user_tenders.html.twig", ['tenders' => $tenders]);
  }
}
