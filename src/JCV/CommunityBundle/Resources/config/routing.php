<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();
//CUSTOM ROUTES
$collection->add('c_homepage', new Route('/', array(
    '_controller' => 'CommunityBundle:Home:index',
)));

//DEFAULT ROUTING LIKE REST API
$routes = [
    [
        "bundle" => "CommunityBundle",
        "name" => "Blog"
    ]
];
foreach($routes as $route){
    $name = $route['name'];
    $n = strtolower($name);
    $bundle = $route['bundle'];
    $b = strtolower($bundle);
    $collection->add($b.'_'.$n.'_view_all',new Route('/'.$n.'/',array(
        '_controller' => $bundle.':'.$name.':viewAll',
    ),array(),array(),'',array(),array('GET')));
    $collection->add($b.'_'.$n.'_view_one',new Route('/'.$n.'/{id}',array(
        '_controller' => $bundle.':'.$name.':viewOne',
    ),array(),array(),'',array(),array('GET')));
    $collection->add($b.'_'.$n.'_api_post',new Route('api/'.$n.'/',array(
        '_controller' => $bundle.':'.$name.':post',
    ),array(),array(),'',array(),array('POST')));
    $collection->add($b.'_'.$n.'_api_get_all',new Route('api/'.$n.'/',array(
        '_controller' => $bundle.':'.$name.':getAll',
    ),array(),array(),'',array(),array('GET')));
    $collection->add($b.'_'.$n.'_api_get_one',new Route('api/'.$n.'/{id}',array(
        '_controller' => $bundle.':'.$name.':getOne',
    ),array(),array(),'',array(),array('GET')));
    $collection->add($b.'_'.$n.'_api_put',new Route('api/'.$n.'/{id}',array(
        '_controller' => $bundle.':'.$name.':put',
    ),array(),array(),'',array(),array('PUT')));
    $collection->add($b.'_'.$n.'_api_delete',new Route('api/'.$n.'/{id}',array(
        '_controller' => $bundle.':'.$name.':delete',
    ),array(),array(),'',array(),array('DELETE')));
}
return $collection;