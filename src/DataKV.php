<?php

namespace Pada\Tinkoff\Payment;

final class DataKV
{
    /**
     * Key — string(20), Value — string(100)
     * @var array
     */
    private array $data;

    public function __construct(array $data = [])
    {
        $this->setAll($data);
    }

    public function set(string $key, string $value): self
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function get(string $key, ?string $default = null): ?string
    {
        return $this->data[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        return \array_key_exists($key, $this->data);
    }

    public function setAll(array $data): self
    {
        foreach ($data as $k => $v) {
            if (\is_string($v)) {
                $this->set($k, $v);
            }
        }
        return $this;
    }

    public function getAll(): array
    {
        return $this->data;
    }
}
