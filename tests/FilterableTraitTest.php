<?php

/*
 * This file is part of Dinkbit Filterable.
 *
 * (c) Joseph Cohen <joseph.cohen@dinkbit.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dinkbit\Filterable\Test;

use Mockery as m;

/**
 * This is the filterable trait test class.
 *
 * @author Joseph Cohen <joseph.cohen@dinkbit.com>
 */
class FilterableTraitTest extends \PHPUnit_Framework_TestCase
{

    public function tearDown()
    {
        m::close();
    }

    public function testEnabledFilters()
    {
        $model = new FooModelStub();

        $this->assertEquals(['foo'], $model->getFilterableColumns());
    }

    public function testCallScope()
    {
        $query = m::mock('StdClass');
        $query->shouldReceive('foo')->once()->andReturn($query);

        $model = new FooModelStub();

        $result = $model->scopeFilter($query, ['foo' => 1]);

        $this->assertSame($query, $result);
    }

    public function testScopeNotCalled()
    {
        $query = m::mock('StdClass');
        $query->shouldReceive('foo')->never()->andReturn($query);

        $model = new FooModelStub();

        $result = $model->scopeFilter($query, ['bar' => 1]);

        $this->assertSame($query, $result);
    }
}

class FooModelStub
{
    use \Dinkbit\Filterable\FilterableTrait;
    public $filterable = ['foo'];
    public function foo()
    {
        //
    }
}
