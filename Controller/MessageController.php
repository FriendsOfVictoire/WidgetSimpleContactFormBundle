<?php

namespace Victoire\Widget\SimpleContactFormBundle\Controller;

use AppVentus\Awesome\ShortcutsBundle\Controller\AwesomeController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Victoire\Widget\SimpleContactFormBundle\Entity\WidgetSimpleContactForm;
use Victoire\Widget\SimpleContactFormBundle\Entity\WidgetSimpleContactFormMessage;
use Victoire\Widget\SimpleContactFormBundle\Form\WidgetSimpleContactFormMessageType;

/**
 * Simple contact form default controller
 *
 * @Route("/simpleContactForm/message")
 */
class MessageController extends AwesomeController
{

    /**
     * Submit method
     * @param SimpleContactFormWidget $widget
     *
     * @Route("/submit/{id}", name="SimpleContactForm_Default_formSubmit")
     * @Template()
     * @Method({"POST"})
     * @return Response
     */
    public function formSubmitAction(Request $request, WidgetSimpleContactForm $widget)
    {
        $message = new WidgetSimpleContactFormMessage();
        $message->setWidget($widget);
        $form    = $this->createMessageForm($message);

        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            $body = $this->renderView('VictoireWidgetSimpleContactFormBundle:Message:email.html.twig', array(
                'recipient' => array(
                    'name'  => $widget->getRecipientName(),
                    'email' => $widget->getRecipientEmail()
                ),
                'message'   => $message,
            ));

            $this->createAndQueueMail(
                $widget->getSubject(),
                $widget->getSenderEmail(),
                $widget->getRecipientEmail(),
                $body,
                'text/html',
                $widget->getReplyToEmail()
            );

            if ($this->getRequest()->isXmlHttpRequest()) {
                return new Response($this->get('translator')->trans('widget.simplecontactform.submit.notice.success', array(), 'victoire'));
            } else {
                return $this->redirectReferer();
            }
        } else {
            $showView = 'show'.ucfirst($widget->getTheme());
            $templateName = $this->container->get('victoire_widget.widget_helper')->getTemplateName($showView, $widget);
            $view = $widget->getView();
            $reference = $this->get('victoire_core.view_cache_helper')->getReferenceByParameters(array('viewId' => $view->getId()));
            $view->setReference($reference);

            return new JsonResponse(
                array(
                    'success' => false,
                    'html'    => $this->renderView(
                        $templateName,
                        array(
                            'widget' => $widget,
                            'form'   => $form->createView()
                        )
                    )
                )
            );
        }
    }

    /**
     * Creates a form to create a SimpleContactForm message type.
     * @param SimpleContactForm $message
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createMessageForm(WidgetSimpleContactFormMessage $message)
    {
        $form = $this->createForm(
            new WidgetSimpleContactFormMessageType(),
            $message,
            array(
                'action' => $this->generateUrl('SimpleContactForm_Default_formSubmit', array('id' => $message->getWidget()->getId())),
                'method' => 'POST',
                'attr' => array(
                    'data-toggle'  => "ajax",
                    'data-update' => "vic-widget-".$message->getWidget()->getId()."-container"
                ),
            )
        );

        return $form;
    }
}
