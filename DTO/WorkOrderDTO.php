<?php

declare(strict_types=1);

namespace Modules\ProductionReporting\DTO;

class WorkOrderDTO
{
    public function __construct(
        public readonly string $MFGNUM
    ) {
    }

    public static function fromArray(array $data, string $prefix = ''): self
    {
        return new self(
            MFGNUM: $data[$prefix.'MFGNUM']
        );
    }

    public function toArray(): array
    {
        return [
            'MFGNUM' => $this->MFGNUM,
        ];
    }
}
