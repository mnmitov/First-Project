<?php
/**
 * @Author Miroslav Mitov
 */
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends Controller
{
  /**
   * @Route("/login", name="security_login")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
    public function loginAction($id)
    {
        $users = $this->getDoctrine()->getRepository(UserType::class)->find($id);
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
