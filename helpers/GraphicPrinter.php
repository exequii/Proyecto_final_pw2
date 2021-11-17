<?php

class GraphicPrinter
{
    private $graphicPrinter;

    public function __construct()
    {

    }

    public function imprimirCirculo(){
        $data = array(40,60,21,33);

    // Create the Pie Graph.
        $graph = new PieGraph(750,650);

        $theme_class= new VividTheme;
        $graph->SetTheme($theme_class);

    // Set A title for the plot
        $graph->title->Set("A Simple 3D Pie Plot");

    // Create
        $p1 = new PiePlot3D($data);
        $graph->Add($p1);

        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->ExplodeSlice(1);
        $graph->Stroke();
}
    public function imprimirBarras($nombes, $generales,$familiares,$suites){
        $data1y=array(200,50,200,200);
        $data2y=array(75,0,75,75);
        $data3y=array(25,50,25,25);
        // Create the graph. These two calls are always required
        $graph = new Graph(850,600,'auto');
        $graph->SetScale("textlin");

        $theme_class=new UniversalTheme;
        $graph->SetTheme($theme_class);

        $graph->yaxis->SetTickPositions(array(0,50,75,100,200,300), array(25,80,90,150,250));
        $graph->SetBox(false);

        $graph->ygrid->SetFill(false);
        $graph->xaxis->SetTickLabels($nombes);
        $graph->yaxis->HideLine(false);
        $graph->yaxis->HideTicks(false,false);

// Create the bar plots
        $b1plot = new BarPlot($generales);
        $b2plot = new BarPlot($familiares);
        $b3plot = new BarPlot($suites);

// Create the grouped bar plot
        $gbplot = new GroupBarPlot(array($b1plot,$b2plot,$b3plot));
// ...and add it to the graPH
        $graph->Add($gbplot);


        $b1plot->SetColor("white");
        $b1plot->SetFillColor("#cc1111");

        $b2plot->SetColor("white");
        $b2plot->SetFillColor("#11cccc");

        $b3plot->SetColor("white");
        $b3plot->SetFillColor("#1111cc");

        $graph->title->Set("Tasa de ocupacion por vuelo y equipo");

// Display the graph
        $graph->Stroke();
    }




}