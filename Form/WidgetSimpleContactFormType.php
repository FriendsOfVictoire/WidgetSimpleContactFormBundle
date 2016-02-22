<?php

namespace Victoire\Widget\SimpleContactFormBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Victoire\Bundle\CoreBundle\Form\WidgetType;

/**
 * WidgetSimpleContactForm form type.
 */
class WidgetSimpleContactFormType extends WidgetType
{
    /**
     * define form fields.
     *
     * @param FormBuilderInterface $builder
     *
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', null, [
                    'label' => 'widget_simplecontactform.form.subject.label',
                ]
            )
            ->add('recipientName', null, [
                    'label' => 'widget_simplecontactform.form.recipientName.label',
                ]
            )
            ->add('recipientEmail', null, [
                    'label' => 'widget_simplecontactform.form.recipientEmail.label',
                ]
            )
            ->add('senderEmail', null, [
                    'label' => 'widget_simplecontactform.form.senderEmail.label',
                ]
            );
        parent::buildForm($builder, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class'         => 'Victoire\Widget\SimpleContactFormBundle\Entity\WidgetSimpleContactForm',
            'widget'             => 'SimpleContactForm',
            'translation_domain' => 'victoire',
        ]);
    }
}
