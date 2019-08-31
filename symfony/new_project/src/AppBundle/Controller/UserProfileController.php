<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tender;
use AppBundle\Entity\User;
use AppBundle\Form\TenderType;
use AppBundle\Form\UserEditType;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserProfileController extends Controller
{
  /**
   * @Route("/user/profile", name="index_profile", methods={"GET"})
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   */
  public function profileIndex()
  {
    $userProfile = $this->getDoctrine()->getRepository(User::class)
      ->find($this->getUser());
    return $this->render('users/profile.html.twig', ['user' => $userProfile]);
  }

  /**
   * @param $id
   * @param TokenStorageInterface $tokenStorage
   * @return Response
   * @Route("/user/profile/delete/{id}", name="user_delete", methods={"GET"})
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   * @throws \Exception
   */
  public function profileDelete($id, TokenStorageInterface $tokenStorage)
  {
    $user = $this->getDoctrine()->getRepository(User::class)->find($id);

    if ($user === null) {
      return $this->redirectToRoute('index_profile');
    }
    return $this->render('users/delete_profile.html.twig', ['user' => $user]);
  }

  /**
   * @param $id
   * @param TokenStorageInterface $tokenStorage
   * @return Response
   * @Route("/user/profile/delete/process/{id}", name="user_delete_process", methods={"POST"})
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   * @throws \Exception
   */
  public function profileDeleteProcess($id, TokenStorageInterface $tokenStorage)
  {
    $user = $this->getDoctrine()->getRepository(User::class)->find($id);

    if ($user === null) {
      return $this->redirectToRoute('homepage');
    }
    $this->get('security.token_storage')->setToken(null);
    $em = $this->getDoctrine()->getManager();
    $em->remove($user);
    $em->flush();
    $this->addFlash('warning', 'Your account has been deleted!');
    return $this->redirectToRoute('homepage');
  }


  /**
   * @Route("/user/profile/edit/{id}", name="edit_profile", methods={"GET"})
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   * @param $id
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function profileEdit($id, Request $request)
  {
    $user = $this->getDoctrine()->getRepository(User::class)->find($id);
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);
    if ($user === null) {
      return $this->redirectToRoute('index_profile');
    }
    return $this->render(':users:edit_profile.html.twig',
      ['user' => $user, 'form' => $form->createView()]);
  }

  /**
   * @Route("/user/profile/edit/edit/{id}", name="edit_profile_process")
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   * @param $id
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function profileEditProcess($id, Request $request)
  {
    $user = $this->getDoctrine()->getRepository(User::class)->find($id);
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);
    if ($user === null) {
      return $this->redirectToRoute('index_profile');
    }
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();
      $this->addFlash('success', 'Successfully changed your details!');
      return $this->redirectToRoute('index_profile');
    }
    $this->addFlash('warning', 'There have been errors!');
    return $this->render('users/edit_profile.html.twig', ['user' => $user, 'form' => $form->createView()]);
  }

//  /**
//   * @Route("/user/profile/password_change/{id}", name="change_password", methods={"POST"})
//   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
//   * @param $id
//   * @param Request $request
//   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
//   * @throws \Exception
//   */
//  public function passwordChange($id, Request $request)
//  {
//    $changePasswordModel = new Password();
//    $form = $this->createForm(PasswordType::class, $changePasswordModel);
//    $form->handleRequest($request);
//
//    if ($form->isSubmitted() && $form->isValid()) {
//      $em = $this->getDoctrine()->getManager();
//      $user = $this->getUser();
//      $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
//      $password = $encoder->encodePassword($changePasswordModel->getPassword(), $user);
//      $user->setPassword($password);
//      $em->persist($user);
//      $em->flush();
//      $this->addFlash('success', 'The password has been changed successfully!');
//      return $this->redirectToRoute('index_profile');
//    }
//    return $this->render('users/edit_profile.html.twig', array('form' => $form->createView()));
//  }


}
