$(function () {
    let btnDelete = ".delete";
    let btnEdit = ".edit";

    const tableSurvey = new LibDataTables({
        url: "",
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
                    let btn = `<a href="#" data-id="${row.id_survey}" class="btn btn-primary edit" data-toggle="modal" data-target="#modal_edit">Edit</a><a href="#" data-id="${row.id_survey}" class="btn btn-danger ml-2 delete" >Hapus</a>`;
                    return btn;
                },
            },
        ],
    });

    tableSurvey.add();
    tableSurvey.update();

    $("body").on("click", btnDelete, function (e) {
        e.preventDefault();
        const id_survey = $(this).data("id");
        tableSurvey.delete("Hapus Pertanyaan", { id_survey });
    });

    $("body").on("click", btnEdit, function (e) {
        e.preventDefault();
        const id_survey = $(this).data("id");
        tableSurvey.show({ id_survey });
    });
});
