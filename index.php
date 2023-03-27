<?php

function foo($intervals) {
    // Tri des sous-tableaux par ordre croissant selon la valeur de 'a'
    usort($intervals, function($a, $b) {
        return $a[0] <=> $b[0];
    });
    
    // Fusion des sous-tableaux qui se chevauchent
    $result = [];
    $current = null;
    foreach ($intervals as $interval) {
        if (!$current || $interval[0] > $current[1]) {
            // Nouvel intervalle, ou intervalle non chevauchant
            $result[] = $interval;
            $current = $interval;
        } else {
            // Intervalles chevauchants, on fusionne
            $current[1] = max($current[1], $interval[1]);
        }
    }
    
    return $result;
}

// Test de la fonction avec différents jeux de données
$intervals1 = [[0, 3], [6, 10]];
$intervals2 = [[0, 5], [3, 10]];
$intervals3 = [[0, 5], [2, 4]];
$intervals4 = [[7, 8], [3, 6], [2, 4]];
$intervals5 = [[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]];

echo "<pre>";
echo "foo(" . json_encode($intervals1) . ") => " . json_encode(foo($intervals1)) . "\n";
echo "foo(" . json_encode($intervals2) . ") => " . json_encode(foo($intervals2)) . "\n";
echo "foo(" . json_encode($intervals3) . ") => " . json_encode(foo($intervals3)) . "\n";
echo "foo(" . json_encode($intervals4) . ") => " . json_encode(foo($intervals4)) . "\n";
echo "foo(" . json_encode($intervals5) . ") => " . json_encode(foo($intervals5)) . "\n";
echo "</pre>";
