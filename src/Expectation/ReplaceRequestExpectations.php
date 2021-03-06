<?php

/**
 * This file is part of the tarantool/phpunit-extras package.
 *
 * (c) Eugene Leonovich <gen.work@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tarantool\PhpUnit\Expectation;

use PHPUnitExtras\Expectation\Expectation;
use PHPUnitExtras\Expectation\ExpressionExpectation;
use Tarantool\Client\Client;
use Tarantool\PhpUnit\Expectation\ExpressionContext\RequestCountContext;
use Tarantool\PhpUnit\Expectation\ExpressionContext\RequestCounter;

trait ReplaceRequestExpectations
{
    public function expectReplaceRequestToBeCalled(int $count) : void
    {
        $context = RequestCountContext::exactly($this->getClient(), $this->getRequestCounter(), 'REPLACE', $count);
        $this->expect(new ExpressionExpectation($context));
    }

    public function expectReplaceRequestToBeCalledAtLeast(int $count) : void
    {
        $context = RequestCountContext::atLeast($this->getClient(), $this->getRequestCounter(), 'REPLACE', $count);
        $this->expect(new ExpressionExpectation($context));
    }

    public function expectReplaceRequestToBeCalledAtMost(int $count) : void
    {
        $context = RequestCountContext::atMost($this->getClient(), $this->getRequestCounter(), 'REPLACE', $count);
        $this->expect(new ExpressionExpectation($context));
    }

    public function expectReplaceRequestToBeCalledOnce() : void
    {
        $this->expectReplaceRequestToBeCalled(1);
    }

    public function expectReplaceRequestToBeNeverCalled() : void
    {
        $this->expectReplaceRequestToBeCalled(0);
    }

    public function expectReplaceRequestToBeCalledAtLeastOnce() : void
    {
        $this->expectReplaceRequestToBeCalledAtLeast(1);
    }

    public function expectReplaceRequestToBeCalledAtMostOnce() : void
    {
        $this->expectReplaceRequestToBeCalledAtMost(1);
    }

    abstract protected function expect(Expectation $expectation) : void;

    abstract protected function getClient() : Client;

    abstract protected function getRequestCounter() : RequestCounter;
}
