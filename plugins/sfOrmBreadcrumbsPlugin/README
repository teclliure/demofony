# sfOrmBreadcrumbs plugin (for symfony 1.3/1.4) #

The `sfOrmBreadcrumbsPlugin` is a symfony plugin that provides easy breadcrumbs
integration and configuration for your project application.

It consists of two modules, one for projects using Propel and the other one for projects using Doctrine.

## Installation ##

  * Download the package and place it in your project root.

  * Install the plugin
    
        symfony plugin:install sfOrmBreadcrumbsPlugin-1.0.5.tgz

  * Activate the plugin in the `config/ProjectConfiguration.class.php`
  
        [php]
        class ProjectConfiguration extends sfProjectConfiguration
        {
          public function setup()
          {
            $this->enablePlugins(array(
              '...',
              'sfOrmBreadcrumbsPlugin',
              '...'
            ));
          }
        }

  * Enable the module for your orm in your `settings.yml`
    * For Propel

            all:
              .settings:
                enabled_modules:      [default, sfPropelBreadcrumbs]

    * For Doctrine

            all:
              .settings:
                enabled_modules:      [default, sfDoctrineBreadcrumbs]

  * Add the component to the template you want the breadcrumbs to show in:
    * For Propel

            [php]
            include_component('sfPropelBreadcrumbs', 'breadcrumbs');

    * For Doctrine
        
            [php]
            include_component('sfDoctrineBreadcrumbs', 'breadcrumbs');

  * Clear you cache

        symfony cc


### Breadcrumbs configuration ###

The plugin parses breadcrumbs configuration from a `breadcrumbs.yml` in your application config folder.

  * Copy `breadcrumbs.yml` sample

        cp plugins/sfOrmBreadcrumbsPlugin/config/breadcrumbs.yml.sample apps/<application_name>/config/breadcrumbs.yml

  * Here's the sample configuration, I will deeply explain how it works:

        sf_orm_breadcrumbs:
          main:
            index:
              - { name: Home, route: homepage }
          blog:
            index:
              - { name: Blog, route: blog }
            showPost:
              - { name: Blog, route: blog }
              - { name: %title%, route: post_show, model: true }
            permalink:
              - { name: 'Archive' }
              - { name: %Post%, route: post_show, model: true, subobject: Post }
  
  * Place the breadcrumbs config root element first in your file:

        sf_orm_breadcrumbs:

  * The configuration tree follows the module/action logic. In this example I have two modules, `main` and `blog`,
    but you can add all the modules you need the breadcrumbs for:

        sf_orm_breadcrumbs:
          main:
            ...
          blog:
            ...

  * Let's take a look at `blog` module. I provided breadcrumbs for three actions, `index`, `showPost` and `permalink`.
    * `index` has the simplest configuration. It tells the plugin to show just one breadcrumb with name "Blog" and
      linked to the route "blog", which is a `sfRoute` object.
 
            blog:
              index:
                - { name: 'Blog', route: blog }

    * `showPost` is a little more complex. It consists of two breadcrumbs; the first is identical to the `index` one, 
      but the second tells the plugin to show a breadcrumb for a `sfDoctrineRoute` object. You can set this by 
      adding the `model` parameter to the breadcrumb element. More, you can set the name of the breadcrumb by
      taking a property from the model object the route is bound to.

      Example: if I have this routing rule...
      
            post_show:
              url:   /blog/post/:date_slug/:slug.:sf_format
              class: sfDoctrineRoute
              options: { model: Post, type: object }
              param: { module: blog, action: showPost, sf_format: html }
              requirements:
                slug: '[\w-]+'
                sf_method: [get]

      ...and I can write this...

            [php]
            $post = new Post();
            $post->setTitle('My title');
            echo $post->getTitle();  // 'My title'

      ...then I can set as name of my breadcrumb the "title" property of my Post object, by putting it within
        percent signs:

            - { name: %title%, route: post_show, model: true }

    * What if you are in a `sfDoctrineRoute` rule action and you want to point your breadcrumb to a rule for another
      model object? Let's take a look at the second `permalink` breadcrumb:
      
            - { name: %Post%, route: post_show, model: true, subobject: Post }

     Now, my current routing rule is this one:
     
            post_permalink:
              url:   /archive/:year/:month/:day/:slug.:sf_format
              class: sfDoctrineRoute
              options: { model: Permalink, type: object }
              param: { module: blog, action: permalink, sf_format: html }
              requirements:
                sf_method: [get]

     My route object is a Permalink object, but if I can write this...
 
            [php]
            $permalink = new Permalink();
            $permalink->getPost(); //fetch original post

     ...then I can tell the plugin to create a breadcrumb that takes a subobject (a Post) via class method
     from my rule object (the Permalink) and link it to a `sfDoctrineRoute` suitable for the subobject.
     
NOTE: considerations and examples so far are equivalent and valid also with `sfPropelRoute` objects. It does not change anything.

### Optional configuration ###

The following parameters are not mandatory, they just tweak some stuff for a better customization of your breadcrumbs.

  * Root breadcrumb. You can specify a breadcrumb to always show before the context ones.
  This breadcrumb work in the exact same way as the others, but it can't be used for model bound routing rules.
  You can make a simple text appear before the other breadcrumbs this way:
      
        sf_orm_breadcrumbs:
          _root: { name: My site }

  or you can even decide to point your root breadcrumb to your homepage, like this:

        sf_orm_breadcrumbs:
          _root: { name: Homepage, route: homepage }

  * Custom separator. The default separator character for the breadcrumb is '`>`'.
  To set a custom character:

        sf_orm_breadcrumbs:
          _separator: '&raquo;'

  * Custom i18n catalogue. The default i18n catalogue for the breadcrumb is '`breadcrumb`'.
  To set i18n catalogue:

        sf_orm_breadcrumbs:
          _i18n_catalogue: 'breadcrumb'

  * Lost text. If your configuration do not provide breadcrumbs for an action you are in, this text
  is displayed instead. Default text is '`somewhere`'. To set a custom text:

        sf_orm_breadcrumbs:
          _lost: 'somewhere...'
          
  * Default case manipulation for breadcrumb name. You can set a php function name to manipulate the breadcrumbs name with.
  You can choose among `ucfirst`, `lcfirst`, `strotolower`, `strtoupper`, `ucwords`.
  You can even override this default setting by providing `case` option for a breadcrumb item, in the configuration file.

        sf_orm_breadcrumbs:
          _default_case: ucfirst
