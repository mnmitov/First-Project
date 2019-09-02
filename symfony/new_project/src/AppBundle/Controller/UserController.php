<?php
/**
 * @Author Miroslav Mitov
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Services\Users\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
  /**
   * @var UserServiceInterface
   */
  private $userService;

  public function __construct(UserServiceInterface $userService)
  {
    $this->userService = $userService;
  }


  /**
   * @Route("/register", name="user_register", methods={"GET"})
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function register(Request $request)
  {
    return $this->render('users/register.html.twig',
      ['form' => $this->createForm(UserType::class)->createView()]);
  }


  /**
   * @Route("/register", methods={"POST"})
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   * @throws \Exception
   */
  public function registerProcess(Request $request)
  {
    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);
    $this->userService->save($user);
    $this->addFlash('success', 'You have been successfully registered!');
    return $this->redirectToRoute('homepage');
  }

}
