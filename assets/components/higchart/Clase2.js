/*$titulo		="Resultado Numerica, Referencias x Cliente y Dropsize";
	$subtitulo	="";
	$texto		="";
	$categorias	="['BASE','ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC','META']";

	$v_1="{name: 'Dropsize',type: 'column',yAxis: 1,
	        data: [10,20,30,40,50,60,70,80,90,100,110,120,130,200]
		  }";
	
	$v_2="{name: 'Numerica',type: 'spline',yAxis: 2,dashStyle: 'shortdot',
	         data: [1,2,3,4,5,6,7,8,9,10,11,12,13,14]
	      }";
	
	$v_3="{name: 'Ref x Cli',type: 'spline',
	       data: [1010,1020,1030,1040,1050,1060,1070,1080,1090,10100,10110,10120,10130,10140]
	      }";
	
	$valores	="[$v_1,$v_2,$v_3]";
	$background	="";
	
	
	$cadena		="[{name:'COOPIDROGAS MEDELLIN',data:[0,0,0,0,20217764.22,0,0,0,0,0,0,0]}]";
	$datos="<script type='text/javascript'>
				multiple_axes('container','$titulo','$subtitulo','',$categorias,$valores,'');
			</script>";*/

/*var objGraf = new Grafica('container','fasdf','asdfsad');
				objGraf.multiple_axes();
				objGraf.print();*/

function Grafica(container,titulo,subtitulo){
	
	if(! titulo)	titulo='';
	if(! subtitulo)	subtitulo='';
	
	this.container	=container;
	this.titulo		=titulo;
	this.subtitulo	=subtitulo;
	
	this.params		=[];
	this.chart		=new Object();
	this.title		=new Object();
	this.subtitle	=new Object();
	
	/*inicializo los parametros de cualquier grafica*/
	this.getParams = function() {
		
		this.chart['renderTo']	=this.container;
		this.params['chart']	=this.chart;
		
		this.title['text']		=this.titulo;
		this.params['title']	=this.title;
		
		this.subtitle['text']	=this.subtitulo;
		this.params['subtitle']	=this.subtitle;
		return this.params;
	}
	this.print=function(){
		var chart = new Highcharts.Chart(this.params); 
	}
	
	 this.multiple_axes = function() {
		 
		 var params = this.getParams();
		 
		 params['xAxis']=[{
	            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
	     	                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
	     	            crosshair: true
	     	        }];
		 
		 params['yAxis']=[{ // Primary yAxis
	            labels: {
	                format: '{value}°C',
	                style: {
	                    color: Highcharts.getOptions().colors[2]
	                }
	            },
	            title: {
	                text: 'Temperature',
	                style: {
	                    color: Highcharts.getOptions().colors[2]
	                }
	            },
	            opposite: true

	        },
	        { // Secondary yAxis
	            gridLineWidth: 0,
	            title: {
	                text: 'Rainfall',
	                style: {
	                    color: Highcharts.getOptions().colors[0]
	                }
	            },
	            labels: {
	                format: '{value} mm',
	                style: {
	                    color: Highcharts.getOptions().colors[0]
	                }
	            }

	        }, 
	        { // Tertiary yAxis
	            gridLineWidth: 0,
	            title: {
	                text: 'Sea-Level Pressure',
	                style: {
	                    color: Highcharts.getOptions().colors[1]
	                }
	            },
	            labels: {
	                format: '{value} mb',
	                style: {
	                    color: Highcharts.getOptions().colors[1]
	                }
	            },
	            opposite: true
	        }];
		 
		 params['tooltip']={
		            shared: true
	        };
		 
		 params['series']=[{
	            name: 'Rainfall',
	            type: 'column',
	            yAxis: 1,
	            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
	            tooltip: {
	                valueSuffix: ' mm'
	            }

	        },
	        {
	            name: 'Sea-Level Pressure',
	            type: 'spline',
	            yAxis: 2,
	            data: [1016, 1016, 1015.9, 1015.5, 1012.3, 1009.5, 1009.6, 1010.2, 1013.1, 1016.9, 1018.2, 1016.7],
	            marker: {
	                enabled: false
	            },
	            dashStyle: 'shortdot',
	            tooltip: {
	                valueSuffix: ' mb'
	            }

	        }
	        , {
	            name: 'Temperature',
	            type: 'spline',
	            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
	            tooltip: {
	                valueSuffix: ' °C'
	            }
	        }];
		}
}


