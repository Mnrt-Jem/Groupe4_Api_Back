<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Form\ActivityAreaType;
use App\AdminBundle\Entity\ActivityArea;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

/**
* @Route("/activityArea")
*/
class ActivityAreaController extends AbstractController
{
  /**
  * @Route ("/new")
  * @param Request $request
  */
  public function new(Request $request){
      $activityArea = new ActivityArea();

      $form = $this->createForm(ActivityAreaType::class, $activityArea);
      $form->add('submit', SubmitType::class, [
        'label' => 'Enregistrer',
      ]);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid())
      {
        $em = $this->getDoctrine()->getManager();
        $em->persist($activityArea);
        $em->flush();
        return $this->redirectToRoute('activityArea_list');
      }

      return $this->render('activityArea/new.html.twig', array('form' => $form->createView()));
  }

  /**
  * @Route ("/edit/{activityArea}")
  * @param Request $request
  */
  public function edit (Request $request, ActivityArea $activityArea){

    $form = $this->createForm(ActivityAreaType::class, $activityArea);

    $form->add('submit', SubmitType::class, [
      'label' => 'Modifier',
    ]);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {
      $em = $this->getDoctrine()->getManager();
      $em->persist($activityArea);
      $em->flush();
      return $this->redirectToRoute('activityArea_list');
    }

    return $this->render('activityArea/edit.html.twig', array('form' => $form->createView()));
  }

  /**
   * @Route("/list", name="activityArea_list")
   */
  public function list (Request $request){

  }
}
