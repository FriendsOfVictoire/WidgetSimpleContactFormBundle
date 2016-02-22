<?php

namespace Victoire\Widget\SimpleContactFormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Widget SimpleContactForm Message Type.
 */
class WidgetSimpleContactFormMessageType extends AbstractType
{
    /**
     * Build form function.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                    'label' => 'widget.simpleContactForm.messageType.name.label',
                    'attr'  => [
                        'placeholder' => 'widget.simpleContactForm.messageType.name.placeholder',
                    ],
                ]
            )
            ->add('email', EmailType::class, [
                    'label' => 'widget.simpleContactForm.messageType.email.label',
                    'attr'  => [
                        'placeholder' => 'widget.simpleContactForm.messageType.email.placeholder',
                    ],
                ]
            )
            ->add('content', TextareaType::class, [
                    'label' => 'widget.simpleContactForm.messageType.content.label',
                    'attr'  => [
                        'placeholder' => 'widget.simpleContactForm.messageType.content.placeholder',
                        'rows'        => 10,
                    ],
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => 'Victoire\Widget\SimpleContactFormBundle\Entity\WidgetSimpleContactFormMessage',
        ]);
    }
}
