<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();
//CUSTOM ROUTES
$collection->add('c_homepage', new Route('/',
    array(
    '_controller' => 'CommunityBundle:Home:index',
    )
));

//DEFAULT ROUTING LIKE REST API
$routes = [
    [
        "bundle" => "CommunityBundle",
        "name" => "Blog"
    ]
];
foreach($routes as $route){
    $Name = $route['name'];
    $n = strtolower($Name);
    $Bundle = $route['bundle'];
    $b = strtolower($Bundle);
    $collection->add($b.'_'.$n.'_view_all',new Route('/'.$n.'/',array(
        '_controller' => $Bundle.':'.$Name.':viewAll',
    ),array(),array(),'',array(),array('GET')));
    $collection->add($b.'_'.$n.'_view_one',new Route('/'.$n.'/{id}',array(
        '_controller' => $Bundle.':'.$Name.':viewOne',
    ),array(),array(),'',array(),array('GET')));
    $collection->add($b.'_'.$n.'_api_post',new Route('api/'.$n.'/',array(
        '_controller' => $Bundle.':'.$Name.':post',
    ),array(),array(),'',array(),array('POST')));
    $collection->add($b.'_'.$n.'_api_get_all',new Route('api/'.$n.'/',array(
        '_controller' => $Bundle.':'.$Name.':getAll',
    ),array(),array(),'',array(),array('GET')));
    $collection->add($b.'_'.$n.'_api_get_one',new Route('api/'.$n.'/{id}',array(
        '_controller' => $Bundle.':'.$Name.':getOne',
    ),array(),array(),'',array(),array('GET')));
    $collection->add($b.'_'.$n.'_api_put',new Route('api/'.$n.'/{id}',array(
        '_controller' => $Bundle.':'.$Name.':put',
    ),array(),array(),'',array(),array('PUT')));
    $collection->add($b.'_'.$n.'_api_delete',new Route('api/'.$n.'/{id}',array(
        '_controller' => $Bundle.':'.$Name.':delete',
    ),array(),array(),'',array(),array('DELETE')));
}
return $collection;