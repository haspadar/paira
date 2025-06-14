<?php

/*
 * SPDX-FileCopyrightText: Copyright (c) 2025 Kanstantsin Mesnik
 * SPDX-License-Identifier: MIT
 */
declare(strict_types=1);

namespace Paira\Shared\Internal\Text;

use Paira\Exception;

/**
 * {@see Text} that throws if its length exceeds a limit.
 *
 * Validates the number of characters using {@see LengthOf}.
 *
 * Example:
 * $text = new MaxLengthAsserted(new TextOf('hello'), 10);
 * echo $text->value(); // 'hello'
 *
 * @throws Exception If the text exceeds the length limit.
 *
 * @psalm-pure
 * @since 0.1
 */

final readonly class MaxLengthAsserted extends TextEnvelope
{
    public function __construct(
        Text $text,
        private int $limit
    ) {
        parent::__construct($text);
    }

    /**
     * @throws Exception
     */
    #[\Override]
    public function value(): string
    {
        $length = new LengthOf($this->origin);
        if ($length->isGreaterThan($this->limit)) {
            throw new Exception(sprintf(
                'Text exceeds maximum length of %d (got %d): "%s..."',
                $this->limit,
                $length->value(),
                $this->origin->value()
            ));
        }

        return $this->origin->value();
    }
}
