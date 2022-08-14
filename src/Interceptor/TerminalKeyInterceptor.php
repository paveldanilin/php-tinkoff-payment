<?php

namespace Pada\Tinkoff\Payment\Interceptor;

use Pada\Tinkoff\Payment\Contract\TerminalKeyAwareInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RestClient\ContextInterface;
use RestClient\Interceptor\RequestInterceptorInterface;
use RestClient\RequestExecutionInterface;

final class TerminalKeyInterceptor implements RequestInterceptorInterface
{
    private string $terminalKey;

    public function __construct(string $terminalKey)
    {
        $this->terminalKey = $terminalKey;
    }

    public function intercept(RequestInterface $request, ContextInterface $context, RequestExecutionInterface $execution): ResponseInterface
    {
        if ($context->has(ContextInterface::REQUEST_MODEL)) {
            $model = $context->get(ContextInterface::REQUEST_MODEL);
            if ($model instanceof TerminalKeyAwareInterface) {
                $model->setTerminalKey($this->terminalKey);
            }
        }
        return $execution->execute($request, $context);
    }
}
