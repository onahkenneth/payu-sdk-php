# SOAP API Samples

These examples are created to experiment with the PayU-MEA-PHP-SDK capabilities. Each examples are designed to demonstrate the default use-cases in each segment.

This sample project is a simple web app that you can explore to understand what each PayU APIs can do for you. Irrespective of how you installed your SDK, you should be able to get the samples running by following the instructions below:

## Viewing Sample Code
You can [view sample source codes here](). However, we recommend you run samples locally to get a better idea.

## Instructions

If you are running PHP 5.4 or greater, PHP provides a [ built-in support ]( http://php.net/manual/en/features.commandline.webserver.php) for hosting PHP sites.

Note: The root directory for composer based download would be `vendor` and for direct download it would be `payu-mea-sdk-php-master`. Please update the commands accordingly.

1. Run `php -f payu-mea-sdk-php-master/samples/index.php` from your project root directory.
2. This would host a PHP server at `localhost:5500`. The output should look something like this:
    
    ```
    <!-- Welcome to PayU MEA SDK PHP -- >
    PHP 5.6.32-1+ubuntu14.04.1+deb.sury.org+1 Development Server started at Fri Oct 27 18:36:50 2017
    Listening on http://localhost:5500
    Document root is /home/kenny/payu-dev/payu-mea-sdk/PHP/samples
    Press Ctrl-C to quit.
    ```
3. Open [http://localhost:5000/](http://localhost:5000/) in your web browser, and you should be able to see the sample dashboard.
4. You should see a sample dashboard page as shown below:
![Sample Web](https://raw.githubusercontent.com/netcraft-devops/payu-mea-sdk-php/master/samples/images/dashboard.png)

#### Configuration (Optional)

The sample comes pre-configured with test accounts but in case you need to try them against your account, you must
   * Update the [bootstrap.php](https://raw.githubusercontent.com/netcraft-devops/payu-mea-sdk-php/master/samples/bootstrap.php) file with your username, password and safekey.

## Alternative Options

There are two other ways you could run your samples, as shown below:

* #### Alternatives: LAMP Stack (All supported PHP Versions)

    * You could host the entire project in your local web server, by using tools like [MAMP](http://www.mamp.info/en/) or [XAMPP](https://www.apachefriends.org/index.html).
    * Once done, you could easily open the samples by opening the matching URL. For e.g.:
`http://localhost/payu-mea-sdk-php-master/samples/index.html`

* #### Alternatives: Running on console
    > Please note that there are few samples that requires you to have a working local server, to receive redirects when user accepts/denies PayU Redirect Payment Page

    * To run samples itself on console, you need to open command prompt, and direct to samples directory.
    * Execute the sample php script by using `php -f` command as shown below:
    ```
    php -f enterprise/payment/create-payment.php
    ```

    * The result would be as shown below:
    ![Sample Console](https://raw.githubusercontent.com/netcraft-devops/payu-mea-sdk-php/master/samples/images/console_output.png)

## More help
   * [API Reference](http://help.payu.co.za/display/developers)
   * [Reporting Issues / Feature Requests](http://github.com/netcraft-devops/payu-sdk-php/issues)
