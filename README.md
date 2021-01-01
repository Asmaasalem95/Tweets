

### Tweets
microblogging social network service on which users post and interact with messages known as "tweets". Users can post tweets and only the followers of them can see that tweets.


### Technologies
laravel Framework


### Prerequisites
Server Requirements
_Apatche server
_MYSql
_php 7.4
_Composer Dependency Manager https://getcomposer.org/download/

### Installation

`git clone https://github.com/Asmaasalem95/Tweets`


`composer install`

`change .env.example file to .env `

`set the db name in DB_DATABASE , db username in DB_USERNAME and db password in DB_PASSWORD `

`php artisan migrate`

### Test 

`php artisan test`

#### Apis
`api/register` => user registeration

`api/login` => login api user => generate user token

`api/tweets/store` => create tweet

`api/follow/{user_id}` => user follow another user

`api/time-line` => user 




