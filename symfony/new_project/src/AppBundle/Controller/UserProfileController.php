<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserProfileController extends Controller
{
  /**
   * @Route("/user/profile", name="index_profile")
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   */
  public function profileIndex()
  {
    $userProfile =  $this->getDoctrine()->getRepository(User::class)
      ->find($this->getUser());
    return $this->render('users/profile.html.twig', ['user' => $userProfile]);
  }

  /**
   * @param $id
   * @Route("/user/profile/delete/{id}", name="user_delete")
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function profileDelete($id) {
    $user = $this->getDoctrine()->getRepository(User::class)->find($id);

    if ($user === null) {
      return $this->redirectToRoute('homepage');
    }
    $em = $this->getDoctrine()->getManager();
    $em->remove($user);
    $em->flush();
    return $this->redirectToRoute('homepage');
  }

}
