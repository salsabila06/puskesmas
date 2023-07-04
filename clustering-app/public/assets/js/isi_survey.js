$(function () {
    new LibDataTables({
        url: "/survey/for-faskes",
        columns: [
            {
                data: "id_survey",
                name: "id_survey",
                sortable: false,
                searchable: false,
                render: function (data, type, row, meta) {
                    return ++meta.row;
                },
            },
            {
                data: "title",
                name: "title",
            },

            {
                data: "date_publish",
                name: "date_publish",
            },
            {
                data: null,
                sortable: false,
                searchable: false,
                orderable: false,
                render: function (data, type, row, meta) {
                    let btnIsi = `<a href="${prefix}/${row.id_survey}"  class="btn btn-primary">Isi</a>`;
                    let btnCek = `<a href="#"  class="btn btn-primary check" data-survey='${JSON.stringify(data)}' data-target="#modal_result" data-toggle="modal">Lihat Hasil</a>`;
                    return data.status == 1 ? btnCek : btnIsi;
                },
            },
        ],
    });

    $('body').on('click','.check',function () {
        let survey = $(this).data('survey')

        $('.title-survey').text(survey.title)
         ajax("/result", {
                    survey_id:survey.id_survey
     }).done((res) => {

        let template = ''
        res.data.map((v,i)=>{
            template += `<tr>
                        <td>${v.quest_type_name}</td>
                        <td>${v.value_percentage}%</td>
                        </tr>`
        })
         $('#modal_result tbody').empty().append(template)
    })
     })

});
