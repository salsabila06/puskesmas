$(function () {
    let btnDelete = ".delete";
    let btnEdit = ".edit";
    getTypeQuest();
    getListType();

    const tableQuest = new LibDataTables({
        url: "",
        columns: [
            {
                data: "id_quest",
                name: "id_quest",
                sortable: false,
                searchable: false,
                render: function (data, type, row, meta) {
                    return ++meta.row;
                },
            },
            {
                data: "quest",
                name: "quest",
            },

            {
                data: "quest_type.quest_type_name",
                name: "quest_type_id",
            },
            {
                data: "target",
                name: "target",
                sortable: false,
                searchable: false,
                render: function (data, type, row, meta) {
                    return data == 0
                        ? "Semua"
                        : data == 1
                        ? "Inap"
                        : "Non Inap";
                },
            },
            {
                data: null,
                sortable: false,
                searchable: false,
                orderable: false,
                render: function (data, type, row, meta) {
                    let btn = `<a href="#" data-id="${row.id_quest}" class="btn btn-primary edit" data-toggle="modal" data-target="#modal_edit">Edit</a><a href="#" data-id="${row.id_quest}" class="btn btn-danger ml-2 delete" >Hapus</a>`;
                    return btn;
                },
            },
        ],
    });

    tableQuest.add();
    tableQuest.update();

    $("body").on("click", btnDelete, function (e) {
        e.preventDefault();
        const id_quest = $(this).data("id");
        tableQuest.delete("Hapus Pertanyaan", { id_quest });
    });

    $("body").on("click", btnEdit, function (e) {
        e.preventDefault();
        const id_quest = $(this).data("id");
        tableQuest.show({ id_quest });
    });
});
