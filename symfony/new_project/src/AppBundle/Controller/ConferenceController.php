<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends Controller
{
  /**
   * @Route("/conference", name="conference_index")
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function conferenceIndex()
    {
        return $this->render('conference/meetings.html.twig');
    }

  /**
   * @Route("/conference/add_meeting", name="add_meeting")
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function addMeeting()
  {
    return $this->render('conference/add_meetings.html.twig');
  }
}
