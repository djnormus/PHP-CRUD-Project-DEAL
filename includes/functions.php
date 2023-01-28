<?php


function userConnected()
{

    if (isset($_SESSION['pseudo'])) {
        return true;
    } else {

        return false;
    }
}


function userAdmin()
{

    if ($_SESSION['statut'] == 1) {
        return true;
    } else {
        return false;
    }
}
