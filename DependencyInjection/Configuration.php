<?php

namespace Victoire\Widget\SimpleContactFormBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('victoire_widget_simple_contact_form');

        $rootNode
            ->children()
            ->scalarNode('entity_class')->defaultValue('Victoire\\Widget\\SimpleContactFormBundle\\Entity\\WidgetSimpleContactFormMessage')->end()
            ->end()
            ->children()
            ->scalarNode('form_class')->defaultValue('Victoire\\Widget\\SimpleContactFormBundle\\Form\\WidgetSimpleContactFormMessageType')->end()
            ->end()
            ->children()
            ->scalarNode('form_action_route')->defaultValue('SimpleContactForm_Default_formSubmit')->end()
            ->end();

        return $treeBuilder;
    }
}
