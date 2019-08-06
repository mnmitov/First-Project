<?php
/**
 * @Author Miroslav Mitov
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
  /**
   * @Route("/users/register", name="user_register")
   */
  public function register(Request $request)
  {
    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);
    if ($form->isSubmitted()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();

      return $this->redirectToRoute('all_users');
    }
    var_dump($user);
    return $this->render('default/create.html.twig', ['form' => $form->createView()]);
  }

  /**
   * @Route("/users/all", name="all_users")
   */
  public function all()
  {
    $users = $this->getDoctrine()->getRepository(User::class)->findBy([], ['id' => 'DESC']);

    return $this->render('default/list.html.twig', ['users' => $users]);
  }

  /**
   * @Route("/users/delete/{id}", name="remove_user")
   * @param $id
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function delete($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $user = $em -> getRepository('AppBundle:User')->find($id);
    $em -> remove($user);
    $em -> flush();

    return $this->redirectToRoute('all_users');
  }


  /**
   * @Route("/users/edit/{id}", name="edit_user")
   * @param $id
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function edit($id, Request $request)
  {
    $repo = $this->getDoctrine()->getRepository(User::class);
    $user = $repo->find($id);

    if ($user === null) {
      return $this->redirect("/");
    }

    $form = $this->createForm(UserType::class, $user);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();

      return $this->redirect('/users/all');
    }

    return $this->render(
      'default/edit.html.twig',
      ['users' => $user, 'form' => $form->createView()]);
  }
}
