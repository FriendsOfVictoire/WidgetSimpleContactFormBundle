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

    public function __construct(FormFactory $formFactory, Router $router, $contactEntity, $contactForm, $formActionRoute)
    {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->contactEntity = $contactEntity;
        $this->contactForm = $contactForm;
        $this->formActionRoute = $formActionRoute;
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
        $contactEntity = $this->contactEntity;
        $contactForm = $this->contactForm;
        $message = new $contactEntity();
        $message->setWidget($widget);

        $form = $this->formFactory->create(
            new $contactForm(),
            $message,
            array(
                'action' => $this->router->generate(
                    $this->formActionRoute,
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
