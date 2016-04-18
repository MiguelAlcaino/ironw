Articles API for Iron Web
====================
Solution for the test given to Miguel Alcaino by Iron Web. This Symfony2 Project has a REST API to handle request related to Articles.

**REQUIREMENTS**
 - Composer (getcomposer.org)
 - PHP >=5.6 (required by the last version of PHPUnit)
 - PHP Unit ~5.3

**INSTALLATION**
- `composer install`
- `php app/console doctrine:schema:create`
- `php app/console doctrine:schema:update --force`

**USAGE**
In order to have a virtual server running with the project it is needed to execute the following command to enable the virtual server:
- `php app/console server:run`
After that the webserver is going to be running in http://localhost:8000

***View to Add an article***
 - Go to http://localhost:8000/articles/new to add a new article.

***Command to send notifications***
 - To send notifications about answers older than 24 hours to the authors of the articles, execute: `php app/console ironweb:notifications`

**API DOC**
The api documentation can be visited in http://localhost:8000/api/doc

**UNIT TESTS**
Some test have been written to test the responses from the REST API. The tests can be executed with:

    phpunit -c app