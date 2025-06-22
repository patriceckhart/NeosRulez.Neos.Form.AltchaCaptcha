# ALTCHA Next-Gen CAPTCHA Integration for Neos CMS

A Neos CMS package that integrates [ALTCHA CAPTCHA](https://altcha.org/de/) into the Neos CMS Form Builder.

## Installation

Just run:

```
composer require neosrulez/neos-form-altchacaptcha
```

## Configuration

```yaml
NeosRulez:
  Neos:
    Form:
      AltchaCaptcha:
        view:
          hideAltchaLogo: false
          hideFooter: false
          auto: disabled
        security:
          minNumber: 5000
          maxNumber: 15000
          hmac: 3f4bb586f04a0c1d93eadab9363a8a3183b4860c # hmac string
          expires: 1200 # challenge expires in 1200 seconds
```

## Author

* E-Mail: mail@patriceckhart.com
* URL: http://www.patriceckhart.com 
