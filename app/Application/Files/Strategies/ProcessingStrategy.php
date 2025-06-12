<?php

namespace Application\Files\Strategies;

interface ProcessingStrategy {
    /**
     * @param string
     * @param resource
     */
    public function run(string $filename, $resource): void;
}
