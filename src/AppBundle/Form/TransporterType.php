<?php namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;


class TransporterType extends AbstractType
{
    public function __construct()
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('isAttending', ChoiceType::class, [
                    'choices'           => [
                        'Yes' => true,
                        'No'  => false,
                    ],
                    'placeholder'       => 'Make your choice',
                    'choices_as_values' => true,
                    'expanded'          => false,
                    'multiple'          => false,
                    'constraints'       => new NotBlank([
                        'message' => 'Are you attending?',
                        'groups'  => ['foobar'],
                    ]),
                ]
            )
            ->add('task', TextType::class, [
                'constraints' => new NotBlank([
                    'message' => 'What is your task?',
                    'groups'  => ['foobar'],
                ]),
                'required'    => true,
            ])
            ->add('date', TextType::class, [
                'constraints' => new NotBlank(['message' => 'Please fill in a date']),
            ])
            ->add('save', SubmitType::class, array('label' => 'submit'));
    }


    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr'              => [
                'class'      => 'form-horizontal',
                'novalidate' => 'novalidate',
            ],
            //            'data_class'        => 'Acme\DemoBundle\Entity\User',
            'validation_groups' => function (FormInterface $form) {
                $groups = ['Default'];


                if ($form->isSubmitted() && $form->getData()['date'] == 'testCondition') {
                    array_push($groups, 'foobar');
                }

                return $groups;
            },
        ]);
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'form';
    }
}
