<?php

namespace Pada\Tinkoff\Payment\Interceptor;

use Pada\Tinkoff\Payment\Contract\TokenAwareInterface;
use Pada\Tinkoff\Payment\ObjectUtil;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RestClient\ContextInterface;
use RestClient\Interceptor\RequestInterceptorInterface;
use RestClient\RequestExecutionInterface;

final class TokenInterceptor implements RequestInterceptorInterface
{
    private string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function intercept(RequestInterface $request, ContextInterface $context, RequestExecutionInterface $execution): ResponseInterface
    {
        if ($context->has(ContextInterface::REQUEST_MODEL)) {
            $model = $context->get(ContextInterface::REQUEST_MODEL);
            if ($model instanceof TokenAwareInterface) {
                $model->setToken($this->createToken($model));
            }
        }
        return $execution->execute($request, $context);
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/request-sign/
     *
     * @param object $payload
     * @return string
     */
    private function createToken(object $payload): string
    {
        $data = ObjectUtil::toArray(
            $payload,
            false,
            ['shops', 'receipt', 'data'],
            static fn(string $k) => \ucfirst($k),
            static fn(string $k, $v) => null !== $v,
        );

        $data['Password'] = $this->password;

        \ksort($data);

        return \hash('sha256', \implode('', $data));
    }
}
