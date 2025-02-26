<?php

namespace App\Core;

class ListQuery
{

    /**
     * @param $elementQuery
     * @return array|string[]
     * TODO : Mettre un commentaire d'explication
     */
    public static function getSimpleList($elementQuery, $elementFilters = []) {
        $legendHtml = '<li class="legend">';

        $elementClass = "App\\Models\\".$elementQuery['element'];
            
        if (class_exists($elementClass)){
            $entity = new $elementClass;

            $resultsQuery = $entity->query(array_keys($elementQuery['columns']), $elementQuery['filter'] ?? []);
        }else {
            return [];
        }

        $resultsList = [];

        foreach ($resultsQuery as $keyResult => $result) {
            $index = 0;
            $resultHtml = '<li class="listItem">';

            foreach ($elementQuery['columns'] as $keyColumn => $column) {
                if ($keyResult === 0){
                    $legendHtml .= '<p class="flex-weight-'.($column['size'] ? $column['size'] : 1).'">'.$column['label'].'</p>';
                }

                if (array_key_exists('combo', $column)){
                    $elementClass = "App\\Models\\".$column['combo']['element'];

                    if (class_exists($elementClass)){
                        $entity = new $elementClass;
            
                        $resultCombo = $entity->query(
                            $column['combo']['columns'], 
                            [
                                $column['combo']['filterKey'] => $result[$index]
                            ]
                        )[0];

                        $resultComboString = [];
                        
                        foreach ($column['combo']['columns'] as $comboColumn) {
                            array_push($resultComboString, $resultCombo[$comboColumn]);
                        }
                        
                        $resultHtml .= '<p class="flex-weight-'.($column['size'] ? $column['size'] : 1).'">'
                                .htmlspecialchars(implode(' ', $resultComboString))
                            .'</p>';
                    }
                }else {
                    if(array_key_exists("creationDate", $result) || array_key_exists("updateDate", $result)) {
                        $result[$index] = date("d/m/Y H:i", strtotime($result[$index]));
                    }
                    
                    $resultHtml .= '<p class="flex-weight-'.($column['size'] ? $column['size'] : 1).'">'
                            .htmlspecialchars($result[$index])
                        .'</p>';
                }
                $index ++;
            }
            $resultHtml .= '</li>';
            array_push($resultsList, $resultHtml);
        }

        $legendHtml .= '</li>';

        return array_merge([$legendHtml], $resultsList);
    }
}