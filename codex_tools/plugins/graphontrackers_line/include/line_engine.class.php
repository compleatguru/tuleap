<?php
/*
 * Copyright (c) STMicroelectronics, 2006. All Rights Reserved.
 *
 * Originally written by Mahmoud MAALEJ, 2006. STMicroelectronics.
 *
 * This file is a part of CodeX.
 *
 * CodeX is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * CodeX is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with CodeX; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */


class line_engine {

    var $graph;
    var $title;
    var $field_base;
    var $height;
    var $width;
    var $state_source;
    var $state_target;
    var $date_min;
    var $date_max;
    var $date_reference;
    var $method;
    var $data;
    var $xaxis;
    var $jp_graph_path;
    
    function line_engine() {
        $this->jp_graph_path = $GLOBALS['jpgraph_dir'];        
    }
    
    function buildGraph() {
        if ($this->width == 0) {
            if (count($this->xaxis) == 0) {
                $this->width = ((1/12)*700)+(2*150);
            } else {
                $this->width = ((count($this->xaxis)/12)*700)+(2*150);
            }
        }
        
        $this->graph = new Chart($this->width,$this->height);
        $this->graph->SetScale("textint");
        $this->graph->title->Set($this->title);
        
        if (is_null($this->description)) {
            $this->description = "";
        }
        $caption = new Text($this->description,30,40);
        $caption->setFont($this->graph->getFont(), FS_NORMAL, 9);
        $caption->setColor($this->graph->getMainColor());
        $this->graph->AddText($caption); 

        if( is_null($this->xaxis) || (count($this->xaxis)==0 )) {
            $this->graph->xaxis->SetTickLabels(array(""));
        } else {
            $this->graph->xaxis->SetTickLabels($this->xaxis);
        }
        $this->graph->xaxis->title->setColor('red');
        $this->graph->yaxis->title->setColor('red');
        $this->graph->xaxis->SetTitle('(Month)');
        $this->graph->yaxis->SetTitle('(Day)');
        $this->graph->xaxis->SetTickSide(SIDE_DOWN);
        $this->graph->yaxis->SetTickSide(SIDE_LEFT);
        
        $this->graph->legend->SetPos(0.05,0.05,'right','top');
        if (count($this->data) == 0) {
            $this->data[0] = 0;
            $this->data[1] = 0;
        }
        if (count($this->data)>0) {          
            //Create the linear plot
            $lineplot = new LinePlot($this->data);
            $lineplot->SetColor('blue');
            $this->graph->Add( $lineplot);
        }
        return $this->graph;
    }
    
    
    function isDataAvailable() {
        $returns = false;
        for ($i=0;$i<count($this->data);$i++) {
            if (array_sum($this->data[$i])>0){
                $returns = true;
            }
        }
        return $returns;
    }
    
    
    function invMatrix($matrix) {
        for($i=0;$i<count($matrix);$i++) {
            for($j=0;$j<count($matrix[$i]);$j++) {
               $inversed_matrix[$j][$i] = $matrix[$i][$j];
            }
        }
        return $inversed_matrix;
    }
}
?>
