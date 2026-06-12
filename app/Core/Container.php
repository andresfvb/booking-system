<?php

namespace BookingSystem\Core;

defined('ABSPATH') || exit;

class Container
{
    protected array $services = [];

    public function set(string $key, $service)
    {
        $this->services[$key] = $service;
    }

    public function get(string $key)
    {
        return $this->services[$key] ?? null;
    }
}