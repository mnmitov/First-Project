<?php
/**
 * @Author Miroslav Mitov
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Role;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
  /**
   * @Route("/register", name="user_register")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   * @throws \Exception
   */
  public function registerAction(Request $request)
  {
    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $passwordHash =
        $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());

      $roleUser = $this->getDoctrine()->getRepository(Role::class)->findOneBy(['name' => 'ROLE_USER']);
      $user->addRole($roleUser);

      $user->setPassword($passwordHash);
      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();
      $this->addFlash('success','You have been successfully registered!');
      return $this->redirectToRoute('homepage');
    }

    return $this->render('users/register.html.twig', ['form' => $form->createView()]);
  }

}
