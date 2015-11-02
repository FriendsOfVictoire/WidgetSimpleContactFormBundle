<?php

namespace Victoire\Widget\SimpleContactFormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            ->add('email', null, [
                    'label' => 'widget.simpleContactForm.messageType.email.label',
                    'attr'  => [
                        'placeholder' => 'widget.simpleContactForm.messageType.email.placeholder',
                    ],
                ]
            )
            ->add('content', 'textarea', [
                    'label' => 'widget.simpleContactForm.messageType.content.label',
                    'attr'  => [
                        'placeholder' => 'widget.simpleContactForm.messageType.content.placeholder',
                        'rows'        => 10,
                    ],
                ]
            );
    }

    /**
     * GetName function.
     *
     * @return string Name
     */
    public function getName()
    {
        return 'widget_simpleContactForm_message_type';
    }

    /**
     * bind form to WidgetSimpleContactFormMessage entity.
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults([
            'data_class' => 'Victoire\Widget\SimpleContactFormBundle\Entity\WidgetSimpleContactFormMessage',
        ]);
    }
}
