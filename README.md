# AdmingeneratorIpsum ![project status](http://stillmaintained.com/cedriclombardot/AdmingeneratorIpsum.png)#

This is a symfony2 project to show you how work the Symfony2 admingenerator
https://github.com/cedriclombardot/AdmingeneratorGeneratorBundle

# How to install

Copy and configure your db connections in paramaters.ini

```
cp app/config/parameters.yml.sample app/config/parameters.yml
```

Run in your schell the nexts commands lines

```
wget http://getcomposer.org/composer.phar
php composer.phar install
./rebuild.sh
```

Note:  The default login/password is admin/admin

# Optionnal dependencies

##  Assetic

You could install sass and compass if you want to change css :

```shell
   sudo gem install compass # https://github.com/chriseppstein/compass
   sudo gem install sass
```

And probably to configure assetic :

```yaml
    filters:
        cssrewrite: ~
        sass:
            bin: /var/lib/gems/1.8/gems/sass-3.1.7/bin/sass
            compass: /var/lib/gems/1.8/gems/compass-0.11.5/bin/compass
```

##  Without assetic

Configure your config.yml to use the assetic less template

``` yaml
admingenerator_generator:
    base_admin_template: AdmingeneratorGeneratorBundle::base_admin_assetic_less.html.twig
admingenerator_user:
    login_template: AdmingeneratorGeneratorBundle::base_login_assetic_less.html.twig
```

# With DoctrineODM

You've to install pecl/mongo

```
pecl install mongo
```

And install mongodb server & clients package for your distribution


