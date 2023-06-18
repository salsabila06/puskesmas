class LibDataTables {
    constructor({
        tableId = "#table",
        url,
        columns,
        form = ["#formAdd", "#formEdit"],
        modal = ["#modal_add", "#modal_edit"],
        button = [".edit", ".delete"],
    }) {
        this.id = tableId;
        this.url = url;
        this.columns = columns;
        this.form = form;
        this.modal = modal;
        this.button = button;
        this.prefix = location.pathname;

        this.table = $(this.id).DataTable({
            serverSide: true,
            processing: false,
            order: [[1, "ASC"]],
            ajax: {
                url: this.url,
                type: "POST",
                dataType: "JSON",
                dataSrc: "data",
                headers: {
                    "X-CSRF-TOKEN": $("meta[name=csrf_token]").prop("content"),
                },
            },
            columns: this.columns,
            preDrawCallback: function (settings) {
                Notiflix.Block.circle("table");
            },
            drawCallback: function (settings) {
                Notiflix.Block.remove("table");
            },
        });
    }

    add() {
        let modal = this.modal[0];
        let url = `${this.prefix}/store`;
        let table = this.table;

        $(this.form[0]).on("submit", function (e) {
            e.preventDefault();
            ajax(url, $(this).serialize())
                .done((res) => {
                    $(modal).modal("hide");
                    table.ajax.reload();
                    Notiflix.Notify.success(res.message);
                    $(this).trigger("reset");
                })
                .fail((xhr) => {
                    const res = xhr.responseJSON;
                    Notiflix.Notify.failure(res.message);
                });
        });
    }

    update() {
        let modal = this.modal[1];
        let url = `${this.prefix}/update`;
        let table = this.table;

        $(this.form[1]).on("submit", function (e) {
            e.preventDefault();
            ajax(url, $(this).serialize())
                .done((res) => {
                    $(modal).modal("hide");
                    table.ajax.reload();
                    Notiflix.Notify.success(res.message);
                    $(this).trigger("reset");
                })
                .fail((xhr) => {
                    const res = xhr.responseJSON;
                    Notiflix.Notify.failure(res.message);
                });
        });
    }

    show(data, callback = this.setDataShow) {
        let url = `${this.prefix}/show`;
        ajax(url, data).done((res) => callback(res));
    }

    delete(title, data) {
        let url = `${this.prefix}/delete`;
        let table = this.table;
        Notiflix.Confirm.show(
            title,
            "Yakin menghapus data ini?",
            "Hapus",
            "Tidak",
            function okCb() {
                ajax(url, data)
                    .done((res) => {
                        table.ajax.reload();
                        Notiflix.Notify.success(res.message);
                    })
                    .fail((xhr) => {
                        const res = xhr.responseJSON;
                        Notiflix.Notify.failure(res.message);
                    });
            },
            () => {},
            {}
        );
    }

    setDataShow(res) {
        $.map(res, (v, i) => {
            $(`#${i}`).val(v);
        });
    }
}
