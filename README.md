FunddyJsCrossDomainBundle
=========================

[![Build Status](https://secure.travis-ci.org/funddy/jscrossdomain-bundle.png?branch=master)](http://travis-ci.org/funddy/jscrossdomain-bundle)

This bundle enables you to make cross domain requests with Javascript.

Setup and Configuration
-----------------------

Add the following to your composer.json file:
```json
{
    "require": {
        "funddy/jscrossdomain-bundle": "1.0.*"
    }
}
```

Update the vendor libraries:

    curl -s http://getcomposer.org/installer | php
    php composer.phar install

Register the Bundle FunddyJsCrossDomainBundle in app/AppKernel.php.
```php
// ...
public function registerBundles()
{
    $bundles = array(
        // ...
        new Funddy\Bundle\JsCrossDomainBundle\FunddyJsCrossDomainBundle()
        // ...
    );
    // ...
}
```

Include cross domain route at app/config/routing.yml
```yaml
cross_domain:
    resource: "@FunddyJsCrossDomainBundle/Resources/config/routing.yml"
```

Usage
-----
Configure allowed cross domain URLs at app/config/config.yml
```yaml
funddy_js_cross_domain:
    allowed:
        - http://graph.facebook.com/?ids=
```

Make cross domain request
```html
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
<script src="{{ asset('bundles/funddyjscrossdomain/js/lib/funddycrossdomain.js') }}"></script>
<script>
    var cd = new FUNDDY.CrossDomain($);
    cd.get("http://graph.facebook.com/?ids=https://funddy.com").done(function(response) {
        console.log(response);
    });
</script>
```
