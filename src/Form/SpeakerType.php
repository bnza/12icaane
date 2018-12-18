<?php

namespace App\Form;

use App\Entity\Speaker;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpeakerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('main_author', TextType::class, ['label' => 'main author', 'required' => true])
            ->add('other_authors', TextType::class, ['label' => 'other authors', 'required' => false])
            ->add('title', TextType::class, ['label' => 'title', 'required' => true])
            ->add('affiliation', TextType::class, ['label' => 'affiliation', 'required' => true])
            ->add(
                'theme',
                ChoiceType::class,
                [
                    'label' => 'ICAANE theme',
                    'required' => true,
                    'placeholder' => 'Choose an option',
                    'choices' => [
                        '1. Field Reports' => 1,
                        '2. Environmental Archaeology' => 2,
                        '3. Hammering the material world' => 3,
                        '4. Cognitive archaeology' => 4,
                        '5. Modeling the past' => 5,
                        '6. Networked archaeology' => 6,
                        '7. Endangered cultural heritage' => 7,
                        '8. Islamic archaeology' => 8,
                        'W. ?' => 'W',
                        'P. Posters' => 'P',
                    ],
                ]
            )
            ->add(
                'abstract',
                TextareaType::class,
                [
                    'label' => 'abstract',
                    'required' => true,
                    'help' => 'Contribute abstract, 400 to 1000 characters. Required',
                ]
            )
            ->add('email', EmailType::class, ['label' => 'e-mail', 'required' => true])
            ->add('payment_id', TextType::class, ['label' => 'payment ID', 'required' => true])
            ->add(
                'remarks',
                TextareaType::class,
                [
                    'label' => 'remarks',
                    'required' => true,
                    'help' => 'Up to 300 characters',
                ]
            )
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Speaker::class,
        ));
    }
}
