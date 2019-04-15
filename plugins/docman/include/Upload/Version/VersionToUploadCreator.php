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

namespace Tuleap\Docman\Upload\Version;

use Tuleap\DB\DBTransactionExecutor;
use Tuleap\Docman\Upload\UploadCreationConflictException;
use Tuleap\Docman\Upload\UploadCreationFileMismatchException;
use Tuleap\Docman\Upload\UploadMaxSizeExceededException;

class VersionToUploadCreator
{
    const EXPIRATION_DELAY_IN_HOURS = 12;

    /**
     * @var DocumentOnGoingVersionToUploadDAO
     */
    private $dao;
    /**
     * @var DBTransactionExecutor
     */
    private $transaction_executor;

    public function __construct(DocumentOnGoingVersionToUploadDAO $dao, DBTransactionExecutor $transaction_executor)
    {
        $this->dao                  = $dao;
        $this->transaction_executor = $transaction_executor;
    }

    /**
     * @return VersionToUpload
     * @throws UploadCreationConflictException
     * @throws UploadCreationFileMismatchException
     *
     * @throws UploadMaxSizeExceededException
     */
    public function create(
        \Docman_Item $item,
        \PFUser $user,
        \DateTimeImmutable $current_time,
        string $version_title,
        string $changelog,
        string $filename,
        int $filesize,
        bool $is_file_locked,
        ?string $approval_table_action
    ) : VersionToUpload {
        $file_size = $filesize;
        if ((int)$file_size > (int)\ForgeConfig::get(PLUGIN_DOCMAN_MAX_FILE_SIZE_SETTING)) {
            throw new UploadMaxSizeExceededException(
                (int)$file_size,
                (int)\ForgeConfig::get(PLUGIN_DOCMAN_MAX_FILE_SIZE_SETTING)
            );
        }
        $this->transaction_executor->execute(
            function () use (
                $item,
                $user,
                $current_time,
                $version_title,
                $changelog,
                $filename,
                $filesize,
                $is_file_locked,
                $approval_table_action,
                &$version_id
            ) {
                $rows = $this->dao->searchDocumentVersionOngoingUploadByItemIdAndExpirationDate(
                    $item->getId(),
                    $current_time->getTimestamp()
                );
                if (count($rows) > 1) {
                    throw new \LogicException(
                        'A identical document is being created multiple times by an ongoing upload, this is not expected'
                    );
                }
                if (count($rows) === 1) {
                    $row = $rows[0];
                    if ($row['user_id'] !== (int)$user->getId()) {
                        throw new UploadCreationConflictException();
                    }
                    if ($row['filename'] !== $filename || (int)$filesize !== $row['filesize']) {
                        throw new UploadCreationFileMismatchException();
                    }
                    $version_id = $row['id'];
                    return;
                }

                $version_id = $this->dao->saveDocumentVersionOngoingUpload(
                    $this->getExpirationDate($current_time)->getTimestamp(),
                    $item->getId(),
                    $version_title,
                    $changelog,
                    (int)$user->getId(),
                    $filename,
                    $filesize,
                    $is_file_locked,
                    $approval_table_action
                );
            }
        );

        return new VersionToUpload($version_id);
    }

    private function getExpirationDate(\DateTimeImmutable $current_time) :  \DateTimeImmutable
    {
        return $current_time->add(new \DateInterval('PT' . self::EXPIRATION_DELAY_IN_HOURS . 'H'));
    }
}
