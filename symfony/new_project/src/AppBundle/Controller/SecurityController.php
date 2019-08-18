<?php
/**
 * @Author Miroslav Mitov
 */
namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends Controller
{
  /**
   * @Route("/login", name="security_login")
   * @return \Symfony\Component\HttpFoundation\Response
   */
    public function login()
    {
        $users = $this->getDoctrine()->getRepository(UserType::class);
        return $this->render('home/index.html.twig', ['users' => $users]);
    }

  /**
   * @Route("/logout", name="security_logout")
   * @throws \Exception
   */
  public function logout()
  {
    throw new \Exception('Logout failed!');
  }
}
