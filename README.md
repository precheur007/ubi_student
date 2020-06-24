################################################################################
############################### API UBI STUDENT ################################
################################################################################
** Environment : PHP 7.1 / MySQL 5.7.11
*
** 0/ DESCRIPTION : API UBI Student is an API that offer you to manage Students with their grades and the linked subjects.
This api used API Platform which used mature and stable api standards.


** 1/ How to install : 
* Launch in bash commandline : 
> composer install
Create database as 'ubi_student' then run the migration with command :
> php bin/console doctrine:migrations:migrate

You may want to populate your database with data test. If so, launch the command : 
> php bin/console doctrine:fixtures:load -n

* Copy .env file in root directory as .env.local : edit this file and replace the last line with your MySQL access identifiers as follow : 
DATABASE_URL=mysql://root:@127.0.0.1:3306/ubi_student?serverVersion=5.7
.env.local file is not commited and you must use it only to work with your local environment

Start web server with command : 
> symfony serve -d

** 2/ Access to API
For an api documentation see : https://127.0.0.1:8001/api
API is protected by the Symfony Guard authentication system.
An User entity is used to provide credentials to authentify and allow access to the API's users.
A user identifier has already ben added in database by fixtures : 
- apiKey: test_api_key
- username: test
- password: test

** 3/ An admin interface is enable to manage student, grades, subjects and the users (for granted access to API) 
* Access to admin interface : https://127.0.0.1:8001/admin
This access is secured so you need to type login/password : admin/admin

** 4/ Run functional tests
Run : ./bin/phpunit


PROBLEM : 

1/ I couldn't have solved a problem with several functionnal tests.
2/ There is an error on the api to get the classroom average grades (api/students/all/avggrades) and the error is really not clear : 
{
  "@context": "/api/contexts/Error",
  "@type": "hydra:Error",
  "hydra:title": "An error occurred",
  "hydra:description": "Not Found",
  "trace": [
    {
      "namespace": "",
      "short_class": "",
      "class": "",
      "type": "",
      "function": "",
      "file": "C:\\Users\\BlackJack\\Documents\\Travail\\UBITransport\\api_student\\vendor\\api-platform\\core\\src\\EventListener\\ReadListener.php",
      "line": 116,
      "args": []
    },
	{ .. }
	]
}

I never practive Symfony 4.4 since few days. I have worked on many projects from Symfony 2 to 3.4. 
For this test I wanted to do it with your new stack you have chosen and for my personal knowledges. I will try to solve my issues anyway :-)