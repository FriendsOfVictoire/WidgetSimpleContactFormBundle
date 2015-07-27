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
use Victoire\Widget\SimpleContactFormBundle\Entity\WidgetSimpleContactFormMessageInterface;
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
     * @param WidgetSimpleContactForm $widget
     *
     * @Route("/submit/{id}", name="SimpleContactForm_Default_formSubmit")
     * @Template()
     * @Method({"POST"})
     * @return Response
     */
    public function formSubmitAction(Request $request, WidgetSimpleContactForm $widget)
    {
        $entityClass = $this->container->getParameter('victoire_widget_simple_contact_form.entity_class');
        /** @var WidgetSimpleContactFormMessageInterface $message */
        $message = new $entityClass();
        $message->setWidget($widget);
        $widget->infoMessage = null;
        $form    = $this->createMessageForm($message);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            $body = $this->renderView(
                'VictoireWidgetSimpleContactFormBundle:Message:email.html.twig',
                array(
                    'recipient' => array(
                        'name' => $widget->getRecipientName(),
                        'email' => $widget->getRecipientEmail()
                    ),
                    'message' => $message,
                )
            );

            $this->createAndQueueMail(
                $widget->getSubject(),
                $widget->getSenderEmail(),
                $widget->getRecipientEmail(),
                $body,
                'text/html',
                $widget->getReplyToEmail()
            );

            if (!$request->isXmlHttpRequest()) {
                return $this->redirectReferer();
            } else {
                $widget->infoMessage = $this->get('translator')->trans(
                    'widget.simplecontactform.submit.notice.success'
                );
            }
        }

        $view = $widget->getView();
        $reference = $this->get('victoire_core.view_cache_helper')->getReferenceByParameters(array('viewId' => $view->getId()));
        $view->setReference($reference);

        return new JsonResponse(
            array(
                'success' => false,
                'html'    => $this->get('victoire_widget.widget_renderer')->render($widget, $view)
            )
        );
    }


    /**
     * Creates a form to create a SimpleContactForm message type.
     * @param SimpleContactForm $message
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createMessageForm(WidgetSimpleContactFormMessageInterface $message)
    {
        $formClass = $this->container->getParameter('victoire_widget_simple_contact_form.form_class');
        $form = $this->createForm(
            new $formClass(),
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
