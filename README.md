# oop-example

Routes:

`/` - data from Data.json  
`/week` - data from Data.json  
`/db/today` - data from Weather.json(all dates in this file older than current day - so app renders NullWeather -> 
with date 1970/01/01)  
`/db/week` - data from Weather.json(renders empty page -> all dates are older than current)  
`/google/today` - data from imaginary GoogleApi (rendered in GoogleApi.php)  
`/google/week` - data from imaginary GoogleApi

About App:  
*   index.php responsible for routing and instantiating controller
*   StartPage.php controller with two methods!
*   Manager.php responsible for managing data from all sources  (Data.json, Weather.json, GoogleApi.php)
*   All data sources implements DataProvider Interface - to maintain same data flow
*   DbDataRepository and DbWeatherRepository extends AbstractDb class
*   AbstractDb class implements DataProviderInterface








Run:
composer install

Then you can open index.php


**Help:**
- https://www.php.net/manual/en/language.oop5.php
- https://twig.symfony.com/doc/2.x/
  - https://twig.symfony.com/doc/2.x/intro.html
- https://symfony.com/doc/current/components/http_foundation.html
  - https://symfony.com/doc/current/components/http_foundation.html#request
  - https://symfony.com/doc/current/components/http_foundation.html#response
- https://getcomposer.org/doc/
  - https://getcomposer.org/download/
  - https://getcomposer.org/doc/03-cli.md#install-i
