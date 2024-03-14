<?php

namespace Modules\ProductionReporting\DTO;

class WorkOrderLineDTO
{
    public function __construct(
        public readonly string $MFGNUM,
        public readonly string $MFGLIN,
        public readonly string $MFGSTA,
        public readonly string $MFGFCY,
        public readonly string $STRDAT,
        public readonly string $ENDDAT,
        public readonly string $STU,
        public readonly string $EXTQTY,
        public readonly string $CPLQTY,
        public readonly string $ITMREF,
        public readonly string $LOT,
        public readonly string $TEXTE,
    ) {
    }

    public static function fromArray(array $data, string $prefix = ''): self
    {
        return new self(
            MFGNUM: $data[$prefix . 'MFGNUM'],
            MFGLIN: $data[$prefix . 'MFGLIN'],
            MFGSTA: $data[$prefix . 'MFGSTA'],
            MFGFCY: $data[$prefix . 'MFGFCY'],
            STRDAT: $data[$prefix . 'STRDAT'],
            ENDDAT: $data[$prefix . 'ENDDAT'],
            STU: $data[$prefix . 'STU'],
            EXTQTY: $data[$prefix . 'EXTQTY'],
            CPLQTY: $data[$prefix . 'CPLQTY'],
            ITMREF: $data[$prefix . 'ITMREF'],
            LOT: $data[$prefix . 'LOT'],
            TEXTE: $data[$prefix . 'TEXTE'],
        );
    }

    public function toArray(): array
    {
        return [
            'MFGNUM' => $this->MFGNUM,
            'MFGLIN' => $this->MFGLIN,
            'MFGSTA' => $this->MFGSTA,
            'MFGFCY' => $this->MFGFCY,
            'STRDAT' => $this->STRDAT,
            'ENDDAT' => $this->ENDDAT,
            'STU' => $this->STU,
            'EXTQTY' => $this->EXTQTY,
            'CPLQTY' => $this->CPLQTY,
            'ITMREF' => $this->ITMREF,
            'LOT' => $this->LOT,
            'TEXTE' => $this->TEXTE,
        ];
    }
}
