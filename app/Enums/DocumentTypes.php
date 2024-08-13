<?php

namespace App\Enums;

enum DocumentTypes: string
{
    case LETTRE_TRANSPORT = 'LETTRE DE TRANSPORT';
    case FACTURE_COMMERCIALE = 'FACTURE COMMERCIALE';
    case LISTE_COLISAGE = 'LISTE DE COLISAGE';
    case LICENCE_IMPORTATION = 'LICENCE D\'IMPORTATION';
    case ATTESTATION_VERIFICATION = 'ATTESTATION DE VÉRIFICATION';
    case ATTESTATION_OGFREM = 'ATTESTATION DE DESTINATION OU FERI';
    case CERTIFICAT_ORIGINE = 'CERTIFICAT D\'ORIGINE';
}

