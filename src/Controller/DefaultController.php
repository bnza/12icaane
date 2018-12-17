<?php

namespace App\Controller;

use App\Entity\Speaker;
use App\Form\SpeakerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('default/home.html.twig');
    }

    /**
     * @Route("/register", name="register_speaker")
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function register(Request $request, SessionInterface $session)
    {
        $speaker = new Speaker();
        $form = $this->createForm(SpeakerType::class, $speaker);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $speaker = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($speaker);
            $entityManager->flush();

            $session->set('speaker_reg_id', $speaker->getId());
            return $this->redirectToRoute('reg_confirmation');
        }

        return $this->render('default/register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/confirmation", name="reg_confirmation")
     * @param SessionInterface $session
     * @return Response
     */
    public function confirmation(SessionInterface $session)
    {
        if ($session->has('speaker_reg_id')) {
            $id = $session->get('speaker_reg_id');
            $speaker = $this->getDoctrine()->getManager()->find(Speaker::class, $id);
            return $this->render('default/confirmation.html.twig', array(
                'speaker' => $speaker,
            ));
        } else {
            return $this->redirectToRoute('home');
        }
    }
}
