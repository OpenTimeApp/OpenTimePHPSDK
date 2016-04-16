# OpenTimePHPSDK #
PHP SDK for OpenTime REST API

[https://app.opentimeapp.com/docs](https://app.opentimeapp.com/docs)

## How to use ##

        OpenTimeSDK::initService(' your api key here');

### For http requests that require user authentication details ###

		OpenTimeSDK::getService()->setPlainTextCredentials(1, ' Your password here ');

## How to contribute ##

If you are contributing to the project you will need to run this command

    git update-index --assume-unchanged tests/test_config.php

Then put your TESTING API key in tests/test_config.php. DO NOT put your live api key here!

    $opentime_api_config = array();

    $opentime_api_config['api_key'] = ' api key goes here';
    $opentime_api_config['server']  = '';

