<?php

namespace Victoire\Widget\SimpleContactFormBundle\Entity;

use Victoire\Bundle\WidgetBundle\Model\Widget;

interface WidgetSimpleContactFormMessageInterface
{

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     *
     * @return $this
     */
    public function setName($name);

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email);

    /**
     * Get content
     *
     * @return string
     */
    public function getContent();

    /**
     * Set content
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content);

    /**
     * Get widget
     *
     * @return Widget
     */
    public function getWidget();

    /**
     * Set widget
     * @param string $widget
     *
     * @return $this
     */
    public function setWidget($widget);
}
