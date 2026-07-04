<?php

namespace Tests\Unit;

use App\Http\Controllers\OrdersController;
use Tests\TestCase;

class OrdersControllerTest extends TestCase
{
    public function test_selected_task_commission_rate_is_eighteen_percent(): void
    {
        $reflection = new \ReflectionClass(OrdersController::class);

        $this->assertSame(0.18, $reflection->getConstant('SELECTED_TASK_COMMISSION_RATE'));
    }
}
