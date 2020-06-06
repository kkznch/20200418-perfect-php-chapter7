<?php

class Router
{
  protected $routes;

  public function __construct($definitions)
  {
    $this->routes = $this->compileRoutes($definitions);
  }

  /**
    * /users/:id/edit
    * tokens = [users, :id, edit]
    * tokens = [users, (?P<id>[^/]+), edit]
    * routes = [
    *   /users/(?P<id>[^/]+)/edit => [
    *     controller => 'users',
    *     action => 'edit',
    *   ],
    * ]
    **/
  public function compileRoutes($definitions)
  {
    $routes = [];

    foreach ($definitions as $url => $params) {
      $tokens = explode('/', ltrim($url, '/'));
      foreach ($tokens as $i => $token) {
        if (strpos($token, ':') === 0) {
          $name = substr($token, 1);
          $token = '(?P<' . $name . '>[^/]+)';
        }
        $tokens[$i] = $token;
      }

      $pattern = '/' . implode('/', $tokens);
      $routes[$pattern] = $params;
    }

    return $routes;
  }

  /**
   * path_info = /users/3/edit
   * routes = [
   *   /users/(?P<id>[^/]+)/edit => [
   *     controller => 'users',
   *     action => 'edit',
   *   ]
   * ]
   * params = [
   *   [
   *     controller => 'users',
   *     action => 'edit',
   *     0 => /users/3/edit,
   *     1 => 3,
   *     id => 3,
   *   ],
   * ]
   **/
  public function resolve($path_info)
  {
    if (substr($path_info, 0, 1) !== '/') {
      $path_info = '/' . $path_info;
    }

    foreach ($this->routes as $pattern => $params) {
      if (preg_match('#^' . $pattern . '$#', $path_info, $matches)) {
        $params = array_merge($params, $matches);

        return $params;
      }
    }

    return false;
  }
}
