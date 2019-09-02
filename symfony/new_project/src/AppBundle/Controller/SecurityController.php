<?php
/**
 * @Author Miroslav Mitov
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends DefaultController
{
  /**
   * @Route("/", name="security_login")
   * @param AuthenticationUtils $authenticationUtils
   * @return \Symfony\Component\HttpFoundation\Response
   */
    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
      // get the login error if there is one
      $error = $authenticationUtils->getLastAuthenticationError();

      // last username entered by the user
      $lastUsername = $authenticationUtils->getLastUsername();

      return $this->render(':home:index.html.twig', [
        'last_username' => $lastUsername,
        'error'         => $error
      ]);
    }

  /**
   * @Route("/logout", name="security_logout")
   * @throws \Exception
   */
  public function logout()
  {
    $this->addFlash('success', 'Successfully logged out!');
    throw new \Exception('Logout failed!');
  }
}
