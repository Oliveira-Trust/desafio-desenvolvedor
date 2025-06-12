<?php

namespace Domain\Files\Enums;

enum ConsolidatedFileStatus: string {
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case COMPLETED_WITH_ERROR = 'completed_with_error';
}
