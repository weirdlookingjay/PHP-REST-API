<?php

class TaskController
{
    public function __construct(private TaskGateway $gateway) {}

    public function processRequest(string $method, ?string $id):void {
        if ($id === null) {
            if ($method == "GET") {
                echo json_encode($this->gateway->getAll());
            } elseif ($method == "POST") {
                echo "create";
            } else {
                $this->responseMethodNotAllowed("GET, PATCH, DELETE");
            }
        } else {
            switch ($method) {
                case "GET":
                    echo "show $id";
                    break;
                case "PATCH":
                    echo "update $id";
                    break;
                case "DELETE":
                    echo "delete $id";
            }
        }
    }

    private function responseMethodNotAllowed(string $allowed_methods): void {
        http_response_code(405);
        header("Allow: $allowed_methods");
    }
}
