<?php

namespace Modules\ProductionReporting\DTO;

class ProductionReportingDTO
{
    public function __construct(
        public readonly string $MFGNUM,
        public readonly string $UOM,
        public readonly string $QTY,
        public readonly ?string $MVTDES,
        public readonly string $ITMREF,
        public readonly ?string $LOT,
        public readonly ?string $SLO,
        public readonly ?string $SERNUM,
        public readonly ?string $PALNUM
    ) {
    }

    public static function fromArray(array $attributes, string $prefix = ''): self
    {
        return new self(
            MFGNUM: $attributes[$prefix . 'MFGNUM'],
            UOM: $attributes[$prefix . 'UOM'],
            QTY: $attributes[$prefix . 'QTY'],
            MVTDES: $attributes[$prefix . 'MVTDES'],
            ITMREF: $attributes[$prefix . 'ITMREF'],
            LOT: $attributes[$prefix . 'LOT'] ?? null,
            SLO: $attributes[$prefix . 'SLO'] ?? null,
            SERNUM: $attributes[$prefix . 'SERNUM'] ?? null,
            PALNUM: $attributes[$prefix . 'PALNUM'] ?? null
        );
    }

    public function toArray(string $prefix = ''): array
    {
        return [
            $prefix . 'MFGNUM' => $this->MFGNUM,
            $prefix . 'UOM' => $this->UOM,
            $prefix . 'QTY' => $this->QTY,
            $prefix . 'MVTDES' => $this->MVTDES ?? '',
            $prefix . 'ITMREF' => $this->ITMREF,
            $prefix . 'LOT' => $this->LOT ?? '',
            $prefix . 'SLO' => $this->SLO ?? '',
            $prefix . 'SERNUM' => $this->SERNUM ?? '',
            $prefix . 'PALNUM' => $this->PALNUM ?? '',
        ];
    }
}
