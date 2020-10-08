
/*for default que se active las opciones*/
setOptions();

function color(id){
	colores=new Array();
	colores[0]='#2EFE2E';//verde
	colores[1]='#2E64FE';//azul
	colores[2]='#FF0000';//azul

	return colores[id];
}

function format(input)
{
	var num = input.value.replace(/\./g,'');
	if(!isNaN(num)){
		num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
		num = num.split('').reverse().join('').replace(/^[\.]/,'');
		input.value = num;
	} 
	else{ alert('Solo se permiten numeros');
		input.value = input.value.replace(/[^\d\.]*/g,'');
	}
}

function getInternetExplorerVersion(){
    var rv = -1;
    if (navigator.appName == 'Microsoft Internet Explorer')
    {
        var ua = navigator.userAgent;
        var re = new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");
        if (re.exec(ua) != null)
        rv = parseFloat( RegExp.$1 );
    }
    return rv;
}
     
function setOptions(){
	var options=Highcharts.setOptions({
	    lang: {
	        downloadCSV:"Descarga CSV",
		downloadJPEG:"Descarga JPEG imagen",
		downloadPDF:"Descarga PDF documento",
		downloadPNG:"Descarga PNG imagen",
		downloadSVG:"Descarga SVG vector imagen",
		downloadXLS:"Descarga XLS",
		printChart:"Imprimir Grafica"
	    }
	});
}
  
function pie3d(div,titulo,valores,background,show,titcolum,tipo3d) {
	
	if(! titcolum)  titcolum=false;
	
	if (tipo3d !=false){
		tipo3d = true;
	}
	
	
	//alert(valores[0]);
	//alert("'"+valores+"'");    
	//var valores = [{name:'IEN', y:26.8, color:'#2EFE2E'},{name:'P', y:12.8, color:'#2E64FE'}];
	if (show !=true){
		show = false;
	}
	var chart = new Highcharts.Chart({
		chart: {

			backgroundColor: background,
			renderTo: div, 
            type: 'pie',
            options3d: {
                enabled: tipo3d,
                alpha: 50,
                beta: 0
            }
        },
		title: {
			useHTML: true,
            text: titulo
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 10,
                dataLabels: {
                    enabled: titcolum,
                    format: '{point.percentage:.1f} %'
                },
                showInLegend: show
                
            }
        },
        series: [{
            type: 'pie',
            name: 'Porcentaje',
            //data: [{name:'IEN', y:26.8, color:'#2EFE2E'},{name:'P', y:12.8, color:'#2E64FE'}]
            data: valores
        }]
		});
}

function pie3d2(div,titulo,valores,background,show,titcolum,logotitulo,anchologo,altologo) {
	
	if(! titcolum)  titcolum=false;
	if(! logotitulo) logotitulo='';
	if(! anchologo) anchologo=120;
	if(! altologo) altologo=35;
	
	if(logotitulo !=''){
		titulo 	="<img src='"+logotitulo+"' width='"+anchologo+"' height='"+altologo+"' /><br>"+titulo;
	}
	
	
	//alert(valores[0]);
	//alert("'"+valores+"'");    
	//var valores = [{name:'IEN', y:26.8, color:'#2EFE2E'},{name:'P', y:12.8, color:'#2E64FE'}];
	if (show !=true){
		show = false;
	}
	var chart = new Highcharts.Chart({
		chart: {

			backgroundColor: background,
			renderTo: div, 
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 50,
                beta: 0
            }
        },
		title: {
			useHTML: true,
            text: titulo
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 10,
                dataLabels: {
                    enabled: titcolum,
                    format: '{point.percentage:.1f} %'
                },
                showInLegend: show
            }
        },
        series: [{
            type: 'pie',
            name: 'Porcentaje',
            //data: [{name:'IEN', y:26.8, color:'#2EFE2E'},{name:'P', y:12.8, color:'#2E64FE'}]
            data: valores
        }]
		});
}

