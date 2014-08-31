<?php
namespace Victoire\Widget\SimpleContactFormBundle\Resolver;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Form\FormFactory;
use Victoire\Bundle\WidgetBundle\Model\Widget;
use Victoire\Bundle\WidgetBundle\Resolver\BaseWidgetContentResolver;
use Victoire\Widget\SimpleContactFormBundle\Entity\WidgetSimpleContactFormMessage;
use Victoire\Widget\SimpleContactFormBundle\Form\WidgetSimpleContactFormMessageType;

class WidgetSimpleContactFormResolver extends BaseWidgetContentResolver
{

    private $formFactory;

    public function __construct(FormFactory $formFactory, Router $router)
    {
        $this->formFactory = $formFactory;
        $this->router = $router;
    }

    /**
     * Get the content of the widget for the static mode
     * @param Widget $widget
     *
     * @return string
     *
     */
    public function getWidgetStaticContent(Widget $widget)
    {
        $parameters = parent::getWidgetStaticContent($widget);

        $message = new WidgetSimpleContactFormMessage();
        $message->setWidget($widget);

        $form = $this->formFactory->create(
            new WidgetSimpleContactFormMessageType(),
            $message,
            array(
                'action' => $this->router->generate(
                    'SimpleContactForm_Default_formSubmit',
                    array('id' => $message->getWidget()->getId())
                ),
                'method' => 'POST',
                'attr' => array(
                    'data-toggle'  => "ajax",
                    'data-update' => "vic-widget-".$widget->getId()."-container"
                ),
            )
        );

        $parameters['form'] = $form->createView();

        return $parameters;
    }

}
