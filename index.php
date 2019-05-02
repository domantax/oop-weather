<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Weather\Controller\StartPage;

$request = Request::createFromGlobals();

$loader = new FilesystemLoader('View', __DIR__ . '/src/Weather');
$twig = new Environment($loader, ['cache' => __DIR__ . '/cache', 'debug' => true]);

$controller = new StartPage();

switch ($request->getRequestUri()) {
    case '/week':
        $renderInfo = $controller->getWeekWeather('dbData');
        break;
    case '/google/today':
        $renderInfo = $controller->getTodayWeather('googleApi');
        break;
    case '/google/week':
        $renderInfo = $controller->getWeekWeather('googleApi');
        break;
    case '/db/today':
        $renderInfo = $controller->getTodayWeather('dbWeather');
        break;
    case '/':
    default:
        $renderInfo = $controller->getTodayWeather('dbData');
    break;
}
$renderInfo['context']['resources_dir'] = 'src/Weather/Resources';

$content = $twig->render($renderInfo['template'], $renderInfo['context']);

$response = new Response(
    $content,
    Response::HTTP_OK,
    array('content-type' => 'text/html')
);
$response->send();
