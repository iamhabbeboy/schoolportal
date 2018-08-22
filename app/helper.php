<?php
use App\State;

function findById($state_id)
{
    if( $state_id == null ) {
        return 'N/A';
    }
    return (new State)->findById($state_id);
}