function area_stacked(div,titulo,subtitulo,texto,categorias,valores,background) {
	//alert(valores[0]);
	//valores[0]={name: "Grupo0" ,data:[2,4,6]},{name: "Grupo2" ,data:[6,5,1]}
	//valores[1]={name: "Grupo2" ,data:[6,5,1]};
	var chart = new Highcharts.Chart({
	        chart: {
				backgroundColor: background,
				renderTo: div,
	            type: 'area'
	        },
	        title: {
	            text: titulo
	        },
	        subtitle: {
	            text: subtitulo
	        },
	        xAxis: {
	            categories: categorias,
	            tickmarkPlacement: 'on',
	            title: {
	                enabled: false
	            }
	        },
	        yAxis: {
	            title: {
	                text: texto
	            },
	            labels: {
	                formatter: function () {
	                    return this.value / 1;
	                }
	            }
	        },
	        tooltip: {
	            shared: true,
	            valueSuffix: ''
	        },
	        plotOptions: {
	            area: {
	                stacking: 'normal',
	                lineColor: '#666666',
	                lineWidth: 1,
	                marker: {
	                    lineWidth: 1,
	                    lineColor: '#666666'
	                }
	            }
	        },
	        series: valores 
	                 
	          
	});
}

function with_data_labels(div,titulo,subtitulo,texto,categorias,valores,background,valuesusf,titcolum) {

	
	if(! valuesusf)valuesusf='';
	if(! titcolum)  titcolum=false;
	
	var chart = new Highcharts.Chart({
	        chart: {
				backgroundColor: background,
				renderTo: div,
	            type: 'line'
	        },    
	        title: {
	            text: titulo
	        },
	        subtitle: {
	            text: subtitulo
	        },
	        xAxis: {
	            categories: categorias,
	            tickmarkPlacement: 'on',
	            title: {
	                enabled: false
	            }
	        },
	        yAxis: {
	            title: {
	                text: texto
	            },
	            labels: {
	                formatter: function () {
	                    return this.value / 1;
	                }
	            }
	        },
	        tooltip: {
	            shared: true,
	            valueSuffix: valuesusf
	        },
	        plotOptions: {
	            area: {
	                stacking: 'normal',
	                lineColor: '#666666',
	                lineWidth: 1,
	                marker: {
	                    lineWidth: 1,
	                    lineColor: '#666666'
	                }
	            },
	            line: {
	                dataLabels: {
	                    enabled: titcolum
	                }
	            }
	        },
	        series: valores 
	                 
	          
	});
}

function area_basic(div,titulo,subtitulo,texto,categorias,valores,background) {
	//alert(valores[0]);
	//valores[0]={name: "Grupo0" ,data:[2,4,6]},{name: "Grupo2" ,data:[6,5,1]}
	//valores[1]={name: "Grupo2" ,data:[6,5,1]};
	var chart = new Highcharts.Chart({
	        chart: {
				backgroundColor: background,
				renderTo: div,
	            type: 'area'
	        },
	        title: {
	            text: titulo
	        },
	        subtitle: {
	            text: subtitulo
	        },
	        xAxis: {
	        	allowDecimals: false,
	            categories: categorias,
	            labels: {
	                formatter: function () {
	                    return this.value; // clean, unformatted number for year
	                }
	            }
	        },
	        yAxis: {
	            title: {
	                text: texto
	            },
	            labels: {
	                formatter: function () {
	                    return this.value / 1;
	                }
	            }
	        },
	        tooltip: {
	            shared: true,
	            valueSuffix: ''
	        },
	        plotOptions: {
	            area: {
	           
	                marker: {
	                    enabled: false,
	                    symbol: 'circle',
	                    radius: 2,
	                    states: {
	                        hover: {
	                            enabled: true
	                        }
	                    }
	                }
	            }
	        },
	        series: valores 
	                 
	          
	});
}

function column_basic(div,titulo,subtitulo,texto,categorias,valores,background,tooltipp,titcolum) {

	if(! titcolum)  titcolum=false;
	
	var chart = new Highcharts.Chart({
	        chart: {
				backgroundColor: background,
				renderTo: div,
		        type: 'column'
	           
	        },
	        title: {
	        	useHTML: true,
	            text: titulo
	        },
	        subtitle: {
	            text: subtitulo
	        },
	        xAxis: {
	            categories: categorias,
	            crosshair: false
	        },
	        yAxis: {
	            min: 0,
	            title: {
	                text: texto
	            }
	        },
	        tooltip: tooltipp,
	        plotOptions: {
	            column: {
	                pointPadding: 0.2,
	                borderWidth: 0,
	                dataLabels: {
	                    enabled: titcolum
	                }
	            }
	        },
	        series: valores
	    });
	
}

