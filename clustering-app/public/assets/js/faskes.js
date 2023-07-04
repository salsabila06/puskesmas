$(function () {

    let btnDelete = ".delete";
    let btnEdit = ".edit";

    getListDistrict();
   getListType();

    const tableFaskes = new LibDataTables({
        url: "",
        columns: [
            {
                data: "id_faskes",
                name: "id_faskes",
                sortable: false,
                searchable: false,
                render: function (data, type, row, meta) {
                    return ++meta.row;
                },
            },
            {
                data: "faskes_name",
                name: "faskes_name",
            },

            {
                data: "type.faskes_type_name",
                name: "faskes_type_name",
            },
            {
                data: "district.district_name",
                name: "district_name",
                sortable: false,
            },
            {
                data: "user.fullname",
                name: "fullname",
                sortable: false,
            },
            {
                data: "faskes_establish",
                name: "faskes_establish",
            },
            {
                data: null,
                sortable: false,
                searchable: false,
                orderable: false,
                render: function (data, type, row, meta) {
                    let btn = `<a href="#" data-id="${row.id_faskes}" data-user="${row.user.id_user}" class="btn btn-primary edit" data-toggle="modal" data-target="#modal_edit">Edit</a><a href="#" data-id="${row.id_faskes}" data-user="${row.user.id_user}" class="btn btn-danger ml-2 delete" >Hapus</a>`;
                    return btn;
                },
            },
        ],
    });

    tableFaskes.add();
    tableFaskes.update();

    $("body").on("click", btnDelete, function (e) {
        e.preventDefault();
        const faskes_id = $(this).data("id");
        const user_id = $(this).data("user");
        tableFaskes.delete("Hapus Pertanyaan", { faskes_id,user_id });
    });

    $("body").on("click", btnEdit, function (e) {
        e.preventDefault();
         const faskes_id = $(this).data("id");
        const user_id = $(this).data("user");
        tableFaskes.show({ faskes_id,user_id },(res)=>{
            $.map(res.data, (v, i) => {
            $(`#${i}`).val(v);
        });
        });
    });
});
