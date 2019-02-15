<?php
/**
 * Copyright (c) Enalean, 2019. All Rights Reserved.
 *
 * This file is a part of Tuleap.
 *
 * Tuleap is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Tuleap is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Tuleap. If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types = 1);

namespace Tuleap\Docman\REST\v1;

use Docman_ApprovalTable;
use Docman_Item;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Tuleap\Docman\ApprovalTable\ApprovalTableRetriever;

class DocmanItemUpdatorTest extends TestCase
{
    use MockeryPHPUnitIntegration;
    /**
     * @var \Docman_LockFactory|Mockery\MockInterface
     */
    private $lock_factory;
    /**
     * @var DocmanItemUpdator
     */
    private $updator;

    /**
     * @var Mockery\MockInterface|ApprovalTableRetriever
     */
    private $approval_table_retriever;

    protected function setUp() : void
    {
        parent::setUp();

        $this->approval_table_retriever = Mockery::mock(ApprovalTableRetriever::class);
        $this->lock_factory = Mockery::mock(\Docman_LockFactory::class);

        $this->updator = new DocmanItemUpdator($this->approval_table_retriever, $this->lock_factory);
    }

    public function testItThrowsAnExceptionWhenDocumentHasAnApprovalTable()
    {
        $item = Mockery::mock(Docman_Item::class);
        $user = Mockery::mock(\PFUser::class);
        $this->approval_table_retriever->shouldReceive('retrieveByItem')
                                       ->with($item)
                                       ->andReturn(Mockery::mock(Docman_ApprovalTable::class));

        $this->expectException(ExceptionDocumentHasApprovalTable::class);

        $this->updator->update($item, $user);
    }

    public function testItThrowsAnExceptionWhenDocumentIsLockedByAnotherUser()
    {
        $item = Mockery::mock(Docman_Item::class);
        $user = Mockery::mock(\PFUser::class);
        $user->shouldReceive('getId')->andReturn(101);
        $this->approval_table_retriever->shouldReceive('retrieveByItem')
                                       ->with($item)
                                       ->andReturn(null);

        $this->lock_factory->shouldReceive('getLockInfoForItem')
            ->with($item)
            ->andReturn(["user_id" => 106]);

        $this->expectException(ExceptionItemIsLockedByAnotherUser::class);

        $this->updator->update($item, $user);
    }
}