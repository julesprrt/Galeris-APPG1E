<?php

class Router {
    protected $routes = [];
    /**
     * Summary of addRoute
     * @param mixed $route
     * @param mixed $controller
     * @param mixed $action
     * @return void
     * Enregistrer dans le tableau le controller + la méthode dédié a la route
     */
    public function addRoute($route, $controller, $action) {
        $this->routes[$route] = ['controller' => $controller, 'action' => $action];
    }

    /**
     * Summary of dispatch
     * @param mixed $uri
     * @throws \Exception
     * @return void
     * Appel au controller à partir de l'uri (uri qui est l'indice du tableau pour recuperer son controller
     * et son action)
     */
    public function dispatch($uri) {
        if (array_key_exists($uri, $this->routes)) {
            $controller = $this->routes[$uri]['controller'];
            $action = $this->routes[$uri]['action'];

            $controller = new $controller();
            $controller->$action(new Database());
        } else {
            throw new \Exception("Route non trouvé: $uri");
        }
    }
}
/**connection router */
$router = new Router();
$router->addRoute('/login', 'UserController', 'connexion');