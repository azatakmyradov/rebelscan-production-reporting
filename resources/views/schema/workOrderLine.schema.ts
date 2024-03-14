import { z } from "zod";

export default z.object({
    CPLQTY: z.string(),
    ENDDAT: z.string(),
    EXTQTY: z.string(),
    ITMREF: z.string(),
    LOT: z.string(),
    MFGFCY: z.string(),
    MFGLIN: z.string(),
    MFGNUM: z.string(),
    MFGSTA: z.string(),
    STRDAT: z.string(),
    STU: z.string(),
    TEXTE: z.string(),
});
