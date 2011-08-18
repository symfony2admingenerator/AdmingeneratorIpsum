# AdmingeneratorIpsum

This is a symfony2 project to show you how work the Symfony2 admingenerator
https://github.com/cedriclombardot/Admingenerator

# How to install

Run in your schell the nexts commands lines

```
./bin/vendors install
./rebuild.sh
```
# Dependencies

You should have to install :

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


