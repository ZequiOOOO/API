<?php
    class Router {
        private array $routes;

        public function __construct() {
            $this->routes = [
                'GET' => [
                    '/usuarios' => [
                        'controller' => 'UsuarioController',
                        'function' => 'getUsuarios'
                    ],
                    '/status' => [
                        'controller' => 'StatusController',
                        'function' => 'getStatus'
                    ],
                    '/produtos' => [
                        'controller' => 'ProdutoController',
                        'function' => 'getProdutos'
                    ],
                    '/pedidos' => [
                        'controller' => 'PedidoController',
                        'function' => 'getPedidos'
                    ],
                  
                ],
                'POST' => [
                    '/usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'createUsuario'
                    ],
                    '/cadastrar-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'createUsuario'
                    ],
                    '/criar-status' => [
                        'controller' => 'StatusController',
                        'function' => 'createStatus'
                    ],
                    '/produtos' => [
                        'controller' => 'ProdutoController',
                        'function' => 'createProduto'
                    ],
                    '/cadastrar-produtos' => [
                        'controller' => 'ProdutoController',
                        'function' => 'createProduto'
                    ],
                    '/criar-itens-pedidos' => [
                        'controller' => 'ItemPedidosController',
                        'function' => 'createItemPedido'
                    ],
                    '/item-pedido' => [
                        'controller' => 'ItemPedidosController',
                        'function' => 'getItensPedido'
                   
                    ],
                    '/cadastrar-pedido' =>[
                        'controller' => 'PedidoController',
                        'function' => 'createPedido'
                    ],
                    '/pedido-pessoa' => [
                        'controller' => 'PedidoController',
                        'function' => 'getPedidosPessoa'
                    ],
                    '/valor-total-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'getValorTotalPedido'
                    ]
                ],
                'PUT' => [
                    '/atualizar-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'updateUsuario'
                    ],
                    '/atualizar-produto' => [
                        'controller' => 'ProdutoController',
                        'function' => 'updateProduto'
                    ],
                    '/atualizar-item-pedido' => [
                        'controller' => 'itemPedidosController',
                        'function' => 'updateItemPedido' 
                    ],
                    '/atualizar-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'updatePedido' 
                    ],
                    '/atualizar-status-pedido' => [
                        'controller' => 'statusPedidoController',
                        'function' => 'updateStatusPedido' 
                    ]
                ],
                'DELETE' => [
                    '/excluir-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'deleteUsuario'
                    ],
                    '/excluir-produto' => [
                        'controller' => 'ProdutoController',
                        'function' => 'deleteProduto'
                    ],
                    '/excluir-item-pedido' => [
                        'controller' => 'itemPedidosController',
                        'function' => 'deleteitemPedido'
                    ],
                    '/excluir-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'deletePedido'
                        
                    ]

                ]
            ];
        }

        public function handleRequest(string $method, string $route): string {
            $routeExists = !empty($this->routes[$method][$route]);

            if (!$routeExists) {
                return json_encode([
                    'error' => 'Essa rota não existe!',
                    'result' => null
                ]);
            }

            $routeInfo = $this->routes[$method][$route];

            $controller = $routeInfo['controller'];
            $function = $routeInfo['function'];

            require_once __DIR__ . '/../controllers/' . $controller . '.php';

            return (new $controller)->$function();
        }
    }
?>