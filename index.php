<?php

/** 
 * モンティ・ホール問題
 *
 */

// 試行回数
const N = 1000000;

$a = 0;
$b = 0;

for ( $n = 0; $n < N; $n++ )
{
    if ( test_a() )
    {
        $a++;
    }
}

for ( $n = 0; $n < N; $n++ )
{
    if ( test_b() )
    {
        $b++;
    }
}

echo "A : {$a}/" . N . " ( " . ( $a / N * 100 ) . " % )\n";
echo "B : {$b}/" . N . " ( " . ( $b / N * 100 ) . " % )\n";

/**
 * 3 つのドアを準備し、指定された 1 つ以外の、不正解のドアを除外し返す
 */
function setup( $selected_door_index )
{
    $n = random_int( 0, 2 );

    $doors = [ false, false, false ];

    $doors[ $n ] = true;

    while ( true )
    {
        $m = random_int( 0, 2 );

        if ( $m != $selected_door_index && $doors[ $m ] == false )
        {
            $doors[ $m ] = null;

            break;
        }
    }

    return $doors;
}

/**
 * 選択肢を変えないパターン
 */
function test_a()
{
    $n = random_int( 0, 2 );

    $doors = setup( $n );
    
    return $doors[ $n ];
}

/**
 * 選択肢を変えるパターン
 */
function test_b()
{
    $n = random_int( 0, 2 );

    $doors = setup( $n );
    
    $n = ( $n + 1 ) % 3;

    if ( $doors[ $n ] === null )
    {
        $n = ( $n + 1 ) % 3;
    }

    return $doors[ $n ];
}

?>