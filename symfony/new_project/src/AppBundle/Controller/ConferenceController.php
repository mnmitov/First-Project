<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Meeting;
use AppBundle\Form\MeetingType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends Controller
{
  /**
   * @Route("/conference", name="conference_index")
   * @return \Symfony\Component\HttpFoundation\Response
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   */
  public function conferenceIndex()
    {
      $meetings = $this->getDoctrine()->getRepository(Meeting::class)->findBy([], ['meetingDate' => 'ASC']);
        return $this->render('conference/meetings.html.twig', ['meetings' => $meetings]);
    }

  /**
   * @Route("/conference/add_meeting", name="add_meeting")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   * @throws \Exception
   */
  public function addMeeting(Request $request)
  {
    $meeting = new Meeting();
    $form = $this->createForm(MeetingType::class, $meeting);
    $form->handleRequest($request);

    if ($form->isSubmitted()) {
      $meeting->setAuthor($this->getUser());
      $em = $this->getDoctrine()->getManager();
      $em->persist($meeting);
      $em->flush();
      $this->addFlash('success', 'Successfully scheduled a new meeting!');
      return $this->redirectToRoute('conference_index');
    }
    return $this->render('conference/add_meetings.html.twig', ['meeting' => $meeting, 'form' => $form->createView()]);
  }

  /**
   * @Route("/conference/cancel/{id}", name="cancel_meeting")
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   * @throws \Exception
   */
  public function cancelMeeting($id, Request $request)
  {
    $meeting = $this->getDoctrine()->getRepository(Meeting::class)->find($id);
    if ($meeting === null) {
      return $this->redirectToRoute('conference_index');
    }
    $currentUser = $this->getUser();
    if (!$currentUser->isInitiator($meeting) && !$currentUser->isAdmin()) {
      $this->addFlash('warning', 'You must be the initiator of this meeting to edit!');
      return $this->redirectToRoute('conference_index');
    }
    $em = $this->getDoctrine()->getManager();
    $em->remove($meeting);
    $em->flush();
    $this->addFlash('warning', 'Meeting cancelled!');
    return $this->redirectToRoute('conference_index');
  }

  /**
   * @Route("/conference/rearrange/{id}", name="rearrange")
   * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
   * @param $id
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \Exception
   */
  public function rearrangeMeeting($id, Request $request)
  {
    $meeting = $this->getDoctrine()->getRepository(Meeting::class)->find($id);
    $form = $this->createForm(MeetingType::class, $meeting);
    $form->handleRequest($request);
    if ($meeting === null) {
      return $this->redirectToRoute('conference_index');
    }
    $currentUser = $this->getUser();
    if (!$currentUser->isInitiator($meeting) && !$currentUser->isAdmin()) {
      $this->addFlash('warning', 'You must be the initiator to rearrange this meeting!');
      return $this->redirectToRoute('conference_index');
    }
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($meeting);
      $em->flush();
      $this->addFlash('success', 'Meeting rearranged!');
      return $this->redirectToRoute('conference_index');
    }
    return $this->render('conference/rearrange_meetings.html.twig', ['meeting' => $meeting, 'form' => $form->createView()]);
  }
}
