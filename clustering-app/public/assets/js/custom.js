/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

const baseurl = location.origin;
const prefix = window.location.pathname;
let formAdd = $("#formAdd");
let formEdit = $("#formEdit");
const table = $("#table");

const ajax = (url, data = []) => {
    return $.ajax({
        url: `${baseurl}${url}`,
        data,
        dataType: "JSON",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf_token]").prop("content"),
        },
    });
};

const getListDistrict = () => {
    let district = $("#district");
    ajax("/district").done((res) => {
        res.map((v, i) => {
            district.append(
                `<option value="${v.id_district}">${v.district_name}</option>`
            );
        });
    });
};
const getListType = () => {
    let faskesType = $(".faskes_type");
    ajax("/faskes-type").done((res) => {
        res.map((v, i) => {
            faskesType.append(
                `<option value="${v.id_faskes_type}">${v.faskes_type_name}</option>`
            );
        });
    });
};

const getTypeQuest = () => {
    let questTypeSelect = $(".quest_type_id");
    ajax("/parameter-penilaian/show").done((res) => {
        res.map((v, i) => {
            questTypeSelect.append(
                `<option value="${v.id_quest_type}">${v.quest_type_name}</option>`
            );
        });
    });
};

const logout = (e) => {
    e.preventDefault();
    let logoutForm = $("#logout-form");
    logoutForm.submit();
};




