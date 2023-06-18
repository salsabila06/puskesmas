$(function () {
    let btnDelete = ".delete";
    let btnEdit = ".edit";

    const tableQuestType = new LibDataTables({
        url: "",
        columns: [
            {
                data: "id_quest_type",
                name: "id_quest_type",
                sortable: false,
                searchable: false,
                render: function (data, type, row, meta) {
                    return ++meta.row;
                },
            },
            {
                data: "quest_type_name",
                name: "quest_type_name",
            },
            {
                data: null,
                sortable: false,
                searchable: false,
                render: function (data, type, row, meta) {
                    let btn = `<a href="#" data-id="${row.id_quest_type}" class="btn btn-primary edit" data-toggle="modal" data-target="#modal_edit">Edit</a><a href="#" data-id="${row.id_quest_type}" class="btn btn-danger ml-2 delete" >Hapus</a>`;
                    return btn;
                },
            },
        ],
    });

    tableQuestType.add();
    tableQuestType.update();

    $("body").on("click", btnDelete, function (e) {
        e.preventDefault();
        const id_quest_type = $(this).data("id");
        tableQuestType.delete("Hapus Pertanyaan", { id_quest_type });
    });

    $("body").on("click", btnEdit, function (e) {
        e.preventDefault();
        const id_quest_type = $(this).data("id");
        tableQuestType.show({ id_quest_type });
    });
});
