<?php
/**
 * @Author Miroslav Mitov
 */
namespace AppBundle\Controller;

use AppBundle\Entity\Tender;
use AppBundle\Form\TenderType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TenderController extends Controller
{
  /**
   * @Route("/new_tender", name="new_tender")
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
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

    return $this->render('home/list.html.twig', ['form' => $form->createView()]);
  }

  /**
   * @Route ("/tenders/create", name="create")
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   */
  public function create(Request $request)
  {
    $form = $this->createForm(TenderType::class);
    return $this->render('home/list.html.twig',
      ['form' => $form->createView()
      ]);
  }

  /**
   * @Route("/tenders/all", name="all_tenders")
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   */
  public function allTenders()
  {
    $tenders = $this->getDoctrine()->getRepository(Tender::class)->findBy([], ['deadline' => 'ASC']);

    return $this->render("home/list.html.twig", ['tenders' => $tenders]);
  }

  /**
   * @Route("/tenders/delete/{id}", name="delete_tender")
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   * @param $id
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function deleteTender($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $tenders = $em->getRepository('AppBundle:Tender')->find($id);
    $em->remove($tenders);
    $em->flush();

    return $this->redirectToRoute('all_tenders');
  }


  /**
   * @Route("/tenders/edit/{id}", name="edit_tender")
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   * @param $id
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function editTender($id, Request $request)
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
      'home/edit.html.twig',
      ['tenders' => $tenders, 'form' => $form->createView()]);
  }

}
