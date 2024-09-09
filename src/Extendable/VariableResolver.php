<?php

namespace Williams\Xpression\Extendable;

class VariableResolver
{
    //Dictionary of cached values
    private array $cache = [];

    //List of variable names that should automatically have values saved to and obtained from cache.
    protected array $autocache = [];

    public function resolve(string $variableName)
    {
        //Return the cached value if exists and autocache configured.
        if ($this->isAutocached($variableName) && $this->cacheHas($variableName)) {
            return $this->cache($variableName);
        }

        // Otherwise, calculate the value.
        $value = $this->calculate($variableName);

        //Cache the value if autocache cofigured.
        $this->cacheIfAutocached($variableName, $value);

        //Return the value
        return $value;
    }

    //Retrieve or set a cache value depending on number of parameters ginven
    protected function cache(string $key, $value = null)
    {
        if ($value == null) {
            return $this->cache[$key] ?? null;
        }
        $this->cache[$key] = $value;
    }

    // Check if the cache has an entry named $key.
    protected function cacheHas(string $key): bool
    {
        return (isset($this->cache[$key]) && ($this->cache[$key] != null));
    }

    //Returns the value for a specified variable for which a dedicated method does not exist.
    protected function default(string $var)
    {
        return false;
    }

    //Check if a variable is configured for autocache.
    protected function isAutocached(string $varName): bool
    {
        return in_array($varName, $this->autocache);
    }

    //Check if $key is autocached and, if so, set it to $value.
    protected function cacheIfAutocached(string $key, $value)
    {
        if ($this->isAutocached($key)) {
            $this->cache($key, $value);
        }
    }

    // Resolves the value of $variableName using either a dedicated or the default method.
    private function calculate($variableName)
    {
        if ($method = $this->getDedicatedMethod($variableName)) {
            //call defineVarName if it exists
            return call_user_func([$this, $method]);
        } else {
            // call default($varName)
            return $this->default($variableName);
        }
    }

    // Returns the name of the dedicated method for $varName or FALSE if not found.
    private function getDedicatedMethod(string $varName)
    {
        $methods = get_class_methods($this);
        $lcMethods = array_map('strtolower', $methods);
        $search = 'define' . $varName;
        $index = array_search($search, $lcMethods);
        return ($index !== false) ? $methods[$index] : false;
    }
}
