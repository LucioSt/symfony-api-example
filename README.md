<<<<<<< HEAD
# RESTful
A RESTful API using Symfony 3

## Prerequisites

For this project we installed:

	* Symfony 3
	* Apache 2.4.17
	* PHP 7.0
	* MySQL  5.6


## Implementation Details


2) Using bundles: 	

       * FOSRestBundle
       * JMSSerializerBundle
       * NelmiCorsBundle


## Example


* GET 

You can either use _curl_ from a terminal:

To get all users:

     curl -X GET http://localhost:8000/user 
				
ou can perform a similar GET request but this time requesting the data of a specific user using his id.
Go to _http://localhost:8000/user/2_ in your browser. You should see something like this:

     curl -X GET http://localhost:8000/user/{id} 
				
ou can perform a similar GET request but this time requesting the data of a specific customer using his id.
Go to _http://localhost:8000/Customer/2_ in your browser. You should see something like this:


* POST

You can use POST request to populate Customer table with more entries. Order the  following _curl_ command from a terminal (POST message body will be sent in json format):

        
    curl -i -H "Content-Type: application/json" -X POST -d '{  "name": "Pedro",  "role": "developer" }' http://localhost:8000/user/new

If everything worked properly you should have received a response code 200 (seen in your terminal). You should also see a "User Added Successfully in your terminal". 


* PUT

We'll try to update one of the existing user entries. Suppose that you are willing to change the entry with id = 2 by replacing its current name with a new one:

    curl -i -H "Content-Type: application/json" -X PUT -d '{  "name": "Jose",  "role": "manager" }' http://localhost:8000/user/2
    
 If everything worked properly you should have seen a response code 200 along with a "User Updated Successfully" message. 
 

 
* DELETE

Now it's time to delete an entry using HTTP requests. For this to work you must send a DELETE request. Assuming you want to delete the user with id = 2  you should order the following _curl_ command:

    curl -X DELETE http://localhost:8000/user/2
    
If the deletion worked properly you should see a "deleted successfully" message. Again, 

