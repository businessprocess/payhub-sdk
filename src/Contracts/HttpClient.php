<?php

namespace Payhub\Contracts;

interface HttpClient
{
    /**
     * @param string $uri
     * @param array $options
     * @return array|null
     */
    public function get(string $uri, array $options = []);

    /**
     * @param string $uri
     * @param array $options
     * @return array|null
     */
    public function post(string $uri, array $options = []);

    /**
     * @param string $uri
     * @param array $options
     * @return array|null
     */
    public function put(string $uri, array $options = []);

    /**
     * @param string $uri
     * @param array $options
     * @return array|null
     */
    public function delete(string $uri, array $options = []);
}