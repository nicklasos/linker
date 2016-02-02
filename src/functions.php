<?php

/**
 * $bar = isset($data['foo']) ? $data['foo'] : 'default';
 * same as
 * $bar = in($data, 'foo', 'default');
 *
 * $baz = (isset($data['foo']['bar']['baz'])) ? $data['foo']['bar']['baz'] : null;
 * same as
 * $baz = in($data, ['foo', 'bar', 'baz']);
 *
 * $data = ['foo' => 'bar'];
 * $baz = in($data, ['baz'], 'qux'); => 'qux'
 *
 * @param array $array
 * @param mixed $keys
 * @param null $default
 * @return mixed
 */
function in($array, $keys, $default = null)
{
    if ($array === null) {
        return $default;
    }

    if (!is_array($keys)) {
        if (isset($array[$keys])) {
            return $array[$keys];
        } else {
            return $default;
        }
    }

    $current = $array;
    foreach ($keys as $key) {
        if (!array_key_exists($key, $current)) {
            return $default;
        }

        $current = $current[$key];
    }
    return $current;
}

function url()
{
    $url = in($_SERVER, 'PATH_INFO', '/');
    $url = substr($url, 1);

    return $url;
}

function mongo($dbname = null)
{
    static $instance = null;

    if ($instance === null) {
        $mongoClient = new \MongoClient(
            "mongodb://localhost:27017",
            ['socketTimeoutMS' => 5000]
        );

        if (!$dbname) {
            throw new \InvalidArgumentException('dbname is not set');
        }

        $instance = $mongoClient->selectDB($dbname);
    }

    return $instance;
}
