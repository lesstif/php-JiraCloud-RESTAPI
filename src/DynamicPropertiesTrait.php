<?php

declare(strict_types=1);

namespace JiraCloud;

/**
 * Defines a trait that allows to dynamically assign properties to objects as this has been deprecated in PHP8.2.
 */
trait DynamicPropertiesTrait
{
    /** @var array<string, mixed> */
    protected array $dynamicProperties = [];

    /**
     * Attempts to retrieve a dynamic property from {@link static::$dynamicProperties}.
     *
     * @param string $name
     *
     * @return mixed The requested value if found, `null` otherwise.
     */
    public function __get(string $name): mixed
    {
        return $this->dynamicProperties[$name] ?? null;
    }

    /**
     * Returns whether the dynamic property `$name` is set (not `null`!) in {@link static::$dynamicProperties}.
     *
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset($this->dynamicProperties[$name]);
    }

    /**
     * Applies `$value` using `$name` as key on {@link static::$dynamicProperties}.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return void
     */
    public function __set(string $name, mixed $value): void
    {
        $this->dynamicProperties[$name] = $value;
    }

    /**
     * Accessor for {@link static::$dynamicProperties}.
     *
     * @return array
     */
    public function getDynamicProperties(): array
    {
        return $this->dynamicProperties;
    }
}
