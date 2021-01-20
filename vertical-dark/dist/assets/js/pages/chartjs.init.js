!function(s)
{"use strict";
var o=function()
    {this.$body=s("body"),
        this.charts=[]};
        o.prototype.respChart=function(r,a,e,t)
        {var n=Chart.controllers.line.prototype.draw;
            Chart.controllers.line.prototype.draw=function()
            {n.apply(this,arguments);
                var o=this.chart.chart.ctx,r=o.stroke;o.stroke=function()
                {o.save(),o.shadowColor="#65708a",o.shadowBlur=10,o.shadowOffsetX=0,
                o.shadowOffsetY=4,r.apply(this,arguments),o.restore()}},
                Chart.defaults.global.defaultFontColor="rgba(255,255,255,0.5)";
                var i=r.get(0).getContext("2d"),l=s(r).parent();
                return function(){var o;switch(r.attr("width",s(l).width()),a)
                {case"Line":o=new Chart(i,{type:"line",data:e,options:t});break;
                case"Doughnut":o=new Chart(i,{type:"doughnut",data:e,options:t})
                ;break;case"Pie":
                o=new Chart(i,{type:"pie",data:e,options:t});break;
                case"Bar":o=new Chart(i,{type:"bar",data:e,options:t});break;
                case"Radar":o=new Chart(i,{type:"radar",data:e,options:t});break;
                case"PolarArea":o=new Chart(i,{data:e,type:"polarArea",options:t})}
                return o}()},o.prototype.initCharts=function(){var o=[],
                    r=document.getElementById("line-chart-example").getContext("2d"),
                    a=r.createLinearGradient(500,0,100,0);a.addColorStop(0,"#8360c3"),
                    a.addColorStop(1,"#2ebf91");var e=r.createLinearGradient(500,0,100,0);
                    e.addColorStop(0,"#22c1c3"),e.addColorStop(1,"#fdbb2d");
                    var t={labels:["01","02","03","04","05","06","07","08","09","10","11","12"],
                    datasets:[{label:"Sales",fill:!1,borderColor:
                    a,pointBorderColor:a,pointBackgroundColor:a,
                    pointHoverBackgroundColor:a,pointHoverBorderColor:a,
                    data:[18,41,86,49,20,65,64,86,49,30,45,25]},
                    {label:"Sales",fill:!1,borderDash:[5,5],borderColor:
                    e,pointBorderColor:e,pointBackgroundColor:e,
                    pointHoverBackgroundColor:e,pointHoverBorderColor:e,
                    data:[36,25,61,52,45,20,48,71,26,64,29,56]}]};
                    o.push(this.respChart(s("#line-chart-example"),"Line",t,
                    {maintainAspectRatio:!1,responsive:!0,legend:{display:!1},
                    animation:{easing:"easeInOutBack"},
                    scales:{yAxes:[{display:!1,ticks:{fontColor:"rgba(0,0,0,0.5)",
                    fontStyle:"bold",beginAtZero:!0,maxTicksLimit:5,padding:0},
                    gridLines:{drawTicks:!1,display:!1}}],xAxes:[{display:!1,
                        gridLines:{zeroLineColor:"transparent"},
                        ticks:{padding:0,fontColor:"rgba(0,0,0,0.5)",fontStyle:"bold"}}]}}));
                    o.push(this.respChart(s("#bar-chart-example"),"Bar",{labels:["01","02","03","04","05","06","07","08","09","10","11","12","13","14","15"],datasets:[{label:"Sales Analytics",backgroundColor:"#0082c8",borderColor:"#0082c8",borderWidth:1,hoverBackgroundColor:"#0082c8",hoverBorderColor:"#0082c8",data:[65,59,80,81,56,89,40,32,65,59,80,81,56,89,40,32,65,59,80,81,56,89,40,32,65,59,80,81,56,89,40]}]},{maintainAspectRatio:!1,legend:{display:!1},scales:{yAxes:[{gridLines:{display:!1},ticks:{max:100,min:20,stepSize:20}}],xAxes:[{barPercentage:.2,gridLines:{color:"rgba(0,0,0,0.05)"}}]}}));var n=document.getElementById("area-chart-example").getContext("2d").createLinearGradient(0,300,0,100);n.addColorStop(0,"#FF416C"),n.addColorStop(1,"#FF4B2B");var i={labels:["","","","","","","",""],datasets:[{label:"Conversion Funnels",fill:!0,backgroundColor:n,borderColor:n,pointBorderColor:n,pointBackgroundColor:n,pointHoverBackgroundColor:"transparent",pointHoverBorderColor:"transparent",data:[28,34,46,76,60,62,26,14]}]};o.push(this.respChart(s("#area-chart-example"),"Line",i,{maintainAspectRatio:!1,legend:{display:!1},animation:{easing:"easeInOutBack"},elements:{point:{radius:0,hitRadius:10,hoverRadius:5}},tooltips:{enabled:!1},scales:{yAxes:[{display:!1,ticks:{suggestedMin:0}}],xAxes:[{scaleShowLabels:!1,gridLines:{zeroLineColor:"transparent"},ticks:{padding:-28,fontColor:"#dee2e6",fontStyle:"bold"}}]}}));
                    o.push(this.respChart(s("#doughnut"),"Doughnut",{
                        labels:["Wallet Balance","Travels","Food & Drinks"],
                    datasets:[{data:[300,50,100],backgroundColor:["#02a8b5","#fa5c7c","#ebeff2"],
                    borderColor:"transparent",borderWidth:"3"}]},
                    {maintainAspectRatio:!1,cutoutPercentage:80,legend:{display:!1}}))
                    ;o.push(this.respChart(s("#radar-chart-example"),"Radar",{
                        labels:["Eating","Drinking","Sleeping","Designing","Coding","Cycling","Running"],
                        datasets:[{label:"Desktops",backgroundColor:"rgba(89, 193, 115,0.2)",
                        borderColor:"#59C173",pointBackgroundColor:"#59C173",
                        pointBorderColor:"#fff",pointHoverBackgroundColor:"#fff",
                        pointHoverBorderColor:"#59C173",data:[65,59,90,81,56,55,40]},
                        {label:"Tablets",backgroundColor:"rgba(161, 127, 224,0.2)",
                        borderColor:"#a17fe0",pointBackgroundColor:"#a17fe0",
                        pointBorderColor:"#fff",pointHoverBackgroundColor:"#fff",
                        pointHoverBorderColor:"#a17fe0",data:[28,48,40,19,96,27,100]}]},
                        {scale:{ticks:{fontColor:"white",backdropColor:"#253138"},
                        pointLabels:{fontColor:"#98a6ad"},gridLines:{color:"#596275"},
                        angleLines:{color:"#596275"}}}));
                        return o.push(this.respChart(s("#filled-line-chart"),"Line",{labels:["01","02","03","04","05","06","07","08","09"],datasets:[{label:"Downloads",fill:!0,backgroundColor:"rgba(101, 78, 163, 0.2)",borderColor:"#654ea3",borderWidth:2,lineTension:0,pointBorderWidth:2,pointBackgroundColor:"#fff",pointBorderColor:"#654ea3",pointRadius:3,pointHitRadius:3,data:[65,59,80,81,56,55,40,35,30]},{label:"Uploads",fill:!0,backgroundColor:"rgba(0, 131, 176, 0.2)",borderColor:"#0083B0",borderWidth:2,lineTension:0,pointBorderWidth:2,pointBackgroundColor:"#fff",pointBorderColor:"#0083B0",pointRadius:3,pointHitRadius:3,data:[22,28,42,38,12,22,18,9,3]}]},{maintainAspectRatio:!1,legend:{display:!1},animation:{easing:"easeInOutBack"},plugins:{filler:{propagate:!1}},scales:{yAxes:[{display:!1,ticks:{fontStyle:"bold",beginAtZero:!0,padding:0},gridLines:{drawTicks:!1,display:!1}}],xAxes:[{display:!0,gridLines:{zeroLineColor:"transparent"},ticks:{padding:5,fontStyle:"bold"}}]}})),o},o.prototype.init=function(){var r=this;r.charts=this.initCharts(),s(window).on("resize",function(o){s.each(r.charts,function(o,r){try{r.destroy()}catch(o){console.log(o)}}),r.charts=r.initCharts()})},s.ChartJs=new o,s.ChartJs.Constructor=o}(window.jQuery),function(o){"use strict";window.jQuery.ChartJs.init()}();