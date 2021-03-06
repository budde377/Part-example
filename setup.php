<?php
/**
 * Created by PhpStorm.
 * User: budde
 * Date: 2/16/15
 * Time: 12:58 PM
 */


@include 'vendor/autoload.php';
@include 'local.php';

if(file_exists('site-config.xml')){
    $siteConfig = simplexml_load_file('site-config.xml');
} else if (file_exists('site-config.xml.dist')){
    $siteConfig = simplexml_load_file('site-config.xml.dist');
} else{
    die;
}
$config = new ChristianBudde\Part\ConfigImpl($siteConfig, '../');
$factory = isset($factory) ? $factory : new ChristianBudde\Part\SiteFactoryImpl($config);
$pageOrder = $factory->buildBackendSingletonContainer($config)->getPageOrderInstance();
$page = $pageOrder->createPage('home');
$page->setTitle('First page');
$page->setTemplate('Test page');
$pageOrder->setPageOrder($page, 0);
$page->getContent('main')->addContent(' <h1>
                Congrats!
            </h1>

            <p>
                You have successfully set up the Part example!<br/>
                How about logging in? Go to the <a href="/login">login page</a>.
            </p>');