function column_basic2(div,titulo,subtitulo,texto,categorias,valores,background,tooltipp,titcolum) {

	if(! titcolum)  titcolum=false;
	
	var chart = new Highcharts.Chart({
	        chart: {
				backgroundColor: background,
				renderTo: div,
		        type: 'column'
	           
	        },
	        title: {
	            text: titulo
	        },
	        subtitle: {
	            text: subtitulo
	        },
	        xAxis: {
	            categories: categorias,
	            crosshair: false,
	            labels: {
	                rotation: -45,
	                style: {
	                    fontSize: '10px',
	                    fontFamily: 'Verdana, sans-serif'
	                }
	            }
	        },
	        yAxis: {
	            min: 0,
	            title: {
	                text: texto
	            }
	        },
	        tooltip: tooltipp,
	        plotOptions: {
	            column: {
	                pointPadding: 0.2,
	                borderWidth: 0,
	                dataLabels: {
	                    enabled: titcolum
	                }
	            }
	        },
	        series: valores
	    });
	
}

function angular_gauge_estatic(div,titulo,texto,categorias,valores,background) {

	//alert("entro");
	var chart = new Highcharts.Chart({
	        chart: {
	            type: 'gauge',
	            plotBackgroundColor: null,
	            plotBackgroundImage: null,
	            plotBorderWidth: 0,
	            renderTo: div,
	            plotShadow: false
	        },

	        title: {
	            text: titulo
	        },

	        pane: {
	            startAngle: -150,
	            endAngle: 150,
	            background: [{
	                backgroundColor: {
	                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                    stops: [
	                        [0, '#FFF'],
	                        [1, '#333']
	                    ]
	                },
	                borderWidth: 0,
	                outerRadius: '109%'
	            }, {
	                backgroundColor: {
	                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                    stops: [
	                        [0, '#333'],
	                        [1, '#FFF']
	                    ]
	                },
	                borderWidth: 1,
	                outerRadius: '107%'
	            }, {
	                // default background
	            }, {
	                backgroundColor: '#DDD',
	                borderWidth: 0,
	                outerRadius: '105%',
	                innerRadius: '103%'
	            }]
	        },

	        // the value axis
	        yAxis: {
	            min: 0,
	            max: 100,

	            minorTickInterval: 'auto',
	            minorTickWidth: 1,
	            minorTickLength: 10,
	            minorTickPosition: 'inside',
	            minorTickColor: '#666',

	            tickPixelInterval: 30,
	            tickWidth: 2,
	            tickPosition: 'inside',
	            tickLength: 10,
	            tickColor: '#666',
	            labels: {
	                step: 2,
	                rotation: 'auto'
	            },
	            title: {
	                text: texto
	            },
	            plotBands: [{
	                from: 0,
	                to: 20,
	                color: '#DF5353' // red
	            }, {
	                from: 20,
	                to: 40,
	                color: '#FC7A42' // 
	            }, {
	                from: 40,
	                to: 60,
	                color: '#FCAB42' // 
	            }, {
	                from: 60,
	                to: 80,
	                color: '#DDDF0D' // yellow
	            }, {
	                from: 80,
	                to: 100,
	                color: '#55BF3B' // green
	            }]
	        },

	        series: categorias

	    },
	        // Add some life
	        function (chart) {
	            if (!chart.renderer.forExport) {
	                setInterval(function () {
	                    var point = chart.series[0].points[0],
	                        newVal,
	                        inc = Math.round((Math.random() - 0.5) * 20);

	                    newVal = point.y + inc;
	                    if (newVal < 0 || newVal > 100) {
	                        newVal = point.y - inc;
	                    }

	                    point.update(valores);

	                }, 1000);
	            }
	        });

}

