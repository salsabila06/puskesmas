const data = {
    labels: [],
    datasets: []
};
const config = {
    type: 'pie',
    data,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            tooltip: {
                callbacks: {
                    label: function (ctx) {

                        let label = ctx.label
                        let data = ctx.raw

                        return `${label}: ${data} Puskesmas`
                    },
                    title: function (ctx) {
                        return `Data Kelayakan Puskesmas`
                    }
                }
            }
        }
    },
}

const canvas = $('#chart-pie')

const clusterChart = new Chart(canvas, config)

const COLORS = [
    '#f67019', '#4dc9f6', '#f53794', '#537bc4', '#acc236', '#166a8f', '#00a950', '#58595b', '#8549ba'
];

const surveySelect = $('#survey-select');
$(function () {

    setDataChart({ survey_id: surveySelect.val() })
    surveySelect.on('change', function () {

        setDataChart({ survey_id: surveySelect.val() })

    })

})

const setDataChart = (data) => {
    $.ajax({
        type: "POST",
        url: "/cluster/chart",
        data,
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf_token]").prop("content"),
        },
        dataType: "JSON",
    }).done((res) => {

        const label = []
        const datasets = []
        const background = [];

        res.map((v, i) => {
            label.push(v.label)
            datasets.push(v.data)
            background.push(COLORS[i])
        })


        clusterChart.data.labels = label
        clusterChart.data.datasets = [
            {
                label: '',
                data: datasets,
                backgroundColor: background,
            }
        ]

        clusterChart.update()
    });
}
