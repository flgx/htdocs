'use strict'

$(document).ready(function() {
    var donutData = [
        {label: "Puntos interactivos", data: 30, color: "#00c0ef"},
        {label: "Todas", data: 20, color: "#0073b7"}
    ];
    $.plot("#view-chart", donutData, {
        series: {
            pie: {
                show: true,
                radius: 1,
                innerRadius: 0.5,
                label: {
                    show: true,
                    radius: 2 / 3,
                    formatter: labelFormatter,
                    threshold: 0.1
                }
            }
        },
        legend: {
            show: false
        }
    });

    var currentRanking = $('.ranking').attr('data-ranking');

	$('.ranking').raty({ score: currentRanking, readOnly: true });

    function labelFormatter(label, series) {
        return "<div style='font-size:13px; text-align:center; padding:2px; color: #000; font-weight: 600;'>"
                + label
                + "<br/>"
                + Math.round(series.percent) + "%</div>";
    }
});

