# ALTCHA Next-Gen CAPTCHA integration for Neos CMS

A Neos CMS package that integrates ALTCHA CAPTCHA into the Neos CMS Form Builder.

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
          auto: false
        security:
          minNumber: 5000
          maxNumber: 15000
          hmac: 1742225261 # hmac int
          expires: 1200 # challenge expires in 1200 seconds
```

## Author

* E-Mail: mail@patriceckhart.com
* URL: http://www.patriceckhart.com 
