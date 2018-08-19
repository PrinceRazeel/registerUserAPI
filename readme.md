# Register User API

## How to use this project
------------------------------------------------
### Installation

- in your local environment create a database named reguser_db
- import the reguser_db.sql file included in the project to your newly created database
- also feel free to use your own DB if its identitical, make sure to change the parameters in the database configuration file
- database configuration file can be found in Database>config.php


------------------------------------------------
### Consuming the API

- I Recommend using `Postman` for testing the API.
- First of all go to `/api/authenticate` endpoint, inititate a POST request with a header of `Content-Type: application/json` and a body of:
```
{
	"name": "zain"
}
```
- It will return a JWT token, copy the token for use in creating a user
- Initiate a POST request to `/api/create` endpoint, with headers of `Content-Type: application/json` and `Authorization: "use the JWT you copied here" ` and with a body of:
```
{
"name": "example name",
"email": "example email",
"age": 11
}
```
- If you wish to view current users in the database, make a GET request to the `/api/userindex` endpoint