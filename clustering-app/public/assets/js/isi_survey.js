$(function () {
    new LibDataTables({
        url: "/survey",
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
                    let btn = `<a href="${prefix}/${row.id_survey}"  class="btn btn-primary">Isi</a>`;
                    return btn;
                },
            },
        ],
    });
});
