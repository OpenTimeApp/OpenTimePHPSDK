# OpenTimePHPSDK #
PHP SDK for OpenTime REST API

[https://app.opentimeapp.com/docs](https://app.opentimeapp.com/docs)

## How to use ##

### Composer ###
Add the dependency to your composer.json

    "require": {
        "opentime/opentimesdk":"dev-master"
    }

Add the repository to your composer.json

    "repositories": [
          {
            "type": "package",
            "package": {
              "name": "opentime/opentimesdk",
              "version": "dev-master",
              "source": {
                "url": "https://github.com/OpenTimeApp/OpenTimePHPSDK.git",
                "type": "git",
                "reference": "master"
              }
            }
          }
        ]

Update composer on the command line

    composer update

After you have it installed you can start using the service like so

        OpenTimeSDK::initService(' your api key here ');

To obtain an API key please contact Josh Woodcock at josh.woodcock@opentimeapp.com

### For http requests that require user authentication details ###

		OpenTimeSDK::getService()->setPlainTextCredentials(1, ' Your password here ');

## How to contribute ##

If you are contributing to the project you will need to run this command

    git update-index --assume-unchanged tests/test_config.php

Then put your TESTING API key in tests/test_config.php. DO NOT put your live api key here!

    $opentime_api_config = array();

    $opentime_api_config['api_key'] = ' api key goes here ';
    $opentime_api_config['server']  = '';

## License

OpenTimePHPSDK is released under the MIT license. See LICENSE for details.