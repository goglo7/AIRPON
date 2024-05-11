<?php

namespace App\Entity;

enum UserRole: string
{
    case ADMIN = "ROLE_ADMIN";

    case RESPONSABLE = "ROLE_RESPONSABLE";

    case CLIENTELE = "ROLE_CLIENTELE";

}
