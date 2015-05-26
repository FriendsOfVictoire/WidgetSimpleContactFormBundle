##Victoire DCMS Simple Contact Form Bundle
============

Need to add a simple contact form in your Victoire website ?

#Set Up Victoire

If you haven't already, you can follow the steps to set up Victoire *[here](https://github.com/Victoire/victoire/blob/master/setup.md)*

#Install the Simple Contact Form Bundle :

Run the following composer command :

    php composer.phar require friendsofvictoire/simplecontactform-widget

#Reminder

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
