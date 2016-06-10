<?php

namespace AppBundle\Controller;

use AppBundle\Form\TransporterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $form = $this->createForm(TransporterType::class);

//        $form = $this->createFormBuilder()
//                     ->add('isAttending', ChoiceType::class, [
//                             'choices'           => [
//                                 'Maybe' => null,
//                                 'Yes'   => true,
//                                 'No'    => false,
//                             ],
//                             // *this line is important*
//                             'choices_as_values' => true,
//                             'expanded'          => true,
//                             'multiple'          => false,
//                             'constraints'       => new NotBlank(['message' => 'blaat']),
//
//                         ]
//                     )
//                     ->add('task', TextType::class, [
//                         'constraints' => new NotBlank(['message' => 'blaat']),
//                         'required'    => true,
//                     ])
//                     ->add('dueDate', DateType::class, [
//                         'constraints' => new NotBlank(['message' => 'blaat']),
//                     ])
//                     ->add('save', SubmitType::class, array('label' => 'Create Task'))
//                     ->getForm();

        $form->handleRequest($request);
        if (! $form->isValid()) {

            return $this->render('AppBundle::test.html.twig', ['form' => $form->createView()]);
        }

        echo 'valid';
        exit();
//        return $this->redirect($this->get('router')->generate('portal_task_create_success'));
    }
}