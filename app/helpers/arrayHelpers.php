<?php
function getUniqueArrayById( $objects ) {
    $objectsTmp = array_map( function( $obj ) {
        return $obj->id;
    }, $objects );
    $uniqueObjs = array_unique( $objectsTmp );
    return array_values( array_intersect_key( $objects, $uniqueObjs ) );
}