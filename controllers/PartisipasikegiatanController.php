<?php

namespace PHPMaker2022\project1;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class PartisipasikegiatanController extends ControllerBase
{
    // list
    public function list(Request $request, Response $response, array $args): Response
    {
        $args = $this->getKeyParams($args);
        return $this->runPage($request, $response, $args, "PartisipasikegiatanList");
    }

    // add
    public function add(Request $request, Response $response, array $args): Response
    {
        $args = $this->getKeyParams($args);
        return $this->runPage($request, $response, $args, "PartisipasikegiatanAdd");
    }

    // view
    public function view(Request $request, Response $response, array $args): Response
    {
        $args = $this->getKeyParams($args);
        return $this->runPage($request, $response, $args, "PartisipasikegiatanView");
    }

    // edit
    public function edit(Request $request, Response $response, array $args): Response
    {
        $args = $this->getKeyParams($args);
        return $this->runPage($request, $response, $args, "PartisipasikegiatanEdit");
    }

    // delete
    public function delete(Request $request, Response $response, array $args): Response
    {
        $args = $this->getKeyParams($args);
        return $this->runPage($request, $response, $args, "PartisipasikegiatanDelete");
    }

    protected function getKeyParams($args)
    {
        $sep = Container("partisipasikegiatan")->RouteCompositeKeySeparator;
        if (array_key_exists("keys", $args)) {
            $keys = explode($sep, $args["keys"]);
            return count($keys) == 2 ? array_combine(["idAnggota","idKegiatan"], $keys) : $args;
        }
        return $args;
    }
}
