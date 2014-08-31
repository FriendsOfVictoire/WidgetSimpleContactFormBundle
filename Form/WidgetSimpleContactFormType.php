<?php

namespace Victoire\Widget\SimpleContactFormBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Victoire\Bundle\CoreBundle\Form\WidgetType;

/**
 * WidgetSimpleContactForm form type
 */
class WidgetSimpleContactFormType extends WidgetType
{
    /**
     * define form fields
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'subject',
                null,
                array(
                    'label' => 'widget_simplecontactform.form.subject.label'
                )
            )
            ->add(
                'recipientName',
                null,
                array(
                        'label' => 'widget_simplecontactform.form.recipientName.label'
                    )
                )
            ->add(
                'recipientEmail',
                null,
                array(
                    'label' => 'widget_simplecontactform.form.recipientEmail.label'
                )
            )
            ->add(
                'senderEmail',
                null,
                array(
                    'label' => 'widget_simplecontactform.form.senderEmail.label'
                )
            );
            parent::buildForm($builder, $options);

    }

    /**
     * bind form to WidgetSimpleContactForm entity
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'data_class'         => 'Victoire\Widget\SimpleContactFormBundle\Entity\WidgetSimpleContactForm',
            'widget'             => 'SimpleContactForm',
            'translation_domain' => 'victoire'
        ));
    }

    /**
     * get form name
     *
     * @return string The form name
     */
    public function getName()
    {
        return 'victoire_widget_form_simplecontactform';
    }
}
