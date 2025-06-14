<?php

/*
 * SPDX-FileCopyrightText: Copyright (c) 2025 Kanstantsin Mesnik
 * SPDX-License-Identifier: MIT
 */
declare(strict_types=1);

namespace Paira\Shared\Internal\Text;

/**
 * Envelope for {@see Text}, delegating all calls to the origin.
 *
 * @codeCoverageIgnore
 * @since 0.1
 */
abstract readonly class TextEnvelope implements Text
{
    public function __construct(protected Text $origin)
    {
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
