<?php

namespace Pada\Tinkoff\Payment;

final class ObjectUtil {

    private function __construct()
    {
    }

    /**
     * @param object $object
     * @param bool $recursively
     * @param array<string> $ignoreKeys
     * @param callable|null $keyNormalizer
     * @param callable|null $valFilter
     * @return array
     */
    public static function toArray(object $object, bool $recursively = false, array $ignoreKeys = [], ?callable $keyNormalizer = null, ?callable $valFilter = null): array
    {
        $clasName = \get_class($object);
        $parentClass = \get_parent_class($object);
        $search = [$clasName, '*'];
        if (false !== $parentClass) {
            $search[] = $parentClass;
        }

        $array = (array)$object;
        $result = [];
        foreach ($array as $k => $v) {
            $k = \trim(\str_replace($search, '', $k));
            if (!empty($ignoreKeys) && \in_array($k, $ignoreKeys, true)) {
                continue;
            }
            if (null !== $valFilter && false === $valFilter($k, $v)) {
                continue;
            }
            if (null !== $keyNormalizer) {
                $k = $keyNormalizer($k);
            }
            if ($recursively && \is_object($v)) {
                $result[$k] = self::toArray($v, $recursively);
            } else {
                if ($v instanceof \DateTime) {
                    $v = self::toISO8601($v);
                }
                $result[$k] = $v;
            }
        }
        return $result;
    }

    private static function toISO8601(\DateTime $dateTime): string
    {
        return $dateTime->format(\DateTime::ATOM);
    }
}
