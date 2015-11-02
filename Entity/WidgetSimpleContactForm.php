<?php

namespace Victoire\Widget\SimpleContactFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Bundle\WidgetBundle\Entity\Widget;

/**
 * WidgetSimpleContactForm.
 *
 * @ORM\Table("vic_widget_simplecontactform")
 * @ORM\Entity
 */
class WidgetSimpleContactForm extends Widget
{
    /**
     * @var string
     *
     * @ORM\Column(name="recipientName", type="string", length=255)
     */
    protected $recipientName;

    /**
     * @var string
     *
     * @ORM\Column(name="recipientEmail", type="string", length=255)
     */
    protected $recipientEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="replyToEmail", type="string", length=255, nullable=true)
     */
    protected $replyToEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="senderEmail", type="string", length=255)
     */
    protected $senderEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    protected $subject;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="\Victoire\Widget\SimpleContactFormBundle\Entity\WidgetSimpleContactFormMessage", mappedBy="widget")
     * @ORM\OrderBy({"id" = "ASC"})
     */
    protected $messages;

    /**
     * To String function
     * Used in render choices type (Especially in VictoireWidgetRenderBundle)
     * //TODO Check the generated value and make it more consistent.
     *
     * @return string
     */
    public function __toString()
    {
        return 'SimpleContactForm #'.$this->id;
    }

    /**
     * Set recipientName.
     *
     * @param string $recipientName
     */
    public function setRecipientname($recipientName)
    {
        $this->recipientName = $recipientName;

        return $this;
    }

    /**
     * Get recipientName.
     *
     * @return string
     */
    public function getRecipientname()
    {
        return $this->recipientName;
    }

    /**
     * Set recipientEmail.
     *
     * @param string $recipientEmail
     */
    public function setRecipientEmail($recipientEmail)
    {
        $this->recipientEmail = $recipientEmail;

        return $this;
    }

    /**
     * Get recipientEmail.
     *
     * @return string
     */
    public function getRecipientEmail()
    {
        return $this->recipientEmail;
    }

    /**
     * Set replyToEmail.
     *
     * @param string $replyToEmail
     */
    public function setReplyToEmail($replyToEmail)
    {
        $this->replyToEmail = $replyToEmail;

        return $this;
    }

    /**
     * Get replyToEmail.
     *
     * @return string
     */
    public function getReplyToEmail()
    {
        return $this->replyToEmail;
    }

    /**
     * Set senderEmail.
     *
     * @param string $senderEmail
     */
    public function setSenderEmail($senderEmail)
    {
        $this->senderEmail = $senderEmail;

        return $this;
    }

    /**
     * Get senderEmail.
     *
     * @return string
     */
    public function getSenderEmail()
    {
        return $this->senderEmail;
    }

    /**
     * Get subject.
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set subject.
     *
     * @param string $subject
     *
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get messages.
     *
     * @return string
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set messages.
     *
     * @param string $messages
     *
     * @return $this
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;

        return $this;
    }
}
