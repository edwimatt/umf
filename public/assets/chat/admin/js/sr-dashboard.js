$(document).ready( function(){
    getTopWidget();
    getKpiTargets();
    getLeaderBoard();
    getKnockTimeChart();
    getKnockDayChart();
    kpiGroupPerformance();
    metricGroup();
    territoryPerformance();
    teamPerformance();
})
function getTopWidget()
{
    initRequest('/admin/dashboard/top-widget','GET').then( (res) => {
        $('#attepmt_per_contact').html(res.attempt_per_contact);
        $('#attempt_per_lead').html(res.attempt_per_lead);
        $('#attempt_per_sale').html(res.attempt_per_sale);
        $('#reknocked').html(res.reknocked);
    })
}

function getKpiTargets()
{
    initRequest('/admin/sr-kpi-targets','GET').then( (res) => {
        $('#kpi_annual_target').html(res.annual_api_target);
        $('#kpi_monthly_target').html(res.monthly_api_target);
        $('#kpi_weekly_target').html(res.weekly_api_target);
    })
}

function getLeaderBoard()
{
    initRequest('/admin/dashboard/leader-board','GET').then( (res) => {
        $('#leader_board').append(res.leader_board);
    })
}

function getKnockTimeChart()
{
    initRequest('/admin/dashboard/knock-time-chart','GET').then( (res)=> {
        var id1 = document.getElementById("myChart");
        var chart_label = res != null ? res.hours : [];
        var chart_data  = res !=null ? res.total : [];
        MyChart(id1,"#94C5FC", 'Best Knock Time', chart_label, chart_data);
    })
}

function getKnockDayChart()
{
    initRequest('/admin/dashboard/knock-day-chart','GET').then( (res)=> {
        var id1 = document.getElementById("myChart2");
        var chart_label = res != null ? res.day_name : [];
        var chart_data  = res !=null ? res.total : [];
        MyChart(id1,"#FFC388", 'Best Knock Day', chart_label, chart_data);
    })
}

function MyChart(id, color, chart_title, label, data)
{
    var ctx = id.getContext("2d");
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: "line", // also try bar or other graph types

        // The data for our dataset
        data: {
            labels: label,
            // Information about the dataset
            datasets: [
                {
                    label: "Contact Person Count",
                    backgroundColor: "transparent",
                    borderColor: color,
                    data: data,
                },
            ],
        },
        // Configuration options
        options: {
            layout: {
                padding: 10,
            },
            legend: {
                position: "bottom",
            },
            title: {
                display: true,
                text: chart_title,
            }
        },
    });
}

function kpiGroupPerformance()
{
    initRequest('/admin/dashboard/metric-group-performance','GET').then( (res) => {
        $('#metric_performance').html(res);
    })
}

function metricGroup()
{
    initRequest('/admin/dashboard/kpi-group-performance','GET').then( (res) => {
        $('#kpi_group_performance').html(res);
        var universe       = $('#kpi_group_universe').html();
        var converage_rate = $('#kpi_group_converage_rate').html();
        $('#metric_universe').html(universe);
        $('#metric_converage_rate').html(converage_rate);
    })
}

function territoryPerformance()
{
    initRequest('/admin/dashboard/territory-performance','GET').then( (res) => {
        $('#territory_performance').append(res);
        $('.territory_container').each( function(){
            var converage_rate = $(this).find('.converage_rate_value').val();
            $(this).find('.converage_rate').html(converage_rate)
        })
    });
}

function teamPerformance()
{
    initRequest('/admin/dashboard/team-performance','GET').then( (res) => {
        $('#team_performance').append(res);
        $('.team_container').each( function(){
            var total_pins     = $(this).find('.total_pins').val();
            var universe       = $(this).find('.team_universe').html();
            var converage_rate = ( parseFloat(total_pins) / parseFloat(universe) );
                converage_rate =  converage_rate.toFixed(2);
            $(this).find('.team_converage_rate').html( converage_rate == 'Infinity' ? 0.00 : converage_rate );
        })
    })
}

function initRequest(uri, method, params= {})
{
    return new Promise( function (resolve, reject){
        $.ajax({
            type:method,
            url: base_url + uri,
            data:params,
            success : function(data){
                resolve(data)
            }
        })
    })

}