function soild_gauge_estatic(div,titulo,categorias,valores,background) {

	
	var chart = new Highcharts.Chart({
        chart: {
				backgroundColor: background,
				renderTo: div,
	            type: 'solidgauge'
	        },
	        
	        title: {
	            text: titulo
	        },

	        pane: {
	            center: ['50%', '85%'],
	            size: '140%',
	            startAngle: -90,
	            endAngle: 90,
	            background: {
	                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
	                innerRadius: '60%',
	                outerRadius: '100%',
	                shape: 'arc'
	            }
	        },

	        tooltip: {
	            enabled: true
	        },

	        // the value axis
	        yAxis: {
	        	min: 0,
	            max: 100,
	            stops: [
					[0.1, '#DF5353'], // red  
	                [0.5, '#DDDF0D'], // yellow
	                [0.9, '#55BF3B'] // green
	                
	            ],
	            lineWidth: 0,
	            minorTickInterval: null,
	            tickPixelInterval: 400,
	            tickWidth: 0,
	            title: {
	                y: -70
	            },
	            labels: {
	                y: 16
	            }
	            
	        },

	        plotOptions: {
	            solidgauge: {
	                dataLabels: {
	                    y: 5,
	                    borderWidth: 0,
	                    useHTML: true
	                }
	            }
	        },

	        credits: {
	            enabled: false
	        },

	        series: categorias
	},

	    // Bring life to the dials
	    function (chart) {
            if (!chart.renderer.forExport) {
                setInterval(function () {
                    var point = chart.series[0].points[0],
                        newVal,
                        inc = Math.round((Math.random() - 0.5) * 100);

                    newVal = point.y + inc;
                    if (newVal < 0 || newVal > 100) {
                        newVal = point.y - inc;
                    }
                    	//alert(newVal);
                    point.update(valores);

                }, 1000); 
            }
        });


}

function column_linea(div,titulo,subtitulo,texto,categorias,valores,background,titlin,titcolum) {

	if(! titlin) 	titlin=false;
	if(! titcolum)  titcolum=false;
	
	var chart = new Highcharts.Chart({
	        chart: {
				backgroundColor: background,
				renderTo: div 
	        },
	        title: {
	            text: titulo
	        },
	        subtitle: {
	            text: subtitulo
	        },
	        xAxis: {
	            categories: categorias,
	            crosshair: false
	        },
	        yAxis: {
	            min: 0,
	            title: {
	                text: texto
	            }
	        },
	        plotOptions: {
	            column: {
	        		stacking: 'normal',
        			dataLabels: {
	                    enabled: titcolum
	                }
	            },
		        line: {
	                dataLabels: {
	                    enabled: titlin
	                }
	            }
	        },
	        series: valores
	    });
	
}
function column_linea2(div,titulo,subtitulo,texto,categorias,valores,background,titlin,titcolum) {

	if(! titlin) 	titlin=false;
	if(! titcolum)  titcolum=false;
	
	var chart = new Highcharts.Chart({
	        chart: {
				backgroundColor: background,
				renderTo: div 
	        },
	        title: {
	            text: titulo
	        },
	        subtitle: {
	            text: subtitulo
	        },
	        xAxis: {
	            categories: categorias,
	            crosshair: false
	        },
	        yAxis: {
	            min: 0,
	            title: {
	                text: texto
	            }
	        },
	        plotOptions: {
	            column: {
	        		dataLabels: {
	                    enabled: titcolum
	                }
	            },
		        line: {
	                dataLabels: {
	                    enabled: titlin
	                }
	            }
	        },
	        series: valores
	    });
	
}
function multiple_axes(div,titulo,subtitulo,texto,categorias,valores,background) {
	var chart = new Highcharts.Chart({
			chart: {
	            zoomType: 'xy',
	            renderTo: div 	
	        },
	        title: {
	            text: titulo
	        },
	        subtitle: {
	            text: subtitulo
	        },
	        xAxis: [{
	            categories: categorias,
	            crosshair: true
	        }],
	        yAxis: texto,
	        tooltip: {
	            shared: true
	        },
	        
	        series: valores
	    });
}

