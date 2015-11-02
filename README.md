*Deprecated* - You'd better use the friendsofvictoire/form-widget
============

Victoire DCMS Simple Contact Form Bundle
-------------

##What is the purpose of this bundle

This bundle gives you access to the *Simple Contact Form Widget*.
With this widget, you can install a header menu, footer menu, or a menu directly on a page.

##Set Up Victoire

If you haven't already, you can follow the steps to set up Victoire *[here](https://github.com/Victoire/victoire/blob/master/setup.md)*

##Install the Simple Contact Form Bundle :

Run the following composer command :

    php composer.phar require friendsofvictoire/simplecontactform-widget

###Reminder

Do not forget to add the bundle in your AppKernel !

    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                ...
                new Victoire\Widget\SimpleContactForm\VictoireSimpleContactFormBundle(),
            );

            return $bundles;
        }
    }
