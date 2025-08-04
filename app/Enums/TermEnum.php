<?php

namespace App\Enums;

enum TermEnum: string
{
    case First = '1st Term';
    case Second = '2nd Term';
    case Third = '3rd Term';

    public function label(): string
    {
        return match ($this) {
            self::First => '1st Term',
            self::Second => '2nd Term',
            self::Third => '3rd Term',
        };
    }

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}