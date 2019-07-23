# REST_API_PROJECT
Procedures For Use. 

1, The application is to be  downloaded from git at the address stated below
https://github.com/samtechelectronics/REST_API_PROJECT.git

2, once the application have been download , a command prompt terminal is opened at the location where the application was saved.
3. the following command should be entered 
composer install 
php artisan migrate
this is to migrate the tables to the database
php artisan passport:client --password
php artisan db:seed
php artisan serve
4. the application has the following routes which can be tested with POSTMAN
/register    
this a post API where a user can be registered on the system.
it accepts JSON.  in this format   {
      
      "email": "email.com",
    "username" : "name",
    "password": "pass"
}
if the details provided are valid it save and create the new user.

/oauth/token  

a post API that Authenticate a user. Expected Json Format
{
      "grant_type": "password",
         "client_id": "2",
      "client_secret": "vHwc9aj0f7QbkQ7KiJiEhKW7E4rmTMozgl14CPk0", // this is gotten from the client table 
    "username" : "samueleke71@gmail.com",
    "password": "samuel2323"
}


An aithentication Secret is generated for the User, this Secret is Used in all request to Authenticate the User.
A Test part has been created .

/user                   GET
using  a get request this returns the User Data

/user/{user_id}                  UPDATE

this is used to update a username , the expected JSON is
{ "username" : "the new name" }



/user/{user_id}                  Delete  

this route is used to delete a user.