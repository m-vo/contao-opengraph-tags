contao-opengraph-tags
=====================
This bundle adds OpenGraph meta tags to pages in Contao Open Source CMS.
    
        
Installation
------------

#### Step 1: Download the Bundle  

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require mvo/contao-opengraph-tags
```

#### Step 2: Enable the Bundle

**Skip this point if you are using a *Managed Edition* of Contao.**

Enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new \Mvo\ContaoOpenGraphTags\MvoContaoOpenGraphTagsBundle(),
        );

        // ...
    }

    // ...
}
```
 
Use the Bundle
--------------

OpenGraph tags can be enabled foreach page root in the backend. If enabled
``<og>`` tags are generated in the head section that among others will output
the page title, page description if set or one ore more images. Images can be
selected for each page and apply for all child pages that have no images set.