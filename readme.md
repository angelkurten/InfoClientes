Pasos para instalar:

Configurar la base datos

Ejecutar comandos:

composer update

npm install

php artisan migrate --seed

Para hacer login:

Usuario: angelkurten@hotmail.com

Contaseña: 1234



+--------+-----------+------------------------+------------------+------------------------------------------------------------------------+--------------+ 
| Domain | Method    | URI                    | Name             | Action                                                                 | Middleware   | 
+--------+-----------+------------------------+------------------+------------------------------------------------------------------------+--------------+ 
|        | GET|HEAD  | /                      |                  | Closure                                                                | web          | 
|        | GET|HEAD  | api/cities             | cities.index     | App\Http\Controllers\Api\CityController@index                          | api          | 
|        | GET|HEAD  | api/cities/{city}      | cities.show      | App\Http\Controllers\Api\CityController@show                           | api          | 
|        | POST      | api/clients            | clients.store    | App\Http\Controllers\Api\ClientsController@store                       | api          | 
|        | GET|HEAD  | api/clients            | clients.index    | App\Http\Controllers\Api\ClientsController@index                       | api          | 
|        | GET|HEAD  | api/clients/{client}   | clients.show     | App\Http\Controllers\Api\ClientsController@show                        | api          | 
|        | PUT|PATCH | api/clients/{client}   | clients.update   | App\Http\Controllers\Api\ClientsController@update                      | api          | 
|        | DELETE    | api/clients/{client}   | clients.destroy  | App\Http\Controllers\Api\ClientsController@destroy                     | api          | 
|        | GET|HEAD  | api/countries          | countries.index  | App\Http\Controllers\Api\CountryController@index                       | api          | 
|        | GET|HEAD  | api/sellers            | sellers.index    | App\Http\Controllers\Api\SellerController@index                        | api          | 
|        | GET|HEAD  | api/states/{state}     | states.show      | App\Http\Controllers\Api\StateController@show                          | api          | 
|        | GET|HEAD  | api/user               |                  | Closure                                                                | api,auth:api | 
|        | POST      | api/visits             | visits.store     | App\Http\Controllers\Api\VisitController@store                         | api          | 
|        | GET|HEAD  | api/visits             | visits.index     | App\Http\Controllers\Api\VisitController@index                         | api          | 
|        | DELETE    | api/visits/{visit}     | visits.destroy   | App\Http\Controllers\Api\VisitController@destroy                       | api          | 
|        | PUT|PATCH | api/visits/{visit}     | visits.update    | App\Http\Controllers\Api\VisitController@update                        | api          | 
|        | GET|HEAD  | api/visits/{visit}     | visits.show      | App\Http\Controllers\Api\VisitController@show                          | api          | 
|        | GET|HEAD  | clients/{client}       | client.show      | App\Http\Controllers\ClientController@show                             | web,auth     | 
|        | GET|HEAD  | home                   | home             | App\Http\Controllers\HomeController@index                              | web,auth     | 
|        | GET|HEAD  | login                  | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    | 
|        | POST      | login                  |                  | App\Http\Controllers\Auth\LoginController@login                        | web,guest    | 
|        | POST      | logout                 | logout           | App\Http\Controllers\Auth\LoginController@logout                       | web          | 
|        | POST      | password/email         | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    | 
|        | GET|HEAD  | password/reset         | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    | 
|        | POST      | password/reset         | password.update  | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    | 
|        | GET|HEAD  | password/reset/{token} | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    | 
|        | GET|HEAD  | register               | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    | 
|        | POST      | register               |                  | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    | 
+--------+-----------+------------------------+------------------+------------------------------------------------------------------------+--------------+ 