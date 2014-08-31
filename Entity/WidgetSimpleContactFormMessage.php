<?php

namespace Victoire\Widget\SimpleContactFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * When some visitor use the contact form, it is stored with this entity
 * @ORM\Table("vic_widget_simplecontactform_message")
 * @ORM\Entity
 */
class WidgetSimpleContactFormMessage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @var string
     */
    public $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(name="email", type="string", length=255)
     *
     * @var string
     */
    public $email;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="content", type="text")
     *
     * @var string
     */
    public $content;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="\Victoire\Bundle\WidgetBundle\Entity\Widget", inversedBy="messages")
     * @ORM\JoinColumn(name="widget_id", referencedColumnName="id", onDelete="CASCADE")
     */
    public $widget;

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set content
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get widget
     *
     * @return string
     */
    public function getWidget()
    {
        return $this->widget;
    }

    /**
     * Set widget
     * @param string $widget
     *
     * @return $this
     */
    public function setWidget($widget)
    {
        $this->widget = $widget;

        return $this;
    }
}
