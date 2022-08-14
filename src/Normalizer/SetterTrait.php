<?php

namespace Pada\Tinkoff\Payment\Normalizer;

trait SetterTrait
{
    /**
     * @param string $key
     * @param mixed|callable|null $value
     * @param array $data
     * @return void
     */
    public function setIfNotNull(string $key, $value, array &$data): void
    {
        if (\is_callable($value)) {
            $value = $value();
        }
        if (null === $value) {
            return;
        }
        $data[$key] = $value;
    }
}
