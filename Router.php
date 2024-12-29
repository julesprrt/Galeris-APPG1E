<?php

require_once('Controller/UserController.php'); //  UserController
require_once('Database/Database.php'); //  Database 类

class Router {
    protected $routes = [];

    /**
     * Enregistrer dans le tableau le controller + la méthode dédiée à la route
     * @param string $route
     * @param string $controller
     * @param string $action
     */
    public function addRoute($route, $controller, $action) {
        $this->routes[$route] = ['controller' => $controller, 'action' => $action];
    }

    /**
     * Appel au controller à partir de l'uri
     * @param string $uri
     * @throws \Exception
     */
    public function dispatch($uri) {
        $uri = strtok($uri, '?'); // Supprimer les paramètres GET
        if (array_key_exists($uri, $this->routes)) {
            $controllerName = $this->routes[$uri]['controller'];
            $actionName = $this->routes[$uri]['action'];

            // Vérifier si le controller existe
            if (!class_exists($controllerName)) {
                throw new \Exception("Controller non trouvé: $controllerName");
            }

            $controller = new $controllerName();

            // Vérifier si l'action existe dans le controller
            if (!method_exists($controller, $actionName)) {
                throw new \Exception("Action non trouvée: $actionName dans le controller $controllerName");
            }

            // Appeler l'action avec la base de données
            $controller->$actionName(new Database());
        } else {
            throw new \Exception("Route non trouvée: $uri");
        }
    }
}
