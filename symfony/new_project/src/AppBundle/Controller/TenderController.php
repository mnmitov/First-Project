<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tender;
use AppBundle\Form\TenderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TenderController extends Controller
{
  /**
   * @Route("/new_tender", name="new_tender")
   */
  public function tenderRegister(Request $request)
  {
    $tender = new Tender();
    $form = $this->createForm(TenderType::class, $tender);
    $form->handleRequest($request);
    if ($form->isSubmitted()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($tender);
      $em->flush();

      return $this->redirectToRoute('all_tenders');
    }

    return $this->render('default/create.html.twig', ['form' => $form->createView()]);
  }

  /**
   * @Route ("/tenders/create", name="create")
   */
  public function create(Request $request)
  {
    $form = $this->createForm(TenderType::class);
    return $this->render('default/create.html.twig',
      ['form' => $form->createView()
      ]);
  }

  /**
   * @Route("/tenders/all", name="all_tenders")
   */
  public function all()
  {
    $tenders = $this->getDoctrine()->getRepository(Tender::class)->findBy([], ['deadline' => 'DESC']);

    return $this->render(':default:list.html.twig', ['tenders' => $tenders]);
  }

  /**
   * @Route("/tenders/delete/{id}", name="delete_tender")
   * @param $id
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function delete($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $tenders = $em->getRepository('AppBundle:Tender')->find($id);
    $em->remove($tenders);
    $em->flush();

    return $this->redirectToRoute('all_tenders');
  }


  /**
   * @Route("/tenders/edit/{id}", name="edit_tender")
   * @param $id
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function edit($id, Request $request)
  {
    $repo = $this->getDoctrine()->getRepository(Tender::class);
    $tenders = $repo->find($id);

    if ($tenders === null) {
      return $this->redirect("/");
    }

    $form = $this->createForm(TenderType::class, $tenders);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($tenders);
      $em->flush();

      return $this->redirect('/tenders/all');
    }

    return $this->render(
      'default/edit.html.twig',
      ['tenders' => $tenders, 'form' => $form->createView()]);
  }